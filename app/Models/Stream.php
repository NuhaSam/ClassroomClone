<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stream extends Model
{
    use HasFactory;

    public  $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'uuid' ,'content','link','created_at' ,'classroom_id' ,'user_id',
    ];

    public function getUpdatedAtColumn(){
        
    }
}
