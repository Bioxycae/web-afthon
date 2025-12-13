<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col justify-between gap-4 md:flex-row md:items-center">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Dashboard Artikel') }}
            </h2>

            <div class="flex flex-wrap gap-3">
                {{-- Tombol Lihat Website --}}
                <a href="{{ route('home') }}" target="_blank" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-gray-700 uppercase transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25">
                    <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                    Lihat Website
                </a>

                {{-- Tombol Tambah Artikel --}}
                <a href="{{ route('posts.create') }}" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-indigo-600 border border-transparent rounded-md shadow-lg hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 shadow-indigo-500/30">
                    <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Artikel
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            {{-- Statistik Ringkas --}}
            <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-3">
                <div class="flex items-center justify-between p-6 overflow-hidden bg-white border-l-4 border-indigo-500 shadow-sm sm:rounded-lg">
                    <div>
                        <div class="text-sm font-medium text-gray-500">Total Artikel</div>
                        <div class="mt-1 text-3xl font-bold text-gray-800">{{ $posts->count() }}</div>
                    </div>
                    <div class="p-3 rounded-full bg-indigo-50">
                        <svg class="w-8 h-8 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Tabel Artikel --}}
            <div class="overflow-hidden bg-white border border-gray-100 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase border-b bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-4 font-semibold tracking-wider text-gray-600">Gambar</th>
                                    <th scope="col" class="w-1/4 px-6 py-4 font-semibold tracking-wider text-gray-600">Judul Artikel</th>
                                    <th scope="col" class="w-1/3 px-6 py-4 font-semibold tracking-wider text-gray-600">Deskripsi Singkat</th>
                                    <th scope="col" class="px-6 py-4 font-semibold tracking-wider text-gray-600">Tanggal</th>
                                    <th scope="col" class="px-6 py-4 font-semibold tracking-wider text-center text-gray-600">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse ($posts as $post)
                                    <tr class="transition-colors duration-200 bg-white hover:bg-gray-50">
                                        <td class="px-6 py-4 align-middle">
                                            @if($post->image)

                                                <a href="{{ asset('/storage/posts/'.$post->image) }}" target="_blank" class="relative block w-24 h-16 overflow-hidden border border-gray-200 rounded-lg shadow-sm group" title="Lihat Gambar Full">
                                                    <img src="{{ asset('/storage/posts/'.$post->image) }}" class="object-cover w-full h-full transition-transform duration-500 transform group-hover:scale-110">
                                                    {{-- Overlay Icon --}}
                                                    <div class="absolute inset-0 flex items-center justify-center transition-colors bg-black/0 group-hover:bg-black/20">
                                                        <svg class="w-4 h-4 text-white transition-opacity opacity-0 group-hover:opacity-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                                        </svg>
                                                    </div>
                                                </a>
                                               @else
                                                    <div class="flex items-center justify-center w-24 h-16 overflow-hidden border border-gray-200 rounded-lg shadow-sm cursor-default bg-gray-50" title="Tidak ada gambar">
                                                        {{-- Placeholder --}}
                                                        <img src="https://placehold.co/600x400/f1f5f9/cbd5e1?text=No+Img" class="object-cover w-full h-full opacity-70">
                                                    </div>
                                                @endif
                                        </td>
                                        <td class="px-6 py-4 align-middle">
                                            <div class="text-sm font-bold text-gray-900 line-clamp-2">{{ $post->title }}</div>
                                        </td>
                                        <td class="px-6 py-4 align-middle">
                                            <p class="text-xs leading-relaxed text-gray-500 line-clamp-2">
                                                {{ Str::limit(strip_tags($post->content), 100) }}
                                            </p>
                                        </td>
                                        <td class="px-6 py-4 align-middle whitespace-nowrap">
                                            <div class="text-xs font-medium text-gray-900">{{ $post->created_at->format('d M Y') }}</div>
                                            <div class="text-xs text-gray-400">{{ $post->created_at->format('H:i') }} WIB</div>
                                        </td>
                                        <td class="px-6 py-4 text-center align-middle whitespace-nowrap">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ingin menghapus artikel ini?');" action="{{ route('posts.destroy', $post->id) }}" method="POST" class="inline-flex items-center space-x-2">
                                                <a href="{{ route('posts.edit', $post->id) }}" class="p-2 text-indigo-600 transition-colors rounded-full hover:text-indigo-900 hover:bg-indigo-50" title="Edit">
                                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </a>

                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 text-red-600 transition-colors rounded-full hover:text-red-900 hover:bg-red-50" title="Hapus">
                                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-16 text-center">
                                            <div class="flex flex-col items-center justify-center">
                                                <div class="p-4 mb-4 rounded-full bg-gray-50">
                                                    <svg class="w-10 h-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                                    </svg>
                                                </div>
                                                <h3 class="text-sm font-medium text-gray-900">Belum ada artikel</h3>
                                                <p class="mt-1 text-sm text-gray-500">Mulai dengan membuat artikel baru sekarang.</p>
                                                <div class="mt-6">
                                                    <a href="{{ route('posts.create') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                        <svg class="w-5 h-5 mr-2 -ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                                                        </svg>
                                                        Buat Artikel Baru
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4 px-7">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
