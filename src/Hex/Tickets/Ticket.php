<?php  namespace src\Hex\Tickets; 

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model {

    protected $table = 'tickets';

    public function staffer()
    {
        return $this->hasOne('Hex\Staff\Staffer');
    }

    public function category()
    {
        return $this->hasOne('Hex\Tickets\Category');
    }
} 