<?php

class CategorySeeder extends Seeder {

    public function run()
    {
        DB::table('categories')->delete();

        DB::table('categories')->insert(array('category' => 'Billing'));
        DB::table('categories')->insert(array('category' => 'General'));
        DB::table('categories')->insert(array('category' => 'Tech'));
    }

}