<?php

namespace Database\Seeders;

use App\Models\Region;
use App\Models\Variety;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil data varietas yang sudah ada untuk dihubungkan
        $typica = Variety::where('name', 'Typica')->first();
        $catimor = Variety::where('name', 'Catimor')->first();
        $liniS795 = Variety::where('name', 'Lini S795')->first();

        // 1. Buat Daerah Gayo dan hubungkan dengan beberapa varietas
        $gayo = Region::create([
            'name' => 'Gayo',
            'province' => 'Aceh',
            'description' => 'Terkenal dengan kopi Arabika body tebal dan rasa earthy.'
        ]);
        $gayo->varieties()->attach([$typica->id, $catimor->id]);

        // 2. Buat Daerah Kintamani
        Region::create([
            'name' => 'Kintamani',
            'province' => 'Bali',
            'description' => 'Memiliki karakter rasa fruity seperti jeruk karena tumpang sari.'
        ]);
        
        // 3. Buat Daerah Toraja dan hubungkan dengan varietas
        $toraja = Region::create([
            'name' => 'Toraja',
            'province' => 'Sulawesi Selatan',
            'description' => 'Rasa seimbang dengan notes rempah, body yang baik.'
        ]);
        $toraja->varieties()->attach($liniS795->id);
    }
}