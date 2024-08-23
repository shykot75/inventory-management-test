<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $suppliers = [
            ['supplier_name' => 'Supplier One', 'supplier_phone' => '01829164241'],
            ['supplier_name' => 'Supplier Two', 'supplier_phone' => '01829164241'],
            ['supplier_name' => 'Supplier Three', 'supplier_phone' => '01829164241'],
            ['supplier_name' => 'Supplier Four', 'supplier_phone' => '01829164241'],
        ];

        // Insert the categories into the database
        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }
    }
}
