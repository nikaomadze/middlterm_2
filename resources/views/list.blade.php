@extends("layout.master")

@section("content")

	<div class="container">

		@foreach($posts as $post)

        <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow mt-3 p-2 sm:rounded-lg">
            <div class="grid grid-cols-1 md:grid-cols-1">

                <div class="p-6 border-t border-gray-200 dark:border-gray-700">
                    <div class="ml-12">
                        <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                            {{ $post->text }}
                            <p>Author: {{ $post->name }}</p>
                        </div>
                    </div>

                    <div id="is_published_{{ $post->id }}">
                        @if(!$post->is_published && Auth::user()->role !== 'admin')
                            გამოუქვეყნებელი
                        @elseif(!$post->is_published  && Auth::user()->role == 'admin')
                            <a href="/" onclick="publishNews({{ $post->id }}); return false;">
                                გამოქვეყნება
                            </a>
                        @else
                            გამოქვეყნებული
                        @endif
                    </div>

                    @if(Auth::id() == $post->user_id)
                        <a href="/posts/delete/{{ $post->id }}" class="dark:text-gray-400 text-sm">Delete</a>
                    @endif
                </div>
            </div>
        </div>

        @endforeach
    </div>

    <script>
        const publishNews = (postId) => {
            const publishNode = document.getElementById(`is_published_${postId}`)
            publishNode.innerHTML += `<span>დაელოდეთ</span>`
            fetch(`{{ url("/") }}/posts/publish/${postId}`)
                .then(response => response.json())
                .catch((error) => alert("დაფიქსირდა შეცდომა, სცადეთ მოგვიანებით"))
                .then(response => {
                    publishNode.childNodes[0].innerHTML = ''
                    if (response.res)
                        publishNode.innerHTML = "გამოქვეყნებული"
                    else 
                        alert("დაფიქსირდა შეცდომა, სცადეთ მოგვიანებით")
                });
        }
    </script>

@endsection