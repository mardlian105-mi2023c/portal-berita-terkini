 <nav class="bg-gray-800 text-white px-4 py-3 flex justify-between items-center">
        <div class="text-lg font-semibold">
            Admin Panel
        </div>

        <div class="space-x-4">
            <a href="{{ route('admin.news.index') }}" class="hover:underline">Dashboard</a>
            <a href="{{ route('admin.news.index') }}" class="hover:underline">Kelola Berita</a>

            {{-- Logout --}}
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                    Logout
                </button>
            </form>
        </div>
</nav>