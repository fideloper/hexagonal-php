<?php  namespace Hex\Tickets;

use DomainException;
use Hex\Staff\Staffer;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model {

    protected $table = 'tickets';

    /**
     * Assign Staffer to Ticket
     * @param Staffer $staffer
     * @throws \DomainException
     */
    public function setStaffer(Staffer $staffer)
    {
        if( ! $staffer->categories->contains( $this->category ) )
        {
            throw new DomainException('Staffer must be able to be assigned to Ticket\'s current Category: '.$this->category);
        }

        $this->staffer()->associate($staffer);
    }

    /**
     * Assign Category to Ticket
     * @param Category $category
     */
    public function setCategory(Category $category)
    {
        if( $this->staffer instanceof Staffer && ! $this->staffer->categories->contains( $category ) )
        {
            // Unset current Staffer
            // and set a "null staffer"
            $this->staffer = null;
        }

        $this->category()->associate($category);
    }

    /**
     * Add a message to this ticket
     * @param Message $message
     */
    public function addMessage(Message $message)
    {
        if( $this->open == false )
        {
            $this->open = true;
        }

        $this->messages()->save($message);
    }

    /**
     * Save Ticket, ensuring a Staffer and Category
     * is assigned
     * @param array $options
     * @return bool|void
     * @throws \DomainException
     */
    public function save(array $options = array())
    {
        // Do some testing before passing onto parent save method
        if( $this->staffer === null || $this->staffer->exists === false )
        {
            throw new DomainException('Ticket must be assigned a Staffer under Category: '.$this->category);
        }

        if( $this->category === null || $this->category->exists === false )
        {
            throw new DomainException('Ticket must be assigned a Category');
        }

        parent::save($options);
    }

    // Make these protected so they aren't publicly settable?
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