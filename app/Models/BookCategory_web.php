<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookCategory_web extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'book_categories';
    protected $fillable = ['id', 'name', 'created_by', 'valid'];

    public function scopeValid($query)
    {
        return $query->where('valid', 1);
    }
}
