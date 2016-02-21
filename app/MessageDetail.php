<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessageDetail extends Model
{
    protected $tables = 'message_details';
    protected $fillable = ['message_id', 'sender_id', 'message_body', 'read'];

    public function header()
    {
        return $this->belongsTo('App\Message', 'message_id', 'id');
    }

    public function sender()
    {
        return $this->belongsTo('App\User', 'sender_id', 'id');
    }
}
