<?php

class StaffSeeder extends Seeder {

    public function run()
    {
        DB::table('staff')->delete();

        User::create(array(
            'email' => 'foo@bar.com'
        ));
    }

}