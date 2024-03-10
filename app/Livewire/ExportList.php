<?php

namespace App\Livewire;

use App\Models\ExportCheck;
use App\Services\DataExport;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class ExportList extends Component
{

    public $exportList;

    public $message;

    public $status;

    private function setMessage($message,$status):void {
        $this->message = $message;
        $this->status = $status;
    }

    private function refreshList() {
        $this->exportList = ExportCheck::all()->sortByDesc('created_at');
    }

    public function Mount() {
        $this->refreshList();
    }

    public function doExport() {
        $exportService = new DataExport();
        $status = $exportService->exportToJson();
        if ($status) {
            $this->setMessage('Seznam izvozen v datoteko '.$status['file'],true);
            $this->refreshList();
        }
        else {
            $this->setMessage('Napaka pri izvozu seznama v datoteko!', false);
        }
    }

    public function downloadFile($id) {
        $fileRecord = ExportCheck::find($id);
        if (is_null($fileRecord)) {
            $this->setMessage('Napaka pri prenosu datoteke',false);
        }
        $exportTo = Config('app.export_location','export/').$fileRecord->export_filename;
        try {
            $this->setMessage('Datoteka uspešno naložena!',true);
            return Storage::disk('local')->download($exportTo);
        } catch (FileNotFoundException $e) {
            $this->setMessage('Napaka pri prenosu datoteke',false);
        } catch (\Exception $e) {
            $this->setMessage('Napaka pri prenosu datoteke',false);
        }
    }

    public function render()
    {
        return view('livewire.export-list');
    }
}
