<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Actions\SyncTaskData;

class NotifyTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:notify-tasks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get tasks from external API & send notifications to telegram bot';

    /**
     * Execute the console command.
     */
    public function handle(SyncTaskData $sync)
    {
        $sync->handle();
        $this->info('Suncronization end successful!');        
    }
}
