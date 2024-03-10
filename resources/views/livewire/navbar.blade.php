<div>
    <nav class="bg-gray-800 p-2 mb-4">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center">
                <a href="{{route('shopping-list')}}" class="text-white font-bold text-lg">My shopping list</a>
            </div>
            <div class="flex items-center">
                <a href="/import" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Uvoz</a>
                @if(!$listIsEmpty)
                    <a href="/export" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Izvoz</a>
                    <a href="#"
                       wire:click="deleteList"
                       wire:confirm="Are you sure you want to delete all list?"
                       class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Briši vse elemente
                    </a>
                @endif
            </div>
            <div class="flex items-center">

                <a href="/profile"
                   class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">{{$userData ?? ''}}
                </a>

                <a href="#"
                   wire:click="Logout"
                   class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Odjava
                </a>
            </div>
        </div>
    </nav>
</div>

