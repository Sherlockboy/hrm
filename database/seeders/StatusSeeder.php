<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = collect(['First Contact', 'Interview', 'Tech Assignment', 'Rejected', 'Hired']);

        $statuses->each(fn(string $status) => Status::create(['name' => $status]));
    }
}
