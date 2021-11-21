<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'email',
        'username',
        'password',
        'first_name',
        'last_name',
        'location',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getName()
    {
        //Если имя и фамилия существуют,то возвращаем их
        if ($this->first_name && $this->last_name)
        {
            return "{$this->first_name} {$this->last_name}";
        }
        //Если существоем только имя,то возвращаем его
        if ($this->first_name)
        {
            return $this->first_name;
        }

        return null;
    }

    public function getNameOrUsername()
    {
        //Если метод ничего не возващает,то возвращаем логин пользователя
        return $this->getName() ?: $this->username;
    }

    public function getFirstNameOrUsername()
    {
        //Возвращаем username если только First_name не указан
        return $this->first_name ?: $this->username;
    }


}
