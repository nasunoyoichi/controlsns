<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gray-800 border-b border-gray-700">
                    <!-- 新規投稿フォーム -->
                    <form action="{{ route('posts.store') }}" method="POST" class="mb-6">
                        @csrf
                        <textarea name="content" rows="4" class="w-full p-2 border rounded bg-gray-700 text-black" placeholder="What's on your mind?"></textarea>
                        <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Post</button>
                    </form>

                    <!-- 投稿一覧 -->
                    @foreach($posts as $post)
                        <div class="post mb-4 p-4 border border-gray-700 rounded bg-gray-700 text-white">
                            <p>{{ $post->content }}</p>
                            <small class="text-gray-300">Posted by: {{ $post->user->name }} on {{ $post->created_at->format('Y-m-d H:i') }}</small>
                            
                            @if(Auth::id() === $post->user_id)
                                <div class="post-actions mt-2">
                                    <button onclick="showEditForm({{ $post->id }})" class="px-2 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">Edit</button>
                                    
                                    <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                                    </form>
                                </div>

                                <!-- 編集フォーム（初期状態は非表示） -->
                                <div id="edit-form-{{ $post->id }}" class="edit-form mt-2" style="display: none;">
                                    <form action="{{ route('posts.update', $post) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <textarea name="content" rows="3" class="w-full p-2 border rounded bg-gray-600 text-black" style="color: black;">{{ $post->content }}</textarea>
                                        <button type="submit" class="px-2 py-1 bg-green-500 text-white rounded hover:bg-green-600">Update</button>
                                        <button type="button" onclick="hideEditForm({{ $post->id }})" class="px-2 py-1 bg-gray-500 text-white rounded hover:bg-gray-600">Cancel</button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    @endforeach

                    <!-- ページネーション -->
                    <div class="mt-4 text-white">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function showEditForm(postId) {
            document.getElementById(`edit-form-${postId}`).style.display = 'block';
        }

        function hideEditForm(postId) {
            document.getElementById(`edit-form-${postId}`).style.display = 'none';
        }
    </script>
    @endpush
</x-app-layout>