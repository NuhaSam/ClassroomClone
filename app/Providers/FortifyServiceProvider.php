<?php

namespace App\Providers;

// use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Laravel\Fortify\Contracts\LoginResponse;


use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\Admin;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
// use Laravel\Fortify\Contracts\LoginResponse as ContractsLoginResponse;
use Laravel\Fortify\Contracts\LogoutResponse;
use Laravel\Fortify\Fortify;
// use Laravel\Fortify\Http\Responses\LoginResponse;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if(request()->is('admin/','admin/*')){
            Config::set([
                'fortify.guard' =>'admin',
                'fortify.prefix' =>'admin',
                'fortify.passwords' =>'admins',
                'fortify.username' =>'username',
            ]);
        }

        // $this->app->instance(LoginResponse::class, new class implements LoginResponse {
        //     public function toResponse($request)
        //     {
        //         // dd(Auth::guard('admin')->user());
        //             // return redirect('topic/view');
        //             $user = Auth::guard('admin')->user();
        //             if($user instanceof Admin){
        //                 return redirect('/classroom/trashed/t/');
        //             // }
        //             return redirect()->route('classrooms.show');
        //             }
        //     }
        // });


        // $this->app->singleton(LoginResponse::class,function(){
        //     return new class implements LoginResponseContract
        //     {
            
        //         public function toResponse($request)
        //         {
        //             // $user = $request->user();
        //             // if(Auth::user()->role === "Admin"){
        //             //     return redirect()->route('admin');
        //             // }
        //             return redirect()->route('topic/view');
            
        //         }
        //     };
        //  });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        // Fortify::loginView('auth.login');
        // Fortify::registerView('auth.register');
        Fortify::viewPrefix('auth.');
        // Fortify::viewPrefix('auth');
        // Fortify::authenticateUsing(function ($request){
        //     $user = Admin::whereUsername($request->username)->first();
        //     if($user && Hash::check($request->password, $user->password)){
        //         return $user;
        //     }
        // });
        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
