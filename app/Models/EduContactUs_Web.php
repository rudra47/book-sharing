<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EduContactUs_Web extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'edu_contact_us';
    protected $fillable = ['id', 'name', 'email', 'phone', 'comment', 'valid'];

}
