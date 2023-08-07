<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Classroom extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'subject', 'section', 'room', 'code', 'status', 'user_id'];
    //MANU-TO-MANY
    /**
     *   public function users()
     *  {
     *     return $this->belongsToMany(User::class, 'classroom_user');
     * } 
     */
    protected static function booted()
    {
        static::addGlobalScope('userClassroom', function (Builder $builder) {
            $builder->where('user_id', Auth::id())
                ->orWhereRaw('id in (SELECT classroom_id FROM classroom_user WHERE user_id = ?)', [Auth::id()]);
        });
    }
    public function scopeActive(Builder $builder)
    {
        $builder->where('status', 'active');
    }
    public function scopeStatus(Builder $builder, $status)
    {
        $builder->where('status', $status);
    }

    public function join($classroom_id, $role = 'Student')
    {
        DB::table('classroom_user')->insert([
            'classroom_id' => $classroom_id,
            'user_id' => Auth::id(),
            'role' => $role,
            'created_at' => now(),
        ]);
    }
}
