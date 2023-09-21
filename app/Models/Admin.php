<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
use Laravel\Fortify\TwoFactorAuthenticatable;


class Admin extends User
{
    use HasFactory,TwoFactorAuthenticatable;
}
