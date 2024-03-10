<div>
    <form wire:submit.prevent="" wire:poll.2s="refreshItemList">

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3">

            @foreach($listOfItems as $key => $item)
                <div class="flex items-center justify-between bg-gray-100 rounded rounded-3xl p-2">
                    @if( ($item['edit_mode'] ?? false))
                        @if($item['editing_by_current_user'])

                            <div class="flex items-center flex-grow">
                                <input type="text" class="mx-2 px-4 py-2 bg-red-200 text-gray-800 rounded rounded-3xl flex-grow text-center"
                                id="{{$key}}" value="{{$item['item']}}"  wire:model="editedItem">
                            </div>

                            <div class="flex flex-col items-end">
                                <input type="image" src="{{ asset('images/check.png') }}" class="pb-1 mr-2" wire:click="edited('{{$item['id']}}')">
                                <input type="image" src="{{ asset('images/delete.png') }}" class="mr-2"   wire:click="delete('{{$item['id']}}')">
                            </div>

                        @else
                            {{$item['item']}}
                            zapis ureja drugi uporabnik
                        @endif
                    @else

                        <div class="flex items-center">
                            <!-- Checkbox -->
                            <input type="checkbox" class="mr-2"
                                  @if($item['checked']) checked @endif
                                   @if($editMode) disabled @endif
                                    wire:click="checked('{{$item['id']}}')"

                            >
                        </div>

                        <div class="flex items-center flex-grow">
                            <button class="ml-2 w-full text-black py-2 px-4 mr-4
                                            rounded rounded-3xl
                                            @if(!$editMode) hover:bg-gray-300  @endif
                                            @if($item['checked']) line-through bg-gray-100 @else bg-gray-200 @endif"
                                    wire:click="checked('{{$item['id']}}')"
                                    @if($editMode) disabled @endif
                            >
                                {{$item['item']}}
                            </button>
                        </div>

                        <div class="flex items-center flex-col">
                            @if(!$editMode)
                                @if(!$item['checked'])
                                    <input type="image" src="{{ asset('images/edit.png') }}" class="pb-1 mr-2" wire:click="edit('{{$item['id']}}')">
                                @endif
                                <input type="image" src="{{ asset('images/delete.png') }}" class="mr-2"  wire:click="delete('{{$item['id']}}')">
                            @endif
                        </div>
                    @endif
                </div>
            @endforeach

        </div>


    </form>
</div>
