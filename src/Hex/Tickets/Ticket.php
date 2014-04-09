<?php  namespace Hex\Tickets;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model {

    protected $table = 'tickets';

    public function messages()
    {
        return $this->hasMany('Hex\Tickets\Message');
    }

    public function staffer()
    {
        return $this->belongsTo('Hex\Staff\Staffer', 'staff_id');
    }

    public function category()
    {
        return $this->belongsTo('Hex\Tickets\Category');
    }
} 