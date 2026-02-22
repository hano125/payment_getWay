<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CourseMillionSeeder extends Seeder
{
    /**
     * Seed 1,000,000 course records using chunked bulk inserts.
     */
    public function run(): void
    {
        $total     = 1_000_000;
        $chunkSize = 500;
        $now       = now()->toDateTimeString();

        $this->command->info("Inserting {$total} courses in chunks of {$chunkSize}...");
        $bar = $this->command->getOutput()->createProgressBar($total / $chunkSize);
        $bar->start();

        for ($i = 0; $i < $total / $chunkSize; $i++) {
            $chunk = [];

            for ($j = 0; $j < $chunkSize; $j++) {
                $name    = implode(' ', [
                    fake()->word(),
                    fake()->word(),
                    fake()->word(),
                ]);
                $chunk[] = [
                    'course_name'       => ucwords($name),
                    'slug'              => Str::slug($name) . '-' . uniqid(),
                    'price'             => rand(10, 500),
                    'description'       => fake()->paragraph(),
                    'stripe_product_id' => null,
                    'created_at'        => $now,
                    'updated_at'        => $now,
                ];
            }

            DB::table('courses')->insert($chunk);
            $bar->advance();
        }

        $bar->finish();
        $this->command->newLine();
        $this->command->info('Done! 1,000,000 course records inserted.');
    }
}
