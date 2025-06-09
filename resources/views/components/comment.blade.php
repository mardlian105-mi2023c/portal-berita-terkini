<div class="bg-white p-4 rounded-lg shadow mb-4">
    <div class="flex justify-between items-start">
        <div class="flex items-center mb-2">
            <div class="font-semibold">{{ $comment->user->name }}</div>
            <span class="text-gray-500 text-sm ml-2">{{ $comment->created_at->diffForHumans() }}</span>
        </div>
        @can('delete', $comment)
        <form action="{{ route('comments.destroy', $comment) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-500 hover:text-red-700 text-sm">
                Hapus
            </button>
        </form>
        @endcan
    </div>
    <p class="text-gray-700">{{ $comment->content }}</p>
    
    <button onclick="toggleReplyForm({{ $comment->id }})" class="text-blue-500 hover:text-blue-700 text-sm mt-2">
        Balas
    </button>
    
    <div id="reply-form-{{ $comment->id }}" class="hidden mt-3 pl-4 border-l-2 border-gray-200">
        <form action="{{ route('comments.store', $news) }}" method="POST">
            @csrf
            <input type="hidden" name="parent_id" value="{{ $comment->id }}">
            <textarea name="content" rows="2" class="w-full border rounded p-2" placeholder="Tulis balasan..."></textarea>
            <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded text-sm mt-1">
                Kirim Balasan
            </button>
        </form>
    </div>
    
    @if($comment->replies->count() > 0)
        <div class="mt-3 pl-4 border-l-2 border-gray-200">
            @foreach($comment->replies as $reply)
                @include('components.comment', ['comment' => $reply, 'news' => $news])
            @endforeach
        </div>
    @endif
</div>

<script>
function toggleReplyForm(commentId) {
    const form = document.getElementById(`reply-form-${commentId}`);
    form.classList.toggle('hidden');
}
</script>