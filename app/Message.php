<?php

namespace App;
use Illuminate\Support\Facades\Auth;
use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
     protected $fillable = ['conversation_id','sender','message'];


     public function user()
     {
     	return $this->belongsTo('App\User', 'sender');
     }

   	public function replies()
    {
        return $this->hasMany(Message::class, 'parent_id');
    }

     public function from()
     {
     	return $this->belongsTo(User::class, 'sender');
     }

	public function scopeExcerpt()
    {
    	return str_limit($this->message, 145);
    }
}
