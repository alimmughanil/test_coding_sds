<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['category'];

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
}