<?php  namespace src\Hex\Tickets;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

    public function staff()
    {
        return $this->belongsToMany('Hex\Staff\Staffer');
    }
} 