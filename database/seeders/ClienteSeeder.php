<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Cliente
        DB::table('clientes')->insert([
            'name' => 'Mariane',
            'address' => 'Rua Dom Marcos Barbosa',
            'cep' => '08485-200',
            'city' => 'São Paulo',
            'district' => 'Conjunto Habitacional Santa Etelvina II',
            'state' => 'SP',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('clientes')->insert([
            'name' => 'Roma',
            'address' => 'Rua Dom Marcos Barbosa',
            'cep' => '08485-200',
            'city' => 'São Paulo',
            'district' => 'Conjunto Habitacional Santa Etelvina II',
            'state' => 'SP',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
