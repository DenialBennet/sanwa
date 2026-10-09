<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VesselScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // June 2026 (Bulan Lalu)
        \App\Models\VesselSchedule::create([
            'kapal' => 'KM. MERATUS FLORES',
            'voy' => 'VOY. 2605',
            'closing' => '2026-06-04 18:00:00',
            'etd_sub' => '2026-06-05',
        ]);

        \App\Models\VesselSchedule::create([
            'kapal' => 'KM. TANTO INDAH',
            'voy' => 'VOY. 112',
            'closing' => '2026-06-14 12:00:00',
            'etd_sub' => '2026-06-15',
        ]);

        \App\Models\VesselSchedule::create([
            'kapal' => 'KM. SPIL CITRA',
            'voy' => 'VOY. 09A',
            'closing' => '2026-06-24 17:00:00',
            'etd_sub' => '2026-06-25',
        ]);

        // July 2026 (Bulan Sekarang)
        \App\Models\VesselSchedule::create([
            'kapal' => 'KM. MERATUS FLORES',
            'voy' => 'VOY. 2607',
            'closing' => '2026-07-09 18:00:00',
            'etd_sub' => '2026-07-10',
        ]);

        \App\Models\VesselSchedule::create([
            'kapal' => 'KM. SPIL NITA',
            'voy' => 'VOY. 224',
            'closing' => '2026-07-11 12:00:00',
            'etd_sub' => '2026-07-12',
        ]);

        \App\Models\VesselSchedule::create([
            'kapal' => 'KM. TANTO SEJAHTERA',
            'voy' => 'VOY. 883A',
            'closing' => '2026-07-14 17:00:00',
            'etd_sub' => '2026-07-15',
        ]);

        \App\Models\VesselSchedule::create([
            'kapal' => 'KM. HIJAU SAMUDRA',
            'voy' => 'VOY. 12B',
            'closing' => '2026-07-18 10:00:00',
            'etd_sub' => '2026-07-19',
        ]);

        \App\Models\VesselSchedule::create([
            'kapal' => 'KM. NUSANTARA ABADI',
            'voy' => 'VOY. 091',
            'closing' => '2026-07-21 16:00:00',
            'etd_sub' => '2026-07-22',
        ]);
    }
}
