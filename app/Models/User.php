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

    //Выстраивание отношения many-to-many (Мои друзья)
    public function friendsOfMain()
    {
        return $this->belongsToMany('App\Models\User', 'friends', 'user_id', 'friend_id');
    }

    //Выстраивание отношения many-to-many (Друзья)
    public function friendOf()
    {
        return $this->belongsToMany('App\Models\User', 'friends', 'friend_id', 'user_id');
    }

    // получить друзей
    public function friends()
    {
        //  Фильтрация резульатов,возвращенных методом belongsToMany(),где нужно задать определенный параметр(true)
        // Для вывода пользователей,у которых accepted в положение true
        return $this->friendsOfMain()->wherePivot('accepted', true)->get()
              //Для обоюдного отображения друг жруга в друзьях(двусторонняя связь)
              //Доджен пожтвердить заявку(true  с обеих сторон)
              ->merge( $this->friendOf()->wherePivot('accepted', true)->get() );
    }

    // Запросы в друзья
    public function friendRequests()
    {
        return $this->friendsOfMain()->wherePivot('accepted', false)->get();
    }

    //Получить значение если заявка в друзья не принята
    public function friendRequestPending()
    {
        return $this->friendOf()->wherePivot('accepted', false)->get();
    }
    //Есть запрос на добавление в друзья
    public function hasFriendRequestPending(User $user)
    {
        return (bool) $this->friendRequestPending()->where('id', $user->id)->count();
    }

    // получил запрос о дружбе
    public function hasFriendRequestReceived(User $user)
    {
        return (bool) $this->friendRequests()->where('id', $user->id)->count();
    }

    //добавить друга
    public function addFriend(User $user)
    {
        $this->friendOf()->attach($user->id);
    }

    //Принять запрос на дружбу
    public function acceptFriendRequest()
    {
        $this->friendRequests()->where('id', $user->id)->first()->pivot()->update([
            'accepted' =>true
        ]);
    }

    //дружит с
    public function isFriendWith(User $user)
    {
        return (bool) $this->friends()->where('id', $user->id)->count();
    }
}
