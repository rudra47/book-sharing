<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class EduBlog_Web extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'edu_blogs';
    protected $fillable = ['id', 'title', 'image', 'description', 'status', 'created_by', 'valid'];

    public function scopeValid($query)
    {
        return $query->where('valid', 1)->where('status', 1);
    }
}