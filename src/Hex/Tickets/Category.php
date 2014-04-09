<?php  namespace Hex\Tickets;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

    public function staff()
    {
        return $this->belongsToMany('Hex\Staff\Staffer');
    }

    public function tickets()
    {
        return $this->hasMany('Hex\Staff\Ticket');
    }
} 