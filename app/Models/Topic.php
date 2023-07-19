<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    const UPDATED_AT = null;
    const CREATED_AT = null;
    public $timestamps = false;
    
    protected $fillable =[ 'name',
    'classroom_id',
    'user_id',];

}

