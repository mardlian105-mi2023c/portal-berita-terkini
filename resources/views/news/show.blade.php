@extends('layouts.app') 

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">
    <div class="bg-white shadow-xl rounded-lg overflow-hidden">
        @if ($news->image)
            <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}" class="w-full h-72 object-cover">
        @else
            <img src="https://picsum.photos/800/400?random={{ $news->id }}" alt="Default Image" class="w-full h-72 object-cover">
        @endif

        <div class="p-6">
            <span class="text-sm bg-blue-100 text-blue-800 px-2 py-1 rounded-full inline-block mb-3">
                {{ $news->category->name ?? 'Tanpa Kategori' }}
            </span>
            <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $news->title }}</h1>
            <div class="text-gray-700 leading-relaxed">
                {!! nl2br(e($news->content)) !!}
            </div>
            <div class="mt-6 text-sm text-gray-500">
                Diposting oleh: <strong>{{ $news->user->name ?? 'Admin' }}</strong> pada {{ $news->created_at->format('d M Y') }}
            </div>

            <a href="{{ route('news.index') }}" class="mt-6 inline-block text-blue-600 hover:underline">
                ← Kembali ke Daftar Berita
            </a>
        </div>
    </div>
</div>
@endsection
