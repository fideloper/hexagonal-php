<?php  namespace Hex\Tickets\Events; 

use Hex\Tickets\Ticket;
use Hex\Tickets\Message;
use Hex\Events\EventInterface;

class MessageAddedEvent implements EventInterface {

    /**
     * @var
     */
    private $ticket;

    /**
     * @var
     */
    private $message;

    public function __construct(Ticket $ticket, Message $message)
    {
        $this->ticket = $ticket;
        $this->message = $message;
    }

    /**
     * Return the event name
     * @return string
     */
    public function name()
    {
        return 'ticket.message.added';
    }
}