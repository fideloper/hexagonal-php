<?php

class TicketSeeder extends Seeder {

    public function run()
    {
        DB::table('tickets')->delete();

        User::create(array(
            'email' => 'foo@bar.com'
        ));
    }

}