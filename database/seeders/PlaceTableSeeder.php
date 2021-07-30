<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Place;

class PlaceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            ['name' => 'Dhaka (DAC)', 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Barishal (BZL)', 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Garments & Textile', 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Chattogram (CGP)', 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Coxs Bazar (CXB)', 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Jashore (JSR)', 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Rajshahi (RJH)', 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Saidpur (SPD)', 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Sylhet (ZYL)', 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Singapore (SIN)', 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Guangzhou (CAN)', 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Muscat (MCT)', 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Kolkata (CCU)', 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Chennai (MAA)', 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Kuala Lumpur (KUL)', 'created_by' => 1, 'updated_by' => 1]
         ];


         foreach ($datas as $data) {
            Place::create($data);
         }
    }
}
