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
        // === ARABIKA ===
        Variety::create(['name' => 'Typica', 'species' => 'Arabika', 'notes' => 'Salah satu varietas tertua dan paling penting. Cita rasa bersih, manis, dengan keasaman seimbang.']);
        Variety::create(['name' => 'Bourbon', 'species' => 'Arabika', 'notes' => 'Mutasi alami dari Typica. Dikenal dengan rasa manis kompleks seperti karamel dan buah.']);
        Variety::create(['name' => 'Gesha (Geisha)', 'species' => 'Arabika', 'notes' => 'Sangat terkenal karena profil rasa floral yang kompleks seperti melati dan teh. Berasal dari Ethiopia.']);
        Variety::create(['name' => 'Caturra', 'species' => 'Arabika', 'notes' => 'Mutasi dari Bourbon, kerdil, dan produktivitas tinggi. Keasaman cerah dengan body ringan.']);
        Variety::create(['name' => 'Pacamara', 'species' => 'Arabika', 'notes' => 'Hibrida dari Pacas dan Maragogipe. Ukuran biji sangat besar dengan profil rasa kompleks, seringkali floral dan herbal.']);
        Variety::create(['name' => 'SL28 & SL34', 'species' => 'Arabika', 'notes' => 'Dikembangkan di Kenya. Dikenal dengan keasaman intens seperti blackcurrant dan body yang tebal.']);
        Variety::create(['name' => 'Ethiopian Heirloom', 'species' => 'Arabika', 'notes' => 'Istilah umum untuk ribuan varietas liar asli dari Ethiopia, tempat lahirnya kopi.']);
        
        // === ROBUSTA ===
        Variety::create(['name' => 'Tugusari', 'species' => 'Robusta', 'notes' => 'Klon lokal populer dari Jawa Timur dengan ketahanan dan produktivitas baik.']);
        Variety::create(['name' => 'BP 358', 'species' => 'Robusta', 'notes' => 'Klon unggul klasik yang dirilis oleh Pusat Penelitian Kopi dan Kakao (Puslitkoka) Jember.']);
        Variety::create(['name' => 'SA 237', 'species' => 'Robusta', 'notes' => 'Klon lain dari Puslitkoka Jember, dikenal juga sebagai klon anjuran.']);

        // === LIBERIKA & EXCELSA ===
        Variety::create(['name' => 'Liberika Tungkal', 'species' => 'Liberika', 'notes' => 'Khas dari lahan gambut di Jambi, dengan aroma khas seperti nangka dan notes kayu.']);
        Variety::create(['name' => 'Excelsa Temanggung', 'species' => 'Excelsa', 'notes' => 'Rasa tajam dan fruity, sering ditemukan di lereng Sumbing-Sindoro, Jawa Tengah.']);
    
        // --- Varietas Penting di Indonesia (Arabika) ---
        Variety::create(['name' => 'Lini S795', 'species' => 'Arabika', 'notes' => 'Hibrida populer di Indonesia dan India, tahan penyakit karat daun. Ada jejak rasa rempah.']);
        Variety::create(['name' => 'Catimor', 'species' => 'Arabika', 'notes' => 'Hibrida dari Caturra dan Timor Hybrid. Produktivitas sangat tinggi dan tahan penyakit.']);
        Variety::create(['name' => 'Sigarar Utang', 'species' => 'Arabika', 'notes' => 'Varietas unggul dari Sumatra Utara, sangat cepat berbuah (genjah).']);
        Variety::create(['name' => 'Andungsari', 'species' => 'Arabika', 'notes' => 'Varietas dari Puslitkoka Jember, adaptif di dataran tinggi, rentan terhadap nematoda.']);
        Variety::create(['name' => 'Gayo 1', 'species' => 'Arabika', 'notes' => 'Klon lokal yang dikembangkan di Dataran Tinggi Gayo, Aceh.']);
        Variety::create(['name' => 'Gayo 2', 'species' => 'Arabika', 'notes' => 'Klon lokal lain dari Dataran Tinggi Gayo, Aceh, dengan karakteristik berbeda.']);
    }
}