<?php  namespace Hex\Tickets\Handlers;

use Hex\Tickets\Ticket;
use Hex\Tickets\Category;
use Hex\Tickets\Message;
use Hex\Staff\Staffer;
use Hex\Tickets\Validators\CreateTicketValidator;
use Hex\CommandBus\HandlerInterface;
use Hex\CommandBus\CommandInterface;

class CreateTicketHandler implements HandlerInterface {

    /**
     * @var \Hex\Tickets\Validators\CreateTicketValidator
     */
    private $validator;

    public function __construct(CreateTicketValidator $validator)
    {
        $this->validator = $validator;
    }

    public function handle(CommandInterface $command)
    {
        $this->validate($command);
        $this->save($command);
    }

    protected function validate($command)
    {
        $this->validator->validate($command);
    }

    protected function save($command)
    {
        $message = new Message;
        $message->message = $command->message;

        $ticket = new Ticket;
        $ticket->subject = $command->subject;
        $ticket->name = $command->name;
        $ticket->email = $command->email;
        $ticket->setCategory( Category::find($command->category_id) );
        $ticket->setStaffer( Staffer::find($command->staffer_id) );
        $ticket->addMessage( $message );

        $ticket->save();
    }
} 