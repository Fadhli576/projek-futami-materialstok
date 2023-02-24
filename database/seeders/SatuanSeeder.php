<?php

namespace Database\Seeders;

use App\Models\Satuan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SatuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $satuan = new Satuan;

        Satuan::create([
            'name'=>'PC'
        ]);

        Satuan::create([
            'name'=>'M'
        ]);

        Satuan::create([
            'name'=>'MM'
        ]);

        Satuan::create([
            'name'=>'EA'
        ]);

        Satuan::create([
            'name'=>'KG'
        ]);

        Satuan::create([
            'name'=>'CAN'
        ]);

        Satuan::create([
            'name'=>'PAC'
        ]);

        Satuan::create([
            'name'=>'L'
        ]);

        Satuan::create([
            'name'=>'STK'
        ]);

        Satuan::create([
            'name'=>'BT'
        ]);

        Satuan::create([
            'name'=>'FT'
        ]);

        Satuan::create([
            'name'=>'PAA'
        ]);

        Satuan::create([
            'name'=>'SET'
        ]);

        Satuan::create([
            'name'=>'ROL'
        ]);

        Satuan::create([
            'name'=>'GAL'
        ]);

    }
}
