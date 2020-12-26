<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Redirect;
use Auth;
use App\Models\User;
use App\Notifications\PostPublish;
use DB;

class PostsController extends Controller
{

	public function show() {
		$posts = DB::table("posts AS t1")
			->select("t1.id", "t1.title", "t1.text", "t1.user_id", "t1.is_published", "t2.name as name")
			->join("users AS t2", "t1.user_id", "=", "t2.id")
			->get();
		return view("list", compact("posts"));
	}

	public function deleteById($id) {
		Post::findOrFail($id)->delete();
		return Redirect::back();
	}


	public function create() {
		return view("create");
	}


	public function createPostRecord(Request $request) {

		$post = new Post();
		$post->title = $request->get("news_title");
		$post->text = $request->get("news_text");
        $post->user_id = Auth::id();
        $post->is_published = 0;
        $post->save();


		return Redirect::back()->with("message", "სიახლე წარმატებით დაემატა");
	}


	public function update($id) {
		$post = Post::find($id);
		return view("update", compact("post"));
	}

	public function publishPost($postId) {
		$post = Post::find($postId);
		$post->is_published = 1;
		$post->save();
		
		$data = [
			'post_id' => $postId
		];
		Auth::user()->notify(new PostPublish($data));
		return response()->json(["res" => true]);
	}


	public function updateRecord(Request $request) {
		$post = Post::find($request->get("id"));
		$post->title = $request->get("news_title");
		$post->text = $request->get("news_text");
		$post->save();
		return Redirect::back()->with("message", "სიახლე წარმატებით დააბდეითდა");
	}

	public function ownPosts() {
        $posts = Post::all()->where('user_id', Auth::id());
        $author = User::find(Auth::id());
        return view('my', compact('posts', 'author'));
    }


}
