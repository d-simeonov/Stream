<?php

namespace App\Console\Commands;

use App\Models\Stream;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeleteExpiredStreams extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-expired-streams';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $count = Stream::where('date_expiration', '<', Carbon::now())->delete();
        $this->info("Deleted {$count} expired streams.");
    }
}
