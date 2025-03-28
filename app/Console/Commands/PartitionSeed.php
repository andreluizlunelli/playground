<?php

namespace App\Console\Commands;

use App\Models\Anime;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class PartitionSeed extends Command
{
    protected $signature = 'app:partition-seed {count}';

    protected $description = 'Command description';

    public function handle()
    {
        $count = $this->argument('count');

        DB::transaction(fn() => Anime::factory()->count($count)->create());
    }
}
