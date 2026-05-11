<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VacancyCategory;

class VacancyCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['label' => 'Tecnologia'],
            ['label' => 'Comercial'],
            ['label' => 'Marketing'],
            ['label' => 'Pedagógico'],
            ['label' => 'Administrativo'],
            ['label' => 'Facilities'],
        ];

        foreach ($categories as $category) {
            VacancyCategory::create($category);
        }
    }
}
