<x-front-layout>
    <div class="flex flex-col items-center justify-center w-full">

        <div class="flex flex-wrap justify-center gap-3 mb-6">
            <div class="flex items-center gap-2 px-4 py-1.5 bg-gray-50 border border-gray-200 rounded-full cursor-default hover:border-indigo-600 transition-colors">
                <div class="w-1.5 h-1.5 rounded-full bg-blue-500"></div>
                <span class="text-xs font-medium text-gray-600">Daniel Julian Caesar</span>
            </div>

            <div class="flex items-center gap-2 px-4 py-1.5 bg-gray-50 border border-gray-200 rounded-full cursor-default hover:border-indigo-600 transition-colors">
                <div class="w-1.5 h-1.5 rounded-full bg-purple-500"></div>
                <span class="text-xs font-medium text-gray-600">Arjuna Hisbul</span>
            </div>

            <div class="flex items-center gap-2 px-4 py-1.5 bg-gray-50 border border-gray-200 rounded-full cursor-default hover:border-indigo-600 transition-colors">
                <div class="w-1.5 h-1.5 rounded-full bg-emerald-500"></div>
                <span class="text-xs font-medium text-gray-600">Sagaf Afthon</span>
            </div>
        </div>

        <div class="max-w-2xl mx-auto mb-8 text-center">
            <h1 class="mb-2 text-2xl font-semibold text-gray-900">Selamat Datang di Web Afthon</h1>
            <p class="mb-6 text-sm text-gray-500">Platform kolaborasi dan berbagi wawasan teknologi terkini.</p>

            @if (Route::has('login'))
                <div class="flex items-center justify-center gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="inline-flex items-center justify-center px-6 py-2.5 text-sm font-medium text-white transition-colors bg-indigo-600 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Masuk ke Dashboard
                            <svg class="w-4 h-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-6 py-2.5 text-sm font-medium text-white transition-colors bg-indigo-600 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Log in
                        </a>

                        {{-- Logika Tombol Install Admin --}}
                        @if(isset($hasAdmin) && !$hasAdmin)
                            <a href="{{ route('install.admin') }}" class="inline-flex items-center justify-center px-6 py-2.5 text-sm font-medium text-red-600 transition-colors bg-white border border-red-200 rounded-lg hover:bg-red-50 hover:border-red-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                Install Admin
                            </a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>

        <div class="w-full mb-10 border-t border-gray-100"></div>

        <h2 class="mb-4 text-4xl font-bold tracking-tight text-gray-900">
            Artikel Terbaru
        </h2>

        <div class="grid w-full max-w-6xl grid-cols-1 gap-6 md:grid-cols-3">
            @forelse($posts as $post)
                <a href="#" class="block overflow-hidden transition-colors duration-300 bg-white border border-gray-200 group rounded-xl hover:border-indigo-600">
                    <div class="h-40 overflow-hidden bg-gray-100">
                        <img src="{{ $post->image ? asset('/storage/posts/'.$post->image) : 'https://placehold.co/600x400/e2e8f0/94a3b8?text=No+Image' }}"
                        class="object-cover w-full h-full transition-transform duration-700 transform group-hover:scale-110"
                        alt="{{ $post->title }}">

                    </div>

                    <div class="p-5">
                        <h3 class="mb-2 text-base font-bold text-gray-900 transition-colors line-clamp-1 group-hover:text-indigo-600">
                            {{ $post->title }}
                        </h3>
                        <p class="text-sm leading-relaxed text-gray-500 line-clamp-2">
                            {{ Str::limit(strip_tags($post->content), 90) }}
                        </p>
                    </div>
                </a>
            @empty
                <div class="col-span-1 md:col-span-3">
                    <div class="flex flex-col items-center justify-center py-12 border border-gray-300 border-dashed rounded-xl bg-gray-50">
                        <svg class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                        </svg>
                        <p class="text-sm font-medium text-gray-500">Belum ada konten tersedia</p>
                    </div>
                </div>
            @endforelse
        </div>


    </div>
    {{-- PAGINATION LINKS --}}
        <div class="px-8 mt-6">
            {{ $posts->links() }}
        </div>
</x-front-layout>
