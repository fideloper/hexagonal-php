<?php  namespace Hex\Tickets;

use Illuminate\Database\Eloquent\Model;

class Message extends Model {

    protected $table = 'messages';

    public function ticket()
    {
        return $this->belongsTo('Hex\Tickets\Ticket');
    }

    public function __toString()
    {
        return $this->message;
    }
} 