
<div class="container mx-auto mt-8">
    <form wire:submit.prevent="uploadJsonFile" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="file">
                Izberi datoteko za uvoz
            </label>
            <input type="file" name="file" id="file"
                   class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                   wire:model="file"
            >
            @if($status)
                    <div class="border border-blue-400 rounded-b bg-blue-100 px-4 py-3 text-black-700 mb-2">
                        <p>{{$message}}</p>
                    </div>
            @endif
            @if(!$status && !blank($message))
                <div class="border border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mb-2">
                    <p>{{$message}}</p>
                </div>
            @endif
        </div>
        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
                Uvozi
            </button>
        </div>
    </form>
</div>
