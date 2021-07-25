<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class BookRequests_user extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'book_requests';
    protected $fillable = ['id', 'book_id', 'sender_id', 'owner_id', 'status', 'status_update_time', 'created_by', 'valid'];

    public function scopeValid($query)
    {
        $authId = Auth::id();
        return $query->where('created_by', $authId)->where('valid', 1);
    }
    public static function boot()
    {
        parent::userBoot();
    }
}
