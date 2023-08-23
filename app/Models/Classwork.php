<?php

namespace App\Models;

use App\Enums\ClassworkType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Classwork extends Model
{
    use HasFactory;

    const TYPE_ASSIGNMENT = ClassworkType::ASSIGNMENT;
    const TYPE_MATERIAL = ClassworkType::MATERIAL;
    const TYPE_QUESTION = ClassworkType::QUESTION;

    const PUBLISHED = 'published';
    const STATUS_DRAFT = 'published';

    protected $fillable = ['title', 'description', 'options', 'type', 'status', 'user_id', 'classroom_id', 'topic_id'];

    protected $casts = [
        'options' => 'json',
        'published_at' => 'datetime',
        // 'type' => ClassworkType::class,
    ];

    public static function booted()
    {
        static::creating(function (Classwork $classwork) {
            if (!$classwork->published_at) {
                $classwork->published_at = now();
            }
        });
    }
    public function getPublishedDateAttribute() {
        if($this->published_at){
            return $this->published_at->format('Y-m-d');
        }
    }
    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }
        public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function topics()
    {
        return $this->belongsTo(Topic::class, 'classwork_id', 'id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'classwork_user', 'classwork_id', 'user_id', 'id', 'id')
            ->withPivot(['grade', 'submitted_at', 'created_at', 'status'])
            ->using(ClassworkUser::class); // Model for Pivot Table
    }
    public function scopeFilter(Builder $builder,$filters){


        // return $filters['search']; 
        $builder->when($filters['search'] ?? '' , function ($builder, $value){
            $builder->where(function($builder) use ($value) {
                $builder->where('title', 'LIKE', "%{$value}%")
                ->orWhere('description', 'LIKE', "%{$value}%" );
            });
        })->when($filters['type'] ?? "" ,function($builder, $value){
            $builder->where('type', '=', "%{$value}%");
        });
    }
}
