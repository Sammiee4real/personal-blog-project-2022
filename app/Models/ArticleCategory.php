<?php

namespace App\Models;

use App\Models\Article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ArticleCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    protected $table = 'article_categories';

    ///note: ArticleCategory uses hasOne to access Article 
    //BECAUSE, article holds the foreign id of articlecategory i.e category_id
    public function article()
    {
        return $this->hasOne(Article::class);
    }

}
