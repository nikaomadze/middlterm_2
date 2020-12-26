@extends("layout.master")

@section("content")

<div class="container">
    <div class="col-md-6 offset-3">
        <form method="post">
            <div class="foarm-group">
                <h2>სიახლის დამატება</h2>
            </div>
            <div class="form-group">
                @if(Session::get("message"))

                    <div class="alert alert-success">
                        {{ Session::get("message") }}
                    </div>

                @endif
            </div>
            <div class="form-group">
                <label>სიახლის სათაური</label>
                <input type="text" name="news_title" class="form-control">
            </div>
            <div class="form-group">
                <label>სიახლის ტექსტი</label>
                <textarea name="news_text" class="form-control"></textarea>
            </div>
            <div class="form-group">
                @csrf
                <button class="btn btn-info" name="submit">დამატება</button>
            </div>
        </form>
    </div>
</div>

@endsection