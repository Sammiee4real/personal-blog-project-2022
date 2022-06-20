<?php

namespace App\Models;

use App\Models\User;
use App\Models\ArticleTags;
use App\Models\ArticleCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    protected $table = 'articles';

    protected $fillable = [
        'title',
        'full_text',
        'tags',
        'image_upload',
        'user_id',
        'category_id',
    ];

    protected $casts = [
        'created_at' => 'datetime:F-d-Y'
    ];


    ///note: Article uses belongsTo to access ArticleCategory 
    //BECAUSE, article holds the foreign id of articlecategory i.e category_id
    public function category()
    {
        return $this->belongsTo(ArticleCategory::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // protected function createdAt() : Attribute
    // {
    //     return Attribute::make(
    //         get: fn($value) => date('F-d-Y H:i:s'),
    //     );
    // }

    protected function tags(): Attribute
    {
        
        return Attribute::make(
            get: function($value){
                $tags_arr = explode(',',$value);
                $tagNames = [];
                for($i=0; $i < count($tags_arr); $i++)
                {
                    $tagNames[] =  ArticleTags::where('id',$tags_arr[$i])->first()->name;
                }
                return $tagNames;
            }
        );
    }

    protected function taggids(): Attribute
    {
        
        return Attribute::make(
            get: function($value){
                $tags_arr = explode(',',$value);
                $tagIds = [];
                for($i=0; $i < count($tags_arr); $i++)
                {
                    $tagIds[] =  $tags_arr[$i];
                }
                return $tagIds;
            }
        );
    }

}
