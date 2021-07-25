<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class EduStudentSocialLinks_Web extends BaseModel
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'edu_student_social_links';
    protected $fillable = ['id', 'user_id', 'fb_link', 'twitter_link', 'linkedin_link', 'created_by', 'valid'];
    
    public function scopeValid($query)
    {
        $authId = Auth::id();
        return $query->where('created_by', $authId)->where('valid', 1);
    }
    
    public static function boot()
    {
        parent::TraineeBoot();
    }
}
