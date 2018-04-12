<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // public function run()
    // {
        
    //     $this->call(RoleSeed::class);
    //     $this->call(UserSeed::class);
    //     $this->call(CurrencySeed::class);
    // }
    public function run()
    {
        $items = [
            
            ['id' => 1, 'title' => 'Administrator (can create other users)',],
            ['id' => 2, 'title' => 'Simple user',],

        ];

        foreach ($items as $item) {
            \App\Role::create($item);
        }
        
        $items = [
            
            ['id' => 1, 'name' => 'Admin', 'email' => 'admin@admin.com', 'password' => 'password', 'role_id' => 1, 'remember_token' => '', 'currency_id' => 1],

        ];

        foreach ($items as $item) {
            \App\User::create($item);
        }


        $items = [
            
            ['id' => 1, 'title' => 'USD', 'symbol' => '$', 'money_format_thousands' => ',', 'money_format_decimal' => '.', 'created_by_id' => 1],
            ['id' => 2, 'title' => 'EUR', 'symbol' => '€', 'money_format_thousands' => '.', 'money_format_decimal' => ',', 'created_by_id' => 1],
            ['id' => 3, 'title' => 'GBP', 'symbol' => '£', 'money_format_thousands' => '.', 'money_format_decimal' => ',', 'created_by_id' => 1],

        ];

        foreach ($items as $item) {
            \App\Currency::create($item);
        }


    }
}
