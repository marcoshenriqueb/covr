<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = 'chats';

    public function user1()
    {
        return $this->belongsTo('App\User', 'user_1');
    }

    public function user2()
    {
        return $this->belongsTo('App\User', 'user_2');
    }

    public function messages()
    {
        return $this->hasMany('App\Message');
    }

    public function scopeLastMessages()
    {
        return $this->messages()->where('created_at', '>', \Carbon\Carbon::subHour())->get();;
    }
}
