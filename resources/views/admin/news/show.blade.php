<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $news->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if($news->image)
                <img src="{{ asset('storage/'.$news->image) }}" alt="{{ $news->title }}" class="w-full h-64 object-cover">
                @endif
                <div class="p-6">
                    <div class="flex items-center text-gray-500 mb-4">
                        <span>Diposting oleh {{ $news->user->name }}</span>
                        <span class="mx-2">•</span>
                        <span>{{ $news->created_at->format('d M Y H:i') }}</span>
                    </div>
                    <div class="prose max-w-none">
                        {!! nl2br(e($news->content)) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>