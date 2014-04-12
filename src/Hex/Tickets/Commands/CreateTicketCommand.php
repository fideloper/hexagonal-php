<?php  namespace Hex\Tickets\Commands; 

use Hex\Tickets\Message;
use Hex\Tickets\Category;
use Hex\Staff\Staffer;

class CreateTicketCommand {

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
     * @var Category
     */
    public $category;

    /**
     * @var \Hex\Staff\Staffer
     */
    public $staffer;

    /**
     * @var \Hex\Tickets\Message
     */
    public $message;

    public function __construct($subject, $name, $email, Category $category, Staffer $staffer, Message $message)
    {
        $this->subject = $subject;
        $this->name = $name;
        $this->email = $email;
        $this->category = $category;
        $this->staffer = $staffer;
        $this->message = $message;
    }
} 