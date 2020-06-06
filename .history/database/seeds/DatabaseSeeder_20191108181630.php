<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Vy Vy',
            'email' => 'vyvy@gmail.com',
            'birthday' => '1111-12-29',
            'password' => bcrypt('123456789')
        ]);
        DB::table('users')->insert([
            'name' => 'Vy Vy 2',
            'email' => 'vy@gmail.com',
            'birthday' => '1111-12-29',
            'password' => bcrypt('123456789')
        ]);

        DB::table('category')->insert([
            'title' => 'sport',
            'id_creator' => '1'
        ]);
        DB::table('category')->insert([
            'title' => 'love',
            'id_creator' => '2'
        ]);
        DB::table('category')->insert([
            'title' => 'something',
            'id_creator' => '2'
        ]);

        
        DB::table('poster')->insert([
            'title' => 'this is a title',
            'content' => 'this is a content',
            'id_creator' => '1',
            'viewnumber' => '99',
            'id_category' => '1'
        ]);

        DB::table('poster')->insert([
            'title' => 'this is a title 2',
            'content' => 'this is a content 2',
            'id_creator' => '1',
            'id_category' => '1'
        ]);
    }
}
