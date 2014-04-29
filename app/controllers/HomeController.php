<?php

use Hex\CommandBus\CommandBus;
use Hex\Tickets\Commands\CreateTicketCommand;
use Hex\Validation\ValidationException;

class HomeController extends BaseController {

    /**
     * @var Hex\CommandBus\CommandBus
     */
    private $bus;

    public function __construct(CommandBus $bus)
    {
        $this->bus = $bus;
    }

    public function createTicket()
    {
        $command = new CreateTicketCommand( Input::all() );

        try {
            $this->bus->execute($command);
        } catch(ValidationException $e)
        {
            return Redirect::to('/tickets/new')->withErrors( $e->getErrors() );
        } catch(\DomainException $e)
        {
            return Redirect::to('/tickets/new')->withErrors( $e->getErrors() );
        }

        return Redirect::to('/tickets')->with(['message' => 'success!']);
    }

    /**
     * Just a test method
     */
    public function hello()
	{
		return \Hex\Tickets\Ticket::with('messages')
            ->with('category')
            ->with('staffer')
            ->find(1);
	}

    /**
     * Just a test method
     */
    public function tests()
    {
        $ticket = \Hex\Tickets\Ticket::find(1);
        return $ticket;

//        $ticket = new \Hex\Tickets\Ticket;
//
//        $ticket->addMessage( new \Hex\Tickets\Message );
//
//        $ticket->save();

        // Throws exception, there's no category set yet
        // and we need a category first
        //$ticket->setStaffer( new \Hex\Staff\Staffer );
    }

    /**
     * Just a test method
     */
    public function addstaff()
    {
        // Staffer ID 2 doesn't have category ID 2
        $staffer = \Hex\Staff\Staffer::with('categories')->find(3);

        // Ticket ID 1 is assigned category ID 2
        $ticket = \Hex\Tickets\Ticket::find(1);

        // This should fail, since staffer doesn't have
        // category 2
        //$ticket->setStaffer( $staffer );

        // We want this to reach the die() statement
        // Staffer 2 (assigned to ticket 1) doesn't have category 2
        $category = \Hex\Tickets\Category::find(2);
        $ticket->setCategory( $category );
        $ticket->setStaffer( $staffer );

        /* try...catch */ $ticket->save(); /*  around this */
    }

}