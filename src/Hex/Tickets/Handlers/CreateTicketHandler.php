<?php  namespace Hex\Tickets\Handlers;

use Hex\Tickets\Ticket;
use Hex\Tickets\Validators\CreateTicketValidator;

class CreateTicketHandler {

    /**
     * @var \Hex\Tickets\Validators\CreateTicketValidator
     */
    private $validator;

    public function __construct(CreateTicketValidator $validator)
    {
        $this->validator = $validator;
    }

    public function handle($command)
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
        $ticket = new Ticket;
        $ticket->subject = $command->subject;
        $ticket->name = $command->name;
        $ticket->email = $command->email;
        $ticket->setCategory( $command->category );
        $ticket->setStaffer( $command->staffer );
        $ticket->addMessage( $command->message );

        $ticket->save();
    }
} 