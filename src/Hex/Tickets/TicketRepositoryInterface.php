<?php  namespace Hex\Tickets; 

use Hex\Staff\Staffer;

interface TicketRepositoryInterface {

    public function getStaffOpenTickets(Staffer $staffer, $limit=10);

    public function save(Ticket $model);
} 