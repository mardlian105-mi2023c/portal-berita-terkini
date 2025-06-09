@extends('layouts.app')

@section('content')
@php
    $categories = \App\Models\Category::all();
    $currentCategory = request()->route('category') ?? null;
@endphp

<div class="min-h-screen bg-gradient-to-b from-gray-50 to-gray-100 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-800 mb-3">
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-600">
                    📰 Berita Terkini
                </span>
            </h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Temukan informasi terbaru seputar Kediri Raya dan sekitarnya
            </p>
        </div>

        <!-- Category Filter -->
        <div class="mb-12 flex flex-col items-center">
            <div class="flex flex-wrap justify-center gap-3 max-w-3xl">
                <a href="{{ route('berita') }}" 
                   class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-200 
                          {{ !$currentCategory ? 'bg-indigo-600 text-white shadow-md' : 'bg-white text-gray-700 hover:bg-gray-100 border border-gray-200' }}">
                    Semua Kategori
                </a>
                
                @foreach($categories as $category)
                    <a href="{{ route('berita.kategori', $category->id) }}" 
                       class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-200 
                              {{ $currentCategory == $category->id ? 'bg-indigo-600 text-white shadow-md' : 'bg-white text-gray-700 hover:bg-gray-100 border border-gray-200' }}">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
            
            @if($currentCategory)
                <div class="mt-4 text-indigo-600 font-medium flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                    </svg>
                    Menampilkan kategori: {{ $categories->find($currentCategory)->name }}
                </div>
            @endif
        </div>

        <!-- News Grid -->
        @if($news->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($news as $item)
                    <div class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <div class="relative">
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" 
                                 class="w-full h-56 object-cover">
                            <div class="absolute top-3 right-3">
                                <span class="bg-indigo-600 text-white text-xs font-semibold px-3 py-1 rounded-full">
                                    {{ $item->category->name }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="p-6">
                            <div class="flex items-center text-sm text-gray-500 mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                {{ $item->created_at->format('d M Y') }}
                            </div>
                            
                            <h3 class="text-xl font-semibold text-gray-800 mb-3 hover:text-indigo-600 transition-colors">
                                <a href="{{ route('admin.news.show', $item->id) }}">{{ $item->title }}</a>
                            </h3>
                            
                            <p class="text-gray-600 mb-4 line-clamp-3">
                                {{ \Illuminate\Support\Str::limit(strip_tags($item->content), 120) }}
                            </p>
                            
                            <a href="{{ route('admin.news.show', $item->id) }}" 
                               class="inline-flex items-center text-indigo-600 font-medium group">
                                Baca selengkapnya
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1 transform group-hover:translate-x-1 transition-transform" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-xl shadow-sm p-12 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="mt-4 text-lg font-medium text-gray-900">Tidak ada berita tersedia</h3>
                <p class="mt-1 text-gray-500">Silakan cek kembali nanti atau pilih kategori lain</p>
            </div>
        @endif

        <!-- Pagination -->
        @if($news->hasPages())
            <div class="mt-12 flex justify-center">
                {{ $news->onEachSide(1)->links('pagination::tailwind') }}
            </div>
        @endif
    </div>
</div>
@endsection