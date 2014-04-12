<?php  namespace Hex\Tickets;

use DomainException;
use Hex\Staff\Staffer;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model {

    protected $table = 'tickets';

    protected $messageQueue = [];

    /**
     * Assign Staffer to Ticket
     * @param Staffer $staffer
     * @return $this
     * @throws \DomainException
     */
    public function setStaffer(Staffer $staffer)
    {
        if( ! $staffer->categories->contains( $this->category ) )
        {
            throw new DomainException('Staffer must be able to be assigned to Ticket\'s current Category: '.$this->category);
        }

        $this->staffer()->associate($staffer);

        return $this;
    }

    /**
     * Assign Category to Ticket
     * @param Category $category
     * @return $this
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

        return $this;
    }

    /**
     * Add a message to this ticket
     * @param Message $message
     * @return $this
     */
    public function addMessage(Message $message)
    {
        if( $this->open == false )
        {
            $this->open = true;
        }

        $this->messageQueue[] = $message;

        return $this;
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

        $saved = parent::save($options);

        $this->saveMessages();

        return $saved;
    }

    protected function saveMessages()
    {
        foreach( $this->messageQueue as $message )
        {
            $this->saveMessage($message);
        }
    }

    protected function saveMessage(Message $message)
    {
        // Check if dirty or doesn't exist?
        // Or doesn't matter?
        $this->messages()->save($message);
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