<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

        $now = new DateTime;
        $now = $now->format('Y-m-d H:i:s');

        // Category
        $categories = [];
        DB::table('categories')->delete();

        $categories[] = DB::table('categories')->insertGetId(['category' => 'Billing', 'created_at' => $now, 'updated_at' => $now]);
        $categories[] = DB::table('categories')->insertGetId(['category' => 'General', 'created_at' => $now, 'updated_at' => $now]);
        $categories[] = DB::table('categories')->insertGetId(['category' => 'Tech', 'created_at' => $now, 'updated_at' => $now]);
        $categories[] = DB::table('categories')->insertGetId(['category' => 'Feature Request', 'created_at' => $now, 'updated_at' => $now]);
        $categories[] = DB::table('categories')->insertGetId(['category' => 'Reporting', 'created_at' => $now, 'updated_at' => $now]);

        // Staff
        DB::table('staff')->delete();
        $staffers = [];

        $staffers[] = DB::table('staff')->insertGetId(['email' => 'email1@test.com', 'password' => 'password', 'created_at' => $now, 'updated_at' => $now]);
        $staffers[] = DB::table('staff')->insertGetId(['email' => 'email2@test.com', 'password' => 'password', 'created_at' => $now, 'updated_at' => $now]);
        $staffers[] = DB::table('staff')->insertGetId(['email' => 'email2@test.com', 'password' => 'password', 'created_at' => $now, 'updated_at' => $now]);

        // Match Categories to Staff
        $stafferCategory = [];
        foreach($staffers as $stafferId)
        {
            $stafferCategory[$stafferId] = [];
            $tempCats = $categories;

            // Anywhere from 3-5 categories
            $numberCategories = mt_rand(3, 5);
            for($i=0; $i<$numberCategories; $i++)
            {
                $key = array_rand($tempCats, 1);
                $stafferCategory[$stafferId][] = $tempCats[$key];
                DB::table('category_staffers')->insert(['staffer_id' => $stafferId, 'category_id' => $tempCats[$key]]);
                unset($tempCats[$key]);
            }
        }

        // Tickets
        DB::table('tickets')->delete();
        $tickets = [];

        $randomStaffer = array_rand($staffers, 1);
        $categoryForStaffer = array_rand($stafferCategory[$randomStaffer], 1);
        $tickets[] = DB::table('tickets')->insertGetId([
            'category_id' => $categoryForStaffer,
            'staff_id' => $randomStaffer,
            'subject' => 'Subject Number One',
            'name' => 'Some Bloak',
            'email' => 'some@email.com',
            'open' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $randomStaffer = array_rand($staffers, 1);
        $categoryForStaffer = array_rand($stafferCategory[$randomStaffer], 1);
        $tickets[] = DB::table('tickets')->insertGetId([
            'category_id' => $categoryForStaffer,
            'staff_id' => $randomStaffer,
            'subject' => 'Subject Number One',
            'name' => 'Some Bloak',
            'email' => 'some@email.com',
            'open' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $randomStaffer = array_rand($staffers, 1);
        $categoryForStaffer = array_rand($stafferCategory[$randomStaffer], 1);
        $tickets[] = DB::table('tickets')->insertGetId([
            'category_id' => $categoryForStaffer,
            'staff_id' => $randomStaffer,
            'subject' => 'Subject Number One',
            'name' => 'Some Bloak',
            'email' => 'some@email.com',
            'open' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // Messages
        DB::table('messages')->delete();
        $messages = [];

        foreach( $tickets as $ticketId )
        {
            // Anywhere from 1-3 messages
            $number = mt_rand(1, 3);
            for($i=0; $i < $number; $i++)
            {
                $messages[] = DB::table('messages')->insertGetId([
                    'ticket_id' => $ticketId,
                    'message' => 'Lorem Ipsum Message',
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }
	}

}