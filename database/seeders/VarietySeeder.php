<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Variety;

class VarietySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Variety::create(['name' => 'Typica', 'species' => 'Arabika', 'notes' => 'Cita rasa bersih dan manis, keasaman seimbang.']);
        Variety::create(['name' => 'Bourbon', 'species' => 'Arabika', 'notes' => 'Rasa manis kompleks seperti karamel dan buah.']);
        Variety::create(['name' => 'Lini S795', 'species' => 'Arabika', 'notes' => 'Populer di Indonesia, tahan penyakit, ada jejak rasa rempah.']);
        Variety::create(['name' => 'Catimor', 'species' => 'Arabika', 'notes' => 'Produktivitas tinggi dengan body yang tebal.']);
        Variety::create(['name' => 'Sigarar Utang', 'species' => 'Arabika', 'notes' => 'Varietas unggul dari Sumatra Utara, sangat cepat panen.']);
        Variety::create(['name' => 'Tugusari', 'species' => 'Robusta', 'notes' => 'Klon lokal populer dengan ketahanan dan produktivitas baik.']);
        Variety::create(['name' => 'BP 358', 'species' => 'Robusta', 'notes' => 'Klon unggul klasik dari Puslitkoka Jember.']);
        Variety::create(['name' => 'Liberika Tungkal', 'species' => 'Liberika', 'notes' => 'Khas lahan gambut Jambi dengan aroma nangka.']);
        Variety::create(['name' => 'Excelsa Temanggung', 'species' => 'Excelsa', 'notes' => 'Rasa tajam dan fruity dari lereng Sumbing-Sindoro.']);
    }
}
