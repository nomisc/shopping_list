<?php

namespace App\Services;

use App\Models\ExportCheck;
use App\Models\ShoppingList;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class DataExport
{

    protected string $exportLocation;

    private $filename;

    private $fullPath;

    public function __construct() {
        $this->exportLocation = Config('app.export_location','export/');
    }

    public function exportToJson()
    {
        $data = ShoppingList::all();
        if ($data->count() > 0 ) {
            $jsonData = $data->toJson();
            $file = Carbon::now()->format('Ymd_His').'_shopping_list.json';
            $exportTo = $this->exportLocation.$file;
            Storage::disk('local')->put($exportTo, $jsonData);
            $exportCheckStorage = new ExportCheck();
            $exportCheckStorage->export_filename = $file;
            $exportCheckStorage->export_checksum = md5($jsonData);
            $status = $exportCheckStorage->save();
            $return =  ['status'=>$status, 'file' => $file];
        }
        else {
            $return =  ['status'=>false, 'file'=> null];
        }
        return $return;
    }

    public function ProcessImport(string $input): bool
    {

        if (!json_validate($input))  return false;

        $checksumRecordStatus =  ExportCheck::where('export_checksum','=',md5($input))->count() > 0;
        if (!$checksumRecordStatus)  return false;

        $importDataset = collect(json_decode($input, true));

        $importDataset->each(function ($item)  {
            $singleRecord = ShoppingList::find($item['id']);
            if ($singleRecord !== null) {
                $singleRecord->item = $item['item'];
                $singleRecord->checked = $item['checked'];
                $singleRecord->save();
            } else {
                ShoppingList::onlyTrashed()->where('id',$item['id'])->restore();
            }
        });
        return true;
    }
}
