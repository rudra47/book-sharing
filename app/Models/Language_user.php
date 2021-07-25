<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class Language_user extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'languages';
    protected $fillable = ['id', 'name', 'created_by', 'valid'];

    public function scopeValid($query)
    {
        return $query->where('valid', 1);
    }
    public static function boot()
    {
        parent::userBoot();
    }
}
