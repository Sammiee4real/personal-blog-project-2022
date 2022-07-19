<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use App\Models\Article;
use App\Models\ArticleTags;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticlesTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_articles_lists_page_can_be_rendered()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('articles.index'));
        $response->assertStatus(200);
    }

    public function test_articles_creation_page_can_be_rendered()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('articles.create'));
        $response->assertStatus(200);
    }

    public function test_articles_edit_page_can_be_rendered()
    {
        $user = User::factory()->create();
        $article = Article::factory(5)->create();
        $getArticle = Article::first();
        $response = $this->actingAs($user)->get('articles/articles/'.$getArticle->id.'/edit');
        $response->assertStatus(200);
    }

    public function test_an_article_can_be_stored()
    {
        $user = User::factory()->create();  
        $article = Article::factory()->create();
       
        //there could be a better approach
        $response = $this->followingRedirects()->actingAs($user)->post( route('articles.store') , $article->toArray());
        $this->assertDatabaseHas(Article::class,['id'=>$article->id]);
    }

    public function test_an_article_can_be_updated()
    {
        $user = User::factory()->create();  
        $article = Article::factory()->create(['user_id'=>$user->id]);
        $article->title = "Updated Record";
        $article->full_text = "Updated Text";
        $article->save();
 
        //there could be a better approach
        $this->followingRedirects()->actingAs($user)->put('articles/articles/'.$article->id,$article->toArray());
        $this->assertDatabaseHas(Article::class,['id' => $article->id, 'title'=>'Updated Record', 'full_text'=>'Updated Text' ]);    
    }

    public function test_an_article_can_be_deleted()
    {
        $user = User::factory()->create();  
        $article = Article::factory()->create();

        //there could be a better approach
        $this->actingAs($user)->delete('articles/articles/'.$article->id);
        $this->assertDatabaseMissing(Article::class,['id' => $article->id]);    
    }
}
