<?php  namespace src\Hex\Staff;

use Illuminate\Database\Eloquent\Model;

class Staffer extends Model {

    protected $table = 'staff';

    public function categories()
    {
        return $this->belongsToMany('Hex\Tickets\Category');
    }
} 