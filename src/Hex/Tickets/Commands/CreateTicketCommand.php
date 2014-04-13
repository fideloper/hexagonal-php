<?php  namespace Hex\Tickets\Commands; 

use Hex\CommandBus\CommandInterface;

class CreateTicketCommand implements CommandInterface {

    /**
     * @var string
     */
    public $subject;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $email;

    /**
     * @var integer
     */
    public $category_id;

    /**
     * @var integer
     */
    public $staffer_id;

    /**
     * @var string
     */
    public $message;

    public function __construct($subject, $name, $email, $category_id, $staffer_id, $message)
    {
        $this->subject = $subject;
        $this->name = $name;
        $this->email = $email;
        $this->category_id = $category_id;
        $this->staffer_id = $staffer_id;
        $this->message = $message;
    }
} 