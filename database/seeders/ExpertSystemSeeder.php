<?php

namespace Database\Seeders;

use App\Models\Disease;
use App\Models\Rule;
use App\Models\Symptom;
use App\Models\Treatment;
use Illuminate\Database\Seeder;

class ExpertSystemSeeder extends Seeder
{
    public function run()
    {
        // Diseases
        $diseases = [
            ['code' => 'P01', 'name' => 'Pullorum'],
            ['code' => 'P02', 'name' => 'Fowl Cholera'],
            ['code' => 'P03', 'name' => 'Newcastle Disease'],
            ['code' => 'P04', 'name' => 'Infectious Bursal Disease'],
            ['code' => 'P05', 'name' => 'Chronic Respiratory Disease'],
            ['code' => 'P06', 'name' => 'Fowl Typhoid'],
            ['code' => 'P07', 'name' => 'Avian Influenza'],
            ['code' => 'P08', 'name' => 'Infectious Coryza'],
        ];

        foreach ($diseases as $d) {
            Disease::create([
                'code' => $d['code'],
                'name' => $d['name'],
                'description' => $d['name'], // Default description
            ]);
        }

        // Symptoms
        $symptoms = [
            'G01' => 'Nafsu makan menurun',
            'G02' => 'Diare keputihan / kotoran putih',
            'G03' => 'Sayap menggantung',
            'G04' => 'Kotoran putih menempel di anus / kloaka',
            'G05' => 'Jengger keabuan / mengkerut',
            'G06' => 'Bulu kusam',
            'G07' => 'Lesu / mengantuk',
            'G08' => 'Gangguan gerak (lumpuh)',
            'G09' => 'Bergerombol mencari tempat hangat',
            'G10' => 'Bulu sayap kusut',
            'G11' => 'Mata menutup',
            'G12' => 'Luka bergerombol',
            'G13' => 'Sesak nafas / mengap-mengap',
            'G14' => 'Pembengkakan sinus / wajah',
            'G15' => 'Diare berlendir',
            'G16' => 'Kotoran encer bercampur butiran putih',
            'G17' => 'Demam',
            'G18' => 'Diare kehijauan',
            'G19' => 'Pembengkakan pial',
            'G20' => 'Nafas ngorok',
            'G21' => 'Keluar cairan dari hidung',
            'G22' => 'Bersin-bersin',
            'G23' => 'Batuk',
            'G24' => 'Gangguan keseimbangan / kepala berputar',
            'G25' => 'Jengger dan kepala kebiruan',
            'G26' => 'Kornea mata keruh',
            'G27' => 'Tremor / gemetaran',
            'G28' => 'Peradangan dubur / kloaka',
            'G29' => 'Paruh menempel ke lantai',
            'G30' => 'Kaki pincang',
            'G31' => 'Diare berlendir mengotori bulu pantat',
            'G32' => 'Mematuk daerah kloaka',
            'G33' => 'Tidur dengan paruh menempel di lantai',
            'G34' => 'Duduk membungkuk',
            'G35' => 'Badan kurus',
            'G36' => 'Bintik-bintik kuning',
            'G37' => 'Muka pucat',
            'G38' => 'Eskudat berbuih pada mata',
            'G39' => 'Menggelengkan kepala',
            'G40' => 'Nanah dari hidung',
            'G41' => 'Pernapasan melalui mulut',
            'G42' => 'Mata berair',
            'G43' => 'Jengger pucat',
            'G44' => 'Kepala tertunduk',
            'G45' => 'Tampak membiru',
            'G46' => 'Kepala bengkak',
            'G47' => 'Mati mendadak',
            'G48' => 'Jengger membengkak dan kebiruan',
            'G49' => 'Pendarahan gusi',
            'G50' => 'Pendarahan hidung',
            'G51' => 'Pendarahan bintik merah pada kaki',
            'G52' => 'Cairan dari mata dan hidung',
            'G53' => 'Cairan kental dari mulut',
            'G54' => 'Pendarahan bawah kulit',
            'G55' => 'Kematian sangat tinggi',
            'G56' => 'Kelopak mata kemerahan',
            'G57' => 'Nanah dari mata berbau',
        ];

        foreach ($symptoms as $code => $name) {
            Symptom::create([
                'code' => $code,
                'name' => $name,
                'image' => null,
            ]);
        }

        // Rules (Disease Code, Symptom Code, MB, MD)
        $rulesData = [
            // P01: Berak Kapur
            ['P01', 'G01', 0.8, 0.1],
            ['P01', 'G02', 0.9, 0.1],
            ['P01', 'G03', 0.8, 0.1],
            ['P01', 'G04', 0.9, 0.0],
            ['P01', 'G05', 0.9, 0.1],
            ['P01', 'G06', 0.8, 0.0],
            ['P01', 'G07', 0.8, 0.1],
            ['P01', 'G08', 0.8, 0.1],
            ['P01', 'G09', 0.9, 0.1],
            ['P01', 'G10', 0.5, 0.1],
            ['P01', 'G11', 0.5, 0.1],
            ['P01', 'G12', 0.5, 0.1],

            // P02: Kolera Ayam
            ['P02', 'G01', 0.8, 0.1],
            ['P02', 'G06', 0.8, 0.1],
            ['P02', 'G13', 0.6, 0.1],
            ['P02', 'G14', 0.8, 0.1],
            ['P02', 'G15', 0.8, 0.1],
            ['P02', 'G16', 0.7, 0.1],
            ['P02', 'G17', 0.7, 0.1],
            ['P02', 'G18', 0.8, 0.1],
            ['P02', 'G19', 0.7, 0.1],
            ['P02', 'G20', 0.8, 0.1],

            // P03: Tetelo
            ['P03', 'G01', 0.8, 0.1],
            ['P03', 'G03', 0.5, 0.1],
            ['P03', 'G07', 0.9, 0.1],
            ['P03', 'G08', 0.9, 0.1],
            ['P03', 'G13', 0.8, 0.1],
            ['P03', 'G16', 0.5, 0.1],
            ['P03', 'G18', 0.9, 0.1],
            ['P03', 'G21', 0.8, 0.1],
            ['P03', 'G20', 0.8, 0.1],
            ['P03', 'G22', 0.7, 0.1],
            ['P03', 'G23', 0.8, 0.1],
            ['P03', 'G24', 0.9, 0.1],
            ['P03', 'G25', 0.9, 0.1],
            ['P03', 'G26', 0.5, 0.1],

            // P04: Gumboro Disease
            ['P04', 'G01', 0.9, 0.1],
            ['P04', 'G02', 0.9, 0.1],
            ['P04', 'G03', 0.5, 0.1],
            ['P04', 'G06', 0.5, 0.1],
            ['P04', 'G07', 0.8, 0.1],
            ['P04', 'G27', 0.7, 0.1],
            ['P04', 'G28', 0.9, 0.1],
            ['P04', 'G29', 0.6, 0.1],
            ['P04', 'G30', 0.5, 0.1],
            ['P04', 'G31', 0.8, 0.1],
            ['P04', 'G32', 0.8, 0.1],
            ['P04', 'G33', 0.6, 0.1],
            ['P04', 'G34', 0.6, 0.1],

            // P05: CRD
            ['P05', 'G01', 0.8, 0.1],
            ['P05', 'G21', 0.9, 0.1],
            ['P05', 'G20', 0.9, 0.1],
            ['P05', 'G22', 0.6, 0.1],
            ['P05', 'G35', 0.7, 0.1],
            ['P05', 'G36', 0.5, 0.1],
            ['P05', 'G37', 0.5, 0.1],
            ['P05', 'G38', 0.5, 0.1],
            ['P05', 'G39', 0.5, 0.1],
            ['P05', 'G40', 0.5, 0.1],
            ['P05', 'G41', 0.6, 0.1],
            ['P05', 'G42', 0.7, 0.1],

            // P06: Tipus Ayam
            ['P06', 'G01', 0.8, 0.1],
            ['P06', 'G03', 0.5, 0.1],
            ['P06', 'G06', 0.5, 0.1],
            ['P06', 'G18', 0.8, 0.1],
            ['P06', 'G43', 0.5, 0.1],
            ['P06', 'G44', 0.5, 0.1],

            // P07: Flu Burung
            ['P07', 'G08', 0.2, 0.1],
            ['P07', 'G31', 0.5, 0.1],
            ['P07', 'G37', 0.8, 0.1],
            ['P07', 'G45', 0.8, 0.1],
            ['P07', 'G46', 0.6, 0.1],
            ['P07', 'G47', 0.8, 0.1],
            ['P07', 'G48', 0.8, 0.1],
            ['P07', 'G49', 0.8, 0.1],
            ['P07', 'G50', 0.8, 0.1],
            ['P07', 'G51', 0.8, 0.1],
            ['P07', 'G52', 0.5, 0.1],
            ['P07', 'G53', 0.5, 0.1],
            ['P07', 'G54', 0.8, 0.1],
            ['P07', 'G55', 0.8, 0.1],

            // P08: Salesma Ayam
            ['P08', 'G13', 0.8, 0.1],
            ['P08', 'G14', 0.9, 0.1],
            ['P08', 'G22', 0.8, 0.1],
            ['P08', 'G52', 0.8, 0.1],
            ['P08', 'G56', 0.8, 0.1],
            ['P08', 'G57', 0.9, 0.1],
        ];

        foreach ($rulesData as $r) {
            $disease = Disease::where('code', $r[0])->first();
            $symptom = Symptom::where('code', $r[1])->first();

            if ($disease && $symptom) {
                Rule::create([
                    'disease_id' => $disease->id,
                    'symptom_id' => $symptom->id,
                    'mb' => $r[2],
                    'md' => $r[3],
                ]);
            }
        }
        // Treatments
        $treatments = [
            // P01: Berak Kapur
            ['P01', 'Melakukan sanitasi kandang (kandang dibersihkan, dicuci, dan disemprot dengan disinfektan), mencegah tamu, hewan liar dan peliharaan lain masuk ke lingkungan kandang.'],
            ['P01', 'Peralatan peternakan (tempat ransum, tempat minum) dicuci sampai bersih.'],
            ['P01', 'Jumlah ayam dalam kandang tidak terlalu padat, ventilasi dalam kandang cukup.'],

            // P02: Kolera Ayam
            ['P02', 'Melakukan sanitasi kandang, yaitu kandang dibersihkan, dicuci dan disemprot dengan disinfektan.'],
            ['P02', 'Pemberantasan vektor pembawa penyakit seperti tikus dan lalat.'],
            ['P02', 'Peralatan peternakan (tempat ransum, tempat minum) dicuci sampai bersih dan lakukan disinfeksi.'],

            // P03: Tetelo
            ['P03', 'Batasi lalu lintas orang atau kendaran yang kerap masuk kandang.'],
            ['P03', 'Sanitasi air minum dengan memberikan antiseptik.'],
            ['P03', 'Sanitasi tempat minum.'],
            ['P03', 'Lakukan vaksinasi Newcastle Disease secara tepat.'],

            // P04: Gumboro Disease
            ['P04', 'Program vaksinasi Gumboro yang tepat.'],
            ['P04', 'Optimalkan masa persiapan kandang.'],
            ['P04', 'Peternakan dikelola baik supaya tercipta suasana nyaman bagi ayam.'],
            ['P04', 'Peralatan peternakan (tempat ransum, tempat minum) dicuci sampai bersih dan lakukan disinfeksi.'],

            // P05: CRD
            ['P05', 'Melakukan sanitasi kandang (kandang dibersihkan, dicuci, dan disemprot dengan disinfektan), mencegah tamu, hewan liar dan peliharaan lain masuk ke lingkungan kandang.'],
            ['P05', 'Peralatan peternakan (tempat ransum, tempat minum) dicuci sampai bersih dan lakukan disinfeksi.'],
            ['P05', 'Terapkan manajemen peternakan dengan baik.'],

            // P06: Tipus Ayam
            ['P06', 'Melakukan sanitasi kandang (kandang dibersihkan, dicuci, dan disemprot dengan disinfektan), mencegah tamu, hewan liar dan peliharaan lain masuk ke lingkungan kandang.'],
            ['P06', 'Peralatan peternakan (tempat ransum, tempat minum) dicuci sampai bersih dan lakukan disinfeksi.'],
            ['P06', 'Menggunakan bibit atau DOC yang bebas Salmonella Gallinarum.'],

            // P07: Flu Burung
            ['P07', 'Lakukan vaksinasi Avian Influenza secara tepat (jadwal vaksinasi, kualitas vaksin, tata laksana vaksinasi yang sesuai dan kondisi ayam saat divaksin).'],
            ['P07', 'Monitoring atau pemantauan titer antibodi Avian Influenza secara rutin.'],
            ['P07', 'Biosekuriti, batasi lalu lintas orang atau kendaran yang kerap masuk kandang, hindari kontak dengan unggas atau hewan lain.'],

            // P08: Salesma Ayam
            ['P08', 'Vaksinasi Coryza.'],
            ['P08', 'Perbaikan tata laksana pemeliharaan, pemeliharaan ayam all in all out untuk mencegah penularan dari ayam tua ke ayam muda.'],
            ['P08', 'Pemberian vitamin dan elektrolit untuk menjaga stamina tubuh ayam.'],
            ['P08', 'Penerapan biosekuriti yang tepat: istirahat kandang selama minimal 2 minggu setelah pembersihan dan disinfeksi kandang, penyemprotan kandang setiap 1 sampai 2 minggu sekali, sanitasi dan disinfeksi peralatan kandang.'],
        ];

        foreach ($treatments as $t) {
            $disease = Disease::where('code', $t[0])->first();
            if ($disease) {
                Treatment::create([
                    'disease_id' => $disease->id,
                    'treat' => $t[1],
                ]);
            }
        }
    }
}
