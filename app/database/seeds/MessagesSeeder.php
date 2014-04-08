<?php

class MessagesSeeder extends Seeder {

    public function run()
    {
        DB::table('messages')->delete();

        User::create(array(
            'email' => 'foo@bar.com'
        ));
    }

}