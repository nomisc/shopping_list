<?php

namespace App\Console\Commands;

use App\Services\DataExport;
use Illuminate\Console\Command;

class ExportShoppingList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shopping-list:export';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export shopping list to JSON file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $exportService = new DataExport();
        $status = $exportService->exportToJson();
        $message = ($status ? 'Seznam izvozen v datoteko '.$status['file'] : 'Napaka pri izvozu podatkov!' );
        $this->info($message);
    }
}
