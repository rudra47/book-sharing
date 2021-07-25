<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book_web extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'books';
    protected $fillable = ['id', 'category_id', 'book_id', 'title', 'summery', 'number_of_page', 'author_id','country_id','language_id','finished_reading','available_status', 'created_by', 'book_thumb', 'valid'];

    public function scopeValid($query)
    {
        return $query->where('valid', 1);
    }
}
