<?php

namespace App\Models;

use Exception;
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
    public  function classworks()
    {
        return $this->hasMany(Classwork::class, 'classroom_id', 'id');
    }
    public  function topics()
    {
        return $this->hasMany(Topic::class, 'classroom_id', 'id');
    }
    public function users()
    {
       return $this->belongsToMany(User::class, 'classroom_user', 'classroom_id', 'user_id', 'id', 'id')
       ->withPivot(['role','created_at']);
    }
    public function teachers()
    {
        return $this->users()->wherePivot('role', 'teacher');
    }
    public function students()
    {
        return $this->users()->wherePivot('role', 'student');
    }

    public function scopeActive(Builder $builder)
    {
        $builder->where('status', 'active');
    }
    public function scopeStatus(Builder $builder, $status)
    {
        $builder->where('status', $status);
    }

    public function join($user_id, $role = 'Student')
    {
        // DB::table('classroom_user')->insert([
        //     'classroom_id' => $classroom_id,
        //     'user_id' => Auth::id(),
        //     'role' => $role,
        //     'created_at' => now(),
        // ]);

        // nested of the code above ,  we can do it with relations
        $exists = $this->users()->where('user_id',$user_id)->exists();

        if ($exists) {
            throw new Exception('The User already exists');
        }

        return $this->users()->attach($user_id ,[
            'role' => $role,
            'created_at' => now(),
        ]);
    }
}
