<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit Artikel') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white border border-gray-100 shadow-sm sm:rounded-xl">
                <div class="p-8">
                    <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        {{-- Preview Gambar Lama & Upload Baru  --}}
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                            {{-- Preview  --}}
                            <div class="col-span-1">
                                <label class="block mb-2 text-sm font-medium text-gray-700">Gambar Saat Ini</label>

                                <div class="relative block overflow-hidden border border-gray-200 rounded-lg shadow-sm group">
                                    @if($post->image)
                                        <a href="{{ asset('/storage/posts/'.$post->image) }}" target="_blank" class="relative block h-48 cursor-zoom-in">
                                            <img src="{{ asset('/storage/posts/'.$post->image) }}" alt="Gambar Lama" class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-105">
                                            <div class="absolute inset-0 flex items-center justify-center transition-all pointer-events-none bg-black/0 group-hover:bg-black/40">
                                                <div class="flex items-center gap-1 px-3 py-1 text-xs font-semibold text-white transition-opacity rounded-full opacity-0 bg-black/50 backdrop-blur-sm group-hover:opacity-100">
                                                    Lihat Asli
                                                </div>
                                            </div>
                                        </a>
                                    @else
                                        <div class="flex flex-col items-center justify-center h-48 gap-2 text-gray-400 bg-gray-100">
                                            <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <span class="text-xs">Tidak ada gambar</span>
                                        </div>
                                    @endif
                                </div>

                                {{-- Tombol Hapus Gambar --}}
                                @if($post->image)
                                    <div class="mt-3 text-center">
                                        <label class="inline-flex items-center gap-2 px-3 py-1.5 text-xs font-medium text-red-600 bg-red-50 border border-red-100 rounded-md cursor-pointer hover:bg-red-100 transition-colors select-none">
                                            <input type="checkbox" name="delete_image" value="1" class="w-4 h-4 text-red-600 border-gray-300 rounded focus:ring-red-500">
                                            <span>Hapus Gambar Ini</span>
                                        </label>
                                    </div>
                                @endif
                            </div>

                            {{--  Upload Area  --}}
                            <div class="col-span-1 md:col-span-2">
                                <label class="block mb-2 text-sm font-medium text-gray-700">Ganti Gambar (Opsional)</label>

                                <div id="upload-container" class="relative flex items-center justify-center h-48 px-6 pt-5 pb-6 mt-1 transition-colors border-2 border-gray-300 border-dashed rounded-lg hover:border-indigo-500 bg-gray-50">
                                    <div class="w-full space-y-1 text-center">
                                        <svg id="icon-default" class="w-10 h-10 mx-auto text-gray-400 transition-all" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <svg id="icon-success" class="hidden w-10 h-10 mx-auto text-green-500 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <div class="flex justify-center text-sm text-gray-600">
                                            <label for="image" class="relative z-10 px-2 font-medium text-indigo-600 bg-white rounded-md cursor-pointer hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                <span id="file-name-display">Upload file baru</span>
                                                <input id="image" name="image" type="file" class="sr-only" onchange="updateFileName(this)">
                                            </label>
                                        </div>
                                        <p class="text-xs text-gray-500" id="file-help">Biarkan kosong jika tidak ingin mengubah</p>
                                    </div>
                                </div>
                                @error('image') <p class="mt-2 text-sm text-red-500">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        {{--  Judul  --}}
                        <div>
                            <label for="title" class="block mb-1 text-sm font-medium text-gray-700">Judul Artikel</label>
                            <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}"
                                class="w-full transition-colors border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="Masukkan judul artikel">
                            @error('title') <p class="mt-2 text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>


                        <div>
                            <label for="content" class="block mb-1 text-sm font-medium text-gray-700">Konten Artikel</label>

                            <div class="relative" x-data="{ expanded: false }">
                                <textarea name="content" id="content"
                                    :rows="expanded ? 20 : 6"
                                    class="w-full transition-all duration-300 border-gray-300 rounded-lg shadow-sm resize-none focus:border-indigo-500 focus:ring-indigo-500"
                                    >{{ old('content', $post->content) }}</textarea>

                                <button type="button" @click="expanded = !expanded"
                                    class="absolute bottom-3 right-3 p-1.5 text-gray-400 hover:text-indigo-600 bg-white border border-gray-200 rounded-md shadow-sm hover:shadow-md transition-all"
                                    :title="expanded ? 'Perkecil Area' : 'Perbesar Area'">

                                    <svg x-show="!expanded" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" />
                                    </svg>

                                    <svg x-show="expanded" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>

                            @error('content') <p class="mt-2 text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>

                        {{--  Actions  --}}
                        <div class="flex items-center justify-end pt-4 space-x-4 border-t border-gray-100">
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-gray-700 uppercase transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Batal
                            </a>
                            <button type="submit" class="inline-flex items-center px-6 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-indigo-600 border border-transparent rounded-md shadow-lg hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 shadow-indigo-500/30">
                                Update Artikel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateFileName(input) {
            const fileNameDisplay = document.getElementById('file-name-display');
            const iconDefault = document.getElementById('icon-default');
            const iconSuccess = document.getElementById('icon-success');
            const fileHelp = document.getElementById('file-help');
            const uploadContainer = document.getElementById('upload-container');

            if (input.files && input.files.length > 0) {
                const fileName = input.files[0].name;
                fileNameDisplay.textContent = fileName;

                iconDefault.classList.add('hidden');
                iconSuccess.classList.remove('hidden');

                uploadContainer.classList.add('border-indigo-500', 'bg-indigo-50');
                uploadContainer.classList.remove('border-gray-300', 'bg-gray-50');

                fileHelp.textContent = 'File siap diupload';
                fileHelp.classList.add('text-green-600', 'font-medium');
            } else {
                fileNameDisplay.textContent = 'Upload file baru';
                iconDefault.classList.remove('hidden');
                iconSuccess.classList.add('hidden');
                uploadContainer.classList.remove('border-indigo-500', 'bg-indigo-50');
                uploadContainer.classList.add('border-gray-300', 'bg-gray-50');
                fileHelp.textContent = 'Biarkan kosong jika tidak ingin mengubah';
                fileHelp.classList.remove('text-green-600', 'font-medium');
            }
        }
    </script>
</x-app-layout>
