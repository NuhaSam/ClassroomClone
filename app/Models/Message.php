<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory,HasUlids;

    protected $fillable = [
        'sender_id','recipient_id','recipient_type','body','id'
    ];

    public function sender(){
        return $this->belongsTo(User::class,'sender_id');
    }
    public function recipient(){
        return $this->morphTo();
    }
}
