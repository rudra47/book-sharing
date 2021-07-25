<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class EduBlogComment_provider extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'edu_blog_comments';
    protected $fillable = ['id', 'blog_id', 'comment', 'status', 'created_by', 'valid'];

    public function scopeValid($query)
    {
        return $query->where('valid', 1);
    }
    public static function boot()
    {
        parent::providerBoot();
    }
}
