<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Topic extends Model
{
    use HasFactory,SoftDeletes;

    const UPDATED_AT = null;
    const CREATED_AT = null;
    public $timestamps = false;
    
    protected $fillable =[ 'name',
    'classroom_id',
    'user_id',];

}

