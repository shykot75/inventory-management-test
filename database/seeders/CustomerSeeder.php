<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [
            ['customer_name' => 'Customer One', 'customer_phone' => '01829164241'],
            ['customer_name' => 'Customer Two', 'customer_phone' => '01829164241'],
            ['customer_name' => 'Customer Three', 'customer_phone' => '01829164241'],
            ['customer_name' => 'Customer Four', 'customer_phone' => '01829164241'],
        ];

        // Insert the categories into the database
        foreach ($customers as $customer) {
            Customer::create($customer);
        }
    }
}
