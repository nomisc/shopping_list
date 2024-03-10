<div class="fixed bottom-0 left-0 right-0 bg-gray-200 ml-10 mr-10 p-4">
    <input type="text" id="new_item" name="new_item" class="w-full p-2 border-2"
           placeholder="dodaj nov artikel na seznam"
           wire:model.live="newItem"
           wire:keydown.enter="addNewItem"
           @if($editMode) disabled @endif
    >
</div>
