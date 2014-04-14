<?php  namespace Hex\Tickets; 

use Hex\Staff\Staffer;

class DbTicketRepository implements TicketRepositoryInterface {

    /**
     * @var Ticket
     */
    private $ticket;

    /**
     * @var Category
     */
    private $category;

    public function __construct(Ticket $ticket, Category $category)
    {
        $this->ticket = $ticket;
        $this->category = $category;
    }

    public function getStaffOpenTickets(Staffer $staffer, $limit=10)
    {
        return $this->ticket->where('staff_id', $staffer->id)->take($limit)->get();
    }

    public function save(Ticket $ticket)
    {
        $ticket->save();
    }
} 