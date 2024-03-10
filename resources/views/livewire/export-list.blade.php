<div>
    <div class="container mx-auto mt-8">
        <form wire:submit.prevent="doExport" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="file">
                    Izvozi podatke v datoteko
                </label>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button" >
                    Izvozi
                </button>

            </div>
        </form>
    </div>

    <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                    @if ($status && !blank($message))
                        <div class="bg-blue-100 border border-blue-500 text-blue-700 px-4 py-3 w-3/4 ml-2" role="alert">
                            {{$message}}
                        </div>
                    @endif

                    @if (!$status && !blank($message))
                        <div class="bg-red-100 border border-red-500 text-red-700  px-4 py-3 w-3/4 ml-2" role="alert">
                            {{$message}}
                        </div>
                    @endif

                    <ul class="divide-y divide-gray-200">
                        @foreach($exportList as $item)
                            <li>
                                <div class="block hover:bg-gray-50 focus:outline-none focus:bg-gray-50 transition duration-150 ease-in-out">
                                    <div class="px-4 py-4 sm:px-6 flex items-center">
                                        <div class="flex-1 min-w-0">
                                            <div class="text-sm leading-5 font-medium text-indigo-600 truncate">{{ $item['id'] }}</div>
                                            <div class="mt-1 flex items-center text-sm leading-5 text-gray-500">
                                                <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 12a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                                    <path fill-rule="evenodd" d="M3 10a7 7 0 1114 0 7 7 0 01-14 0zm7-5a5 5 0 100 10 5 5 0 000-10z" clip-rule="evenodd"/>
                                                </svg>
                                                <span>{{ $item->created_at->format('Y-m-d H:i:s') }}</span>
                                            </div>
                                        </div>
                                        <div class="text-sm leading-5 text-gray-500">{{ $item['export_filename'] }}</div>
                                        <div class="ml-4">
                                            <button class="px-2 py-1 text-sm leading-5 rounded-md bg-blue-500 text-white hover:bg-blue-600 focus:outline-none focus:bg-blue-600"
                                                    wire:click="downloadFile('{{$item['id']}}')">
                                                Download
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
