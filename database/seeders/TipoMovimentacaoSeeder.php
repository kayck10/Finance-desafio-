<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoMovimentacaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipo_movimentacaos')->insert([
            ['nome' => 'Receita', 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Despesa', 'created_at' => now(), 'updated_at' => now()],
        ]);

    }
}
