<?php

namespace Database\Seeders;

use App\Models\Disease;
use App\Models\Rule;
use App\Models\Symptom;
use Illuminate\Database\Seeder;

class ExpertSystemSeeder extends Seeder
{
    public function run()
    {
        // Diseases and Treatments
        $diseases = [
            [
                'disease_code' => 'P01',
                'name' => 'Pullorum',
                'description' => 'Penyakit bakteri pada ayam yang menyebabkan diare putih (berkapur), lemas, dan tingkat kematian tinggi.',
                'treatments' => 'Melakukan sanitasi kandang (kandang dibersihkan, dicuci, dan disemprot dengan disinfektan) serta mencegah tamu, hewan liar, dan peliharaan lain masuk ke lingkungan kandang. Peralatan peternakan (tempat ransum dan tempat minum) dicuci hingga bersih. Jumlah ayam dalam kandang tidak terlalu padat serta ventilasi kandang harus cukup.',
            ],
            [
                'disease_code' => 'P02',
                'name' => 'Fowl Cholera',
                'description' => 'Infeksi bakteri Pasteurella Multocida yang menyerang ayam dewasa, ditandai dengan pembengkakan dan diare berlendir.',
                'treatments' => 'Melakukan sanitasi kandang, yaitu kandang dibersihkan, dicuci, dan disemprot dengan disinfektan. Pemberantasan faktor pembawa penyakit seperti tikus dan lalat. Peralatan peternakan (tempat ransum dan tempat minum) dicuci hingga bersih dan dilakukan disinfeksi.',
            ],
            [
                'disease_code' => 'P03',
                'name' => 'Newcastle Disease',
                'description' => 'Penyakit yang disebabkan oleh Avian Paramyxovirus (APMV-1), sangat menular yang menyerang sistem pernapasan, pencernaan, dan saraf ayam.',
                'treatments' => 'Membatasi lalu lintas orang atau kendaraan yang masuk ke kandang. Melakukan sanitasi air minum dengan pemberian antiseptik. Melakukan sanitasi tempat minum. Melakukan vaksinasi Newcastle Disease secara tepat.',
            ],
            [
                'disease_code' => 'P04',
                'name' => 'Infectious Bursal Disease',
                'description' => 'Penyakit yang disebabkan oleh infeksi virus Avibirnavirus, menyerang sistem kekebalan (bursa Fabricius), menyebabkan penurunan daya tahan tubuh ayam.',
                'treatments' => 'Program vaksinasi Gumboro dilakukan secara tepat. Mengoptimalkan masa persiapan kandang. Peternakan dikelola dengan baik agar tercipta lingkungan yang nyaman bagi ayam. Peralatan peternakan (tempat ransum dan tempat minum) dicuci hingga bersih dan dilakukan disinfeksi.',
            ],
            [
                'disease_code' => 'P05',
                'name' => 'Chronic Respiratory Disease',
                'description' => 'Penyakit yang disebabkan dari bakteri Mycoplasma Gallisepticum yang menginfeksi saluran pernapasan.',
                'treatments' => 'Melakukan sanitasi kandang (kandang dibersihkan, dicuci, dan disemprot dengan disinfektan) serta mencegah tamu, hewan liar, dan peliharaan lain masuk ke lingkungan kandang. Peralatan peternakan (tempat ransum dan tempat minum) dicuci hingga bersih dan dilakukan disinfeksi. Menerapkan manajemen peternakan dengan baik.',
            ],
            [
                'disease_code' => 'P06',
                'name' => 'Fowl Typhoid',
                'description' => 'Penyakit yang disebabkan oleh sebuah bakteri yang bernama Salmonella Galinarum, menyebabkan ayam lemas dan diare kehijauan.',
                'treatments' => 'Melakukan sanitasi kandang (kandang dibersihkan, dicuci, dan disemprot dengan disinfektan) serta mencegah tamu, hewan liar, dan peliharaan lain masuk ke lingkungan kandang. Peralatan peternakan (tempat ransum dan tempat minum) dicuci hingga bersih dan dilakukan disinfeksi. Menggunakan bibit atau DOC yang bebas Salmonella Gallinarum.',
            ],
            [
                'disease_code' => 'P07',
                'name' => 'Avian Influenza',
                'description' => 'Penyakit virus berbahaya (flu burung) yang sangat menular dan dapat menyebabkan kematian massal.',
                'treatments' => 'Melakukan vaksinasi Avian Influenza secara tepat (meliputi jadwal vaksinasi, kualitas vaksin, tata laksana vaksinasi, serta kondisi ayam saat divaksin). Melakukan monitoring atau pemantauan titer antibodi Avian Influenza secara rutin. Menerapkan biosekuriti dengan membatasi lalu lintas orang atau kendaraan yang masuk ke kandang serta menghindari kontak dengan unggas atau hewan lain.',
            ],
            [
                'disease_code' => 'P08',
                'name' => 'Infectious Coryza',
                'description' => 'Penyakit gangguan pernapasan atas yang disebabkan oleh Avibacterium Paragallinarum',
                'treatments' => 'Melakukan vaksinasi Coryza. Melakukan perbaikan tata laksana pemeliharaan, termasuk penerapan sistem all in all out untuk mencegah penularan dari ayam tua ke ayam muda. Memberikan vitamin dan elektrolit untuk menjaga stamina tubuh ayam. Menerapkan biosekuriti yang tepat, yaitu istirahat kandang minimal 2 minggu setelah pembersihan dan disinfeksi, penyemprotan kandang setiap 1 sampai 2 minggu, serta sanitasi dan disinfeksi peralatan kandang.',
            ],
            [
                'disease_code' => 'P09',
                'name' => 'Coccidiosis',
                'description' => 'Penyakit usus akibat infeksi protozoa Eimeria yang mengganggu pencernaan dan penyerapan nutrisi serta dapat menyebabkan peradangan, kehilangan darah, dan meningkatkan risiko infeksi sekunder.',
                'treatments' => 'Melakukan sanitasi kandang (kandang dibersihkan, dicuci, dan disemprot dengan disinfektan) serta mencegah tamu, hewan liar, dan peliharaan lain masuk ke lingkungan kandang. Memberikan obat antikoksidia melalui pakan atau air minum. Peralatan peternakan (tempat ransum dan tempat minum) dicuci hingga bersih dan dilakukan disinfeksi.',
            ],
        ];

        foreach ($diseases as $d) {
            $disease = Disease::create([
                'disease_code' => $d['disease_code'],
                'name' => $d['name'],
                'description' => $d['description'],
                'treatment' => $d['treatments'],
            ]);
        }

        // Symptoms
        $symptoms = [
            'G01' => 'Nafsu makan menurun',
            'G02' => 'Diare keputihan',
            'G03' => 'Sayap menggantung',
            'G04' => 'Jengger kebiruan',
            'G05' => 'Lesu',
            'G06' => 'Mata menutup',
            'G07' => 'Diare kehijauan',
            'G08' => 'Pembengkakan pial',
            'G09' => 'Lumpuh',
            'G10' => 'Batuk',
            'G11' => 'Kepala berputar',
            'G12' => 'Kornea mata keruh',
            'G13' => 'Tremor atau gemetaran',
            'G14' => 'Peradangan anus',
            'G15' => 'Paruh menempel ke lantai',
            'G16' => 'Kaki pincang',
            'G17' => 'Mematuk daerah anus',
            'G18' => 'Duduk membungkuk',
            'G19' => 'Nafas ngorok',
            'G20' => 'Keluar cairan dari hidung',
            'G21' => 'Bersin-bersin',
            'G22' => 'Eksudat berbuih pada mata',
            'G23' => 'Nanah dari hidung',
            'G24' => 'Mata berair',
            'G25' => 'Kepala tertunduk',
            'G26' => 'Diare kekuningan',
            'G27' => 'Muka pucat',
            'G28' => 'Kepala bengkak',
            'G29' => 'Mati mendadak',
            'G30' => 'Pendarahan hidung',
            'G31' => 'Pendarahan bintik merah pada kaki',
            'G32' => 'Pembengkakan sinus',
            'G33' => 'Kelopak mata kemerahan',
            'G34' => 'Nanah dari mata berbau',
            'G35' => 'Diare berdarah',
            'G36' => 'Bulu Berdiri',
        ];

        foreach ($symptoms as $code => $name) {
            Symptom::create([
                'symptom_code' => $code,
                'name' => $name,
            ]);
        }

        // Rules (Disease Code, Symptom Code, MB, MD)
        $rulesData = [
            // P01: Pullorum
            ['P01', 'G01', 0.2, 0.0],
            ['P01', 'G02', 0.9, 0.0],
            ['P01', 'G03', 0.2, 0.0],
            ['P01', 'G05', 0.3, 0.0],
            ['P01', 'G06', 0.4, 0.0],

            // P02: Fowl Cholera
            ['P02', 'G01', 0.2, 0.0],
            ['P02', 'G05', 0.5, 0.0],
            ['P02', 'G07', 0.4, 0.0],
            ['P02', 'G08', 0.9, 0.0],

            // P03: Newcastle Disease
            ['P03', 'G01', 0.2, 0.0],
            ['P03', 'G03', 0.4, 0.0],
            ['P03', 'G04', 0.4, 0.0],
            ['P03', 'G05', 0.2, 0.0],
            ['P03', 'G07', 0.5, 0.0],
            ['P03', 'G09', 0.8, 0.0],
            ['P03', 'G10', 0.7, 0.0],
            ['P03', 'G11', 0.9, 0.0],
            ['P03', 'G12', 0.4, 0.0],

            // P04: Infectious Bursal Disease
            ['P04', 'G01', 0.2, 0.0],
            ['P04', 'G03', 0.2, 0.0],
            ['P04', 'G05', 0.2, 0.0],
            ['P04', 'G13', 0.7, 0.0],
            ['P04', 'G14', 0.8, 0.0],
            ['P04', 'G15', 0.7, 0.0],
            ['P04', 'G16', 0.4, 0.0],
            ['P04', 'G17', 0.7, 0.0],
            ['P04', 'G18', 0.5, 0.0],

            // P05: Chronic Respiratory Disease
            ['P05', 'G19', 0.8, 0.0],
            ['P05', 'G20', 0.3, 0.0],
            ['P05', 'G21', 0.6, 0.0],
            ['P05', 'G22', 0.7, 0.0],
            ['P05', 'G23', 0.8, 0.0],
            ['P05', 'G24', 0.4, 0.0],

            // P06: Fowl Typhoid
            ['P06', 'G01', 0.2, 0.0],
            ['P06', 'G03', 0.2, 0.0],
            ['P06', 'G04', 0.6, 0.0],
            ['P06', 'G25', 0.4, 0.0],
            ['P06', 'G26', 0.8, 0.0],

            // P07: Avian Influenza
            ['P07', 'G04', 0.8, 0.0],
            ['P07', 'G20', 0.2, 0.0],
            ['P07', 'G27', 0.4, 0.0],
            ['P07', 'G28', 0.5, 0.0],
            ['P07', 'G29', 0.8, 0.0],
            ['P07', 'G30', 0.9, 0.0],
            ['P07', 'G31', 0.7, 0.0],

            // P08: Infectious Coryza
            ['P08', 'G19', 0.4, 0.0],
            ['P08', 'G20', 0.4, 0.0],
            ['P08', 'G21', 0.6, 0.0],
            ['P08', 'G32', 0.7, 0.0],
            ['P08', 'G33', 0.7, 0.0],
            ['P08', 'G34', 0.8, 0.0],

            // P09: Coccidiosis
            ['P09', 'G01', 0.3, 0.0],
            ['P09', 'G27', 0.4, 0.0],
            ['P09', 'G35', 0.9, 0.0],
            ['P09', 'G36', 0.5, 0.0],
        ];

        foreach ($rulesData as $r) {
            $disease = Disease::where('disease_code', $r[0])->first();
            $symptom = Symptom::where('symptom_code', $r[1])->first();

            if ($disease && $symptom) {
                Rule::create([
                    'disease_code' => $disease->disease_code,
                    'symptom_code' => $symptom->symptom_code,
                    'mb' => $r[2],
                    'md' => $r[3],
                ]);
            }
        }
    }
}
