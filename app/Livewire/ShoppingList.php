<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\ShoppingList as ShoppingListData;

class ShoppingList extends Component
{

    public ShoppingListData $items;

    public $listOfItems;

    public string $newItem;

    public bool $editMode;



    private function getItems() {
        $data = ShoppingListData::OrderBy('created_at','desc')->get();
        $data->each(function ($item) {
            if ($item->edit_mode && !$item->checked) {
                if ($item->edit_mode_by == Auth::id()) {
                    $item->editing_by_current_user= true;
                } else {
                    $item->editing_by_current_user = false;
                }
            }
        });
        $this->listOfItems = $data;
    }

    private function ReloadData() {
        $this->getItems();
    }

    private function setListEmptyStatus() {
        $this->dispatch('set_empty_status',$this->listOfItems->isEmpty());
    }

    public $editedItem;

    #[On('refresh_list')]
    public function refreshItemList() {
       $this->ReloadData();
       $this->setListEmptyStatus();
    }

    public function mount() {
        $this->editMode = false;
        ShoppingListData::where('edit_mode_by',Auth::id())
            ->where('edit_mode',true)
            ->update([
                'edit_mode_by' => null,
                'edit_mode' => false
            ]);
        $this->dispatch('edit_mode',false);
        $this->ReloadData();
        $this->setListEmptyStatus();
    }

    public function edit($id) {
        $databaseObject = ShoppingListData::find($id);
        $this->dispatch('edit_mode',Auth::id());
        $databaseObject->edit_mode = true;
        $databaseObject->edit_mode_by = Auth::id();
        $databaseObject->save();
        $this->editMode = true;
        $this->editedItem = $databaseObject->item;
        $this->refreshItemList();
    }

    public function checked($id) {
        $item = ShoppingListData::find($id);
        $item->checked = !$item->checked;
        $item->save();
        $this->ReloadData();
    }

    public function edited($id) {
        $item = ShoppingListData::find($id);
        $item->item = $this->editedItem;
        $item->edit_mode = false;
        $this->dispatch('edit_mode',false);
        $item->edit_mode_by = null;
        $item->save();
        $this->ReloadData();
        $this->editMode = false;
    }

    public function delete($id) {
        $item = ShoppingListData::find($id);
        $item->delete();
        $this->ReloadData();
        $this->setListEmptyStatus();
    }

    public function save() {
        $newItem = new ShoppingListData();
        $newItem->item = $this->newItem;
        $newItem->save();
        $this->newItem = '';
        $this->ReloadData();
        $this->setListEmptyStatus();
    }

    public function render()
    {
        return view('livewire.shopping-list');
    }
}
