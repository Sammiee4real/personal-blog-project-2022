<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use App\Models\ArticleCategory;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoriesTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_category_lists_page_can_be_rendered()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('categories.index'));
        $response->assertStatus(200);
    }

    public function test_categories_creation_page_can_be_rendered()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('categories.create'));
        $response->assertStatus(200);
    }

    public function test_categories_edit_page_can_be_rendered()
    {
        $user = User::factory()->create();
        $category = ArticleCategory::factory(5)->create();
        $getcategory = ArticleCategory::first();
        $response = $this->actingAs($user)->get('categories/categories/'.$getcategory->id.'/edit');
        $response->assertStatus(200);
    }

    public function test_a_category_can_be_stored()
    {
        $user = User::factory()->create();  
        $category = ArticleCategory::factory()->create();
       
        //there could be a better approach
        $this->followingRedirects()->actingAs($user)->post( route('categories.store') , $category->toArray());
        $this->assertDatabaseHas(ArticleCategory::class,['id'=>$category->id]);
    }

    public function test_a_category_can_be_updated()
    {
        $user = User::factory()->create();  
        $category = ArticleCategory::factory()->create();
        $category->name = "Updated Record";
        $category->save();
 
        //there could be a better approach
        $this->followingRedirects()->actingAs($user)->put('categories/categories/'.$category->id,$category->toArray());
        $this->assertDatabaseHas(ArticleCategory::class,['id' => $category->id, 'name'=>'Updated Record', ]);    
    }

}
