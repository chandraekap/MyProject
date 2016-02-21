<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $tables = 'messages';
    protected $fillable = ['sender_id', 'receiver_id', 'title'];

    public function details()
    {
        return $this->hasMany('App\MessageDetail', 'message_id', 'id');
    }

    public function sender()
    {
        return $this->belongsTo('App\User', 'sender_id', 'id');
    }

    public function receiver()
    {
        return $this->belongsTo('App\User', 'receiver_id', 'id');
    }
}
