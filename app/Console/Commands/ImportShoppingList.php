<?php

namespace App\Console\Commands;

use App\Services\DataExport;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;


class ImportShoppingList extends Command
{

    protected  $filesystem;

    public function __construct(Filesystem $filesystem)
    {
        parent::__construct();
        $this->filesystem = $filesystem;
    }


    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shopping-list:import {filename}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import shopping list from JSON file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filename = $this->argument('filename');

        if ($this->filesystem->exists($filename)) {
            $content = $this->filesystem->get($filename);

            $status = (new DataExport())->ProcessImport($content);

            if ($status) {
                $this->info('Datoteka uvožena!');
            } else {
                $this->error('Napaka pri uvozu!');
            }
        } else {
            $this->error('Datoteka ne obstaja: ' . $filename);
        }
    }
}
