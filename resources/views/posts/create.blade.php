<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Tambah Artikel Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white border border-gray-100 shadow-sm sm:rounded-xl">
                <div class="p-8">
                    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        {{--  Gambar --}}
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-700">Upload Gambar Utama</label>

                            {{--  Container Upload  --}}
                            <div id="upload-container" class="relative flex justify-center px-6 pt-5 pb-6 mt-1 transition-colors border-2 border-gray-300 border-dashed rounded-lg hover:border-indigo-500 bg-gray-50">
                                <div class="space-y-1 text-center">

                                    <svg id="icon-default" class="w-12 h-12 mx-auto text-gray-400 transition-all duration-300" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>

                                    <svg id="icon-success" class="hidden w-12 h-12 mx-auto text-green-500 transition-all duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>

                                    <div class="flex justify-center text-sm text-gray-600">
                                        <label for="image" class="relative z-10 px-2 font-medium text-indigo-600 bg-white rounded-md cursor-pointer hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                            <span id="file-name-display">Upload file</span>
                                            <input id="image" name="image" type="file" class="sr-only" onchange="updateFileName(this)">
                                        </label>
                                        <p class="pl-1" id="drag-text">atau drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500" id="file-help">PNG, JPG, GIF up to 2MB</p>
                                </div>
                            </div>
                            @error('image')
                                <p class="flex items-center mt-2 text-sm text-red-500">
                                    <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label for="title" class="block mb-1 text-sm font-medium text-gray-700">Judul Artikel</label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}" class="w-full placeholder-gray-400 transition-colors border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Masukkan judul yang menarik...">
                            @error('title') <p class="mt-2 text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="content" class="block mb-1 text-sm font-medium text-gray-700">Konten Artikel</label>
                            <div class="relative" x-data="{ expanded: false }">
                                <textarea name="content" id="content" :rows="expanded ? 20 : 6" class="w-full placeholder-gray-400 transition-all duration-300 border-gray-300 rounded-lg shadow-sm resize-none focus:border-indigo-500 focus:ring-indigo-500" placeholder="Tuliskan isi artikel anda disini...">{{ old('content') }}</textarea>
                                <button type="button" @click="expanded = !expanded" class="absolute bottom-3 right-3 p-1.5 text-gray-400 hover:text-indigo-600 bg-white border border-gray-200 rounded-md shadow-sm hover:shadow-md transition-all" :title="expanded ? 'Perkecil Area' : 'Perbesar Area'">
                                    <svg x-show="!expanded" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" /></svg>
                                    <svg x-show="expanded" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                </button>
                            </div>
                            @error('content') <p class="mt-2 text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex items-center justify-end pt-4 space-x-4 border-t border-gray-100">
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-gray-700 uppercase transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Batal & Kembali</a>
                            <button type="submit" class="inline-flex items-center px-6 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-indigo-600 border border-transparent rounded-md shadow-lg hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 shadow-indigo-500/30">Simpan Artikel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Script Handling File Upload UI -->
    <script>
        function updateFileName(input) {
            const fileNameDisplay = document.getElementById('file-name-display');
            const iconDefault = document.getElementById('icon-default');
            const iconSuccess = document.getElementById('icon-success');
            const dragText = document.getElementById('drag-text');
            const uploadContainer = document.getElementById('upload-container');

            if (input.files && input.files.length > 0) {
                const fileName = input.files[0].name;
                fileNameDisplay.textContent = fileName;

                iconDefault.classList.add('hidden');
                iconSuccess.classList.remove('hidden');

                uploadContainer.classList.add('border-indigo-500', 'bg-indigo-50');
                uploadContainer.classList.remove('border-gray-300', 'bg-gray-50');

                dragText.textContent = 'Terpilih';
            } else {
                fileNameDisplay.textContent = 'Upload file';
                iconDefault.classList.remove('hidden');
                iconSuccess.classList.add('hidden');
                uploadContainer.classList.remove('border-indigo-500', 'bg-indigo-50');
                uploadContainer.classList.add('border-gray-300', 'bg-gray-50');
                dragText.textContent = 'atau drag and drop';
            }
        }
    </script>
</x-app-layout>
