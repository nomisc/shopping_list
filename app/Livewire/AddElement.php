<?php

namespace App\Livewire;

use AllowDynamicProperties;
use App\Models\ShoppingList as ShoppingListData;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Component;
class AddElement extends Component
{
    public string $newItem;

    public bool $editMode;

    #[On('edit_mode')]
    public function checkEditModeUser($userId) {
        if ($userId === false) {
            $this->editMode = false;
        } else {
            $this->editMode =  ($userId == Auth::id());
        }

    }

    public function addNewItem(): void
    {
        if (isset($this->newItem)) {
            if (Str::of(string: $this->newItem)->trim()->isNotEmpty()) {
                $userId = Auth::user()->id;
                $newItem = new ShoppingListData();
                $newItem->item = $this->newItem;
                $newItem->inserted_by = $userId;
                $newItem->save();
                $this->newItem = '';
                $this->dispatch('refresh_list');
            }
        }
    }

    public function render()
    {
        return view('livewire.add-element');
    }
}
