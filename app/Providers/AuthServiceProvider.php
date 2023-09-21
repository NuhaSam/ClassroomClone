<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Classroom;
use App\Models\Classwork;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('classworks.view', function (User $user, Classwork $classwork) {
            $teacher = $user->classrooms()
            ->withoutGlobalScopes()->wherePivot('classroom_id', $classwork->classroom_id)
                ->wherePivot('role', 'teacher')->exists();

            $assigned = $user->classworks()->wherePivot('classwork_id', $classwork->id)->exists();

            return ($teacher || $assigned);
        });
        Gate::define('classworks.create', function (User $user, Classroom $classroom) {
            return $user->classrooms()
                ->withoutGlobalScopes()
                ->wherePivot('classroom_id', $classroom->id)
                ->wherePivot('role', 'teacher')
                ->exists();
        });
        Gate::define('submissions.create', function (User $user, Classwork $classwork) {
            $teacher =  $user->classrooms()
                ->withoutGlobalScopes()
                ->wherePivot('classroom_id', $classwork->classroom_id)
                ->wherePivot('role', 'teacher')
                ->exists();
            if ($teacher) {
                return false;
            }
            return $user->classworks()->wherePivot('classwork_id', $classwork->id)->exists();
        });

        Gate::define('people.delete', function(User $user, $classroom) {
            return $user->classrooms()->withoutGlobalScopes()->wherePivot('classroom_id', $classroom->id)->wherePivot('role','teacher')->exists();
        });
        Gate::define('classworks.manage', function(User $user, $classwork) {
            return $user->classrooms()->withoutGlobalScopes()->wherePivot('classroom_id', $classwork->classroom_id)->wherePivot('role','teacher')->exists();
        });

    }
}
