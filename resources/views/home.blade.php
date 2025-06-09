@extends('layouts.app')

@section('content')
<x-banner></x-banner>
<div class="container mx-auto px-4 py-12">
    <!-- Header with elegant title and subtle decoration -->
    <div class="text-center mb-16">
        <h1 class="text-5xl font-bold text-gray-800 mb-4 relative inline-block">
            <span class="relative z-10">Berita Terupdate</span>
            <span class="absolute bottom-0 left-0 w-full h-2 bg-blue-100 transform translate-y-1 z-0"></span>
        </h1>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto">"Menyajikan Berita Terkini dengan Cepat dan Akurat, Karena Anda Berhak Tahu yang Sebenarnya, Bukan Sekadar Sensasi."</p>
    </div>

    <!-- News grid with elegant cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($news as $item)
            <div class="group bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                <!-- Image with overlay effect -->
                <div class="relative overflow-hidden h-60">
                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" 
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-80"></div>
                    <div class="absolute bottom-4 left-4">
                        <span class="inline-block px-3 py-1 bg-blue-600 text-white text-sm rounded-full">{{ $item->category->name ?? 'General' }}</span>
                    </div>
                </div>
                
                <!-- Content area -->
                <div class="p-6">
                    <div class="flex items-center text-sm text-gray-500 mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        {{ $item->created_at->format('M d, Y') }}
                    </div>
                    
                    <h2 class="text-2xl font-semibold text-gray-800 mb-3 leading-tight">{{ $item->title }}</h2>
                    <p class="text-gray-600 mb-5 line-clamp-2">{{ \Illuminate\Support\Str::limit($item->content, 120) }}</p>
                    
                    <a href="{{ route('admin.news.show', $item) }}" 
                       class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transition-colors duration-200">
                        Read More
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection