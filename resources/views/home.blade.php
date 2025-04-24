@extends('layouts.app')

@section('content')
<x-banner></x-banner>
<div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold text-center mb-6">Portal Berita</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($news as $item)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h2 class="text-2xl font-semibold mb-2">{{ $item->title }}</h2>
                    <p class="text-gray-600 mb-4">{{ \Illuminate\Support\Str::limit($item->content, 100) }}</p>
                    <a href="{{ route('admin.news.show', $item) }}" class="text-blue-500 hover:underline">Baca Selengkapnya</a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
