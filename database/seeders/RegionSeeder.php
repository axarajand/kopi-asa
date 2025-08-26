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
        // Ambil semua data varietas yang relevan untuk dihubungkan
        // Ini lebih efisien daripada melakukan query berulang kali di dalam loop
        $varieties = Variety::all()->keyBy('name');

        // === Sumatra ===
        $gayo = Region::create([
            'name' => 'Gayo',
            'province' => 'Aceh',
            'description' => 'Terkenal dengan kopi Arabika body tebal, keasaman rendah, dan rasa earthy yang kompleks.'
        ]);
        if (isset($varieties['Gayo 1'], $varieties['Gayo 2'], $varieties['Typica'])) {
            $gayo->varieties()->attach([$varieties['Gayo 1']->id, $varieties['Gayo 2']->id, $varieties['Typica']->id]);
        }

        $sidikalang = Region::create([
            'name' => 'Sidikalang',
            'province' => 'Sumatra Utara',
            'description' => 'Memiliki karakter rasa yang kuat, body tebal, dan tingkat keasaman yang rendah, seringkali dengan notes coklat.'
        ]);
        if (isset($varieties['Sigarar Utang'], $varieties['Lini S795'])) {
            $sidikalang->varieties()->attach([$varieties['Sigarar Utang']->id, $varieties['Lini S795']->id]);
        }
        
        $lintong = Region::create([
            'name' => 'Lintong',
            'province' => 'Sumatra Utara',
            'description' => 'Dekat Danau Toba, dikenal dengan notes manis, kompleksitas earthy, dan aftertaste yang bersih.'
        ]);
        if (isset($varieties['Lini S795'], $varieties['Sigarar Utang'])) {
            $lintong->varieties()->attach([$varieties['Lini S795']->id, $varieties['Sigarar Utang']->id]);
        }

        // === Jawa ===
        $javaPreanger = Region::create([
            'name' => 'Java Preanger',
            'province' => 'Jawa Barat',
            'description' => 'Kopi legendaris Indonesia dengan keasaman seimbang, rasa earthy, dan aftertaste rempah.'
        ]);
        if (isset($varieties['Typica'], $varieties['Lini S795'])) {
            $javaPreanger->varieties()->attach([$varieties['Typica']->id, $varieties['Lini S795']->id]);
        }
        
        $dampit = Region::create([
            'name' => 'Dampit, Malang',
            'province' => 'Jawa Timur',
            'description' => 'Salah satu sentra utama Robusta di Jawa Timur, dikenal dengan rasa yang kuat, pahit khas, dan body tebal.'
        ]);
        if (isset($varieties['Tugusari'], $varieties['BP 358'])) {
            $dampit->varieties()->attach([$varieties['Tugusari']->id, $varieties['BP 358']->id]);
        }

        // === Bali & Nusa Tenggara ===
        $kintamani = Region::create([
            'name' => 'Kintamani',
            'province' => 'Bali',
            'description' => 'Memiliki karakter rasa fruity seperti jeruk karena tumpang sari dengan kebun jeruk. Keasaman cerah.'
        ]);
        if (isset($varieties['Typica'], $varieties['Bourbon'])) {
            $kintamani->varieties()->attach([$varieties['Typica']->id, $varieties['Bourbon']->id]);
        }
        
        $floresBajawa = Region::create([
            'name' => 'Flores Bajawa',
            'province' => 'Nusa Tenggara Timur',
            'description' => 'Karakter manis dengan aroma bunga dan sedikit notes kayu manis. Body tebal.'
        ]);
        if (isset($varieties['Typica'], $varieties['Catimor'])) {
            $floresBajawa->varieties()->attach([$varieties['Typica']->id, $varieties['Catimor']->id]);
        }

        // === Sulawesi ===
        $toraja = Region::create([
            'name' => 'Toraja',
            'province' => 'Sulawesi Selatan',
            'description' => 'Rasa seimbang dengan notes rempah (dark chocolate & herbs), body yang baik dan keasaman rendah.'
        ]);
        if (isset($varieties['Lini S795'], $varieties['Typica'])) {
            $toraja->varieties()->attach([$varieties['Lini S795']->id, $varieties['Typica']->id]);
        }

        // === Papua ===
        $wamena = Region::create([
            'name' => 'Wamena',
            'province' => 'Papua Pegunungan',
            'description' => 'Ditanam di ketinggian sangat tinggi, menghasilkan body penuh dengan keasaman sedang dan aroma floral.'
        ]);
        if (isset($varieties['Typica'])) {
            $wamena->varieties()->attach($varieties['Typica']->id);
        }
    }
}