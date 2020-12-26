@extends("layout.master")

@section("content")


	<div class="container">

		<div class="mb-5">
            <h3>
            	Author:
            </h3>
        	<div>{{ $author->name }}</div>
        	<div>{{ $author->email }}</div>
        </div>


        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <td>id</td>
                    <td>title</td>
                    <td>content</td>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                <tr class="{{ ($post->is_published) ? "success" : "error" }}">
                    <td>{{$post->id}}</td>
                    <td>{{$post->title}}</td>
                    <td>{{$post->text}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

@endsection