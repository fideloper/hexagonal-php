<?php

use Hex\Core\ValidationException;

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

    public function createTicket()
    {
        // Exposing domain layer here.
        // This should be taken care of in a repository
        // Within the command handler
        $category = \Hex\Tickets\Category::find( 2 );
        $staffer = \Hex\Staff\Staffer::find( 1 );
        $message = new \Hex\Tickets\Message;
        $message->message = 'Some text from this request';

        $command = new \Hex\Tickets\Commands\CreateTicketCommand('some subject', 'some name', 'some@email.com', $category, $staffer, $message);
        $validator = new \Hex\Tickets\Validators\CreateTicketValidator( App::make('validator') );
        $handler = new \Hex\Tickets\Handlers\CreateTicketHandler( $validator );

        try {
            $handler->handle($command);
        } catch(ValidationException $e)
        {
            // Get errors and respond with view
            var_dump( $e->getErrors() );
        }

        // Redirect to success
    }

	public function hello()
	{
		return \Hex\Tickets\Ticket::with('messages')
            ->with('category')
            ->with('staffer')
            ->find(1);
	}

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