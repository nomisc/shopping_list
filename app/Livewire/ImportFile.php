<?php

namespace App\Livewire;

use App\Services\DataExport;
use Livewire\Component;
use Livewire\WithFileUploads;

class ImportFile extends Component
{
    use WithFileUploads;

    public $file;

    public string $message = '';
    public bool $status;

    public function uploadJsonFile() {
        if ($this->file) {
            $this->fileContent = file_get_contents($this->file->getRealPath());
            $this->status = (new DataExport())->ProcessImport($this->fileContent);
            if ($this->status) {
                $this->message = 'Datoteka uspešno uvožena!';
                $this->file = null;
            }
            else {
                $this->message = 'Pri uvozu je prišlo do napake';
            }
        }
        else {
            $this->message = 'Izberi datoteko!';
            $this->status = false;
        }

    }

    public function render()
    {
        return view('livewire.import-file');
    }
}
