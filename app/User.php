<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Auth;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nome', 'sobrenome', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function friends()
    {
      return $this->belongsToMany('App\User', 'users_users', 'user_id', 'friend_id')
       ->wherePivot('confirmed', '=', 1);;
    }

    public function requests()
    {
      return $this->belongsToMany('App\User', 'users_users', 'user_id', 'friend_id')
       ->wherePivot('confirmed', '=', 0);;
    }

    public function requested()
    {
      return $this->belongsToMany('App\User', 'users_users', 'friend_id', 'user_id')
       ->wherePivot('confirmed', '=', 0);;
    }

    public function requestFriend(User $user)
    {
        $this->requests()->attach($user->id);
    }

    public function removeRequest(User $user)
    {
        $this->requests()->detach($user->id);
    }

    public function confirmFriend(User $user)
    {
        $this->friends()->attach($user->id, ['confirmed' => 1]);
        $user->friends()->attach($this->id, ['confirmed' => 1]);
    }

    public function removeFriend(User $user)
    {
        $this->friends()->detach($user->id);
        $user->friends()->detach($this->id);
    }

    public function bids()
    {
        return $this->hasMany('App\Bid');
    }

    public function chats1()
    {
        return $this->hasMany('App\Chat', 'user_1');
    }

    public function chats2()
    {
        return $this->hasMany('App\Chat', 'user_2');
    }

    public function messages()
    {
        return $this->hasMany('App\Messages');
    }

    public function getFullName()
    {
        return $this->nome . ' ' . $this->sobrenome;
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function setPlaceIdAttribute($value)
    {
        $this->attributes['place_id'] = json_encode($value);
    }

    public function getProfilePicAttribute($value)
    {
        if (substr($value, 0, 4) == "http" || $value == null) {
          return $value;
        }else {
          return '/images/profile/' . $value;
        }
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('id', '!=', Auth::user()->id)
                     ->whereNotIn('id', Auth::user()->friends->modelKeys())
                     ->whereNotIn('id', Auth::user()->requests->modelKeys())
                     ->whereNotIn('id', Auth::user()->requested->modelKeys())
                     ->where(function($q) use ($search){
                       $q->where('nome', 'LIKE', "%$search%")
                         ->orWhere('sobrenome', 'LIKE', "%$search%")
                         ->orWhere('email', 'LIKE', "%$search%");
                     });
    }
}
