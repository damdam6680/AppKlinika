<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Treatments;
class TreatmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Treatments::create([
            'treatment_name' => 'Teeth Cleaning',
            'description' => 'Professional cleaning of teeth to remove plaque and tartar.',
            'waiting_time' => '00:30',
            'price' => 100.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Treatments::create([
            'treatment_name' => 'Tooth Extraction',
            'description' => 'Surgical removal of a tooth.',
            'waiting_time' => '00:60',
            'price' => 200.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Treatments::create([
            'treatment_name' => 'Dental Filling',
            'description' => 'Restoration of a decayed or damaged tooth with a dental filling material.',
            'waiting_time' => '00:45',
            'price' => 150.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Treatments::create([
            'treatment_name' => 'Teeth Whitening',
            'description' => 'Cosmetic procedure to lighten the shade of teeth and remove stains or discoloration.',
            'waiting_time' => '01:00',
            'price' => 250.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
