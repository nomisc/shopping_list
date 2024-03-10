<?php

namespace App\Livewire;

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\ShoppingList as ShoppingListData;

class Navbar extends Component
{
    public bool $listIsEmpty;

    public string $userData;

    public function Logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }

    #[On('set_empty_status')]
    public function setListEmptyStatus($status) {
        $this->listIsEmpty = $status;
    }

    public function deleteList() {
        ShoppingListData::query()->delete();
        $this->dispatch('refreshList')->component(ShoppingList::class);
    }

    public function mount() {
        $this->userData = Auth::id() .' / '. Auth::user()->name;
    }

    public function render()
    {
        return view('livewire.navbar');
    }
}
