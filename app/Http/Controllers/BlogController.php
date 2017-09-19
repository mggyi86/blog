<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;

class BlogController extends Controller
{
	protected $limit = 3;

    public function index() {
    	// \DB::enableQueryLog();

    	$categories = Category::with(['posts' => function($query) {
    		$query->published();
    	}])->orderBy('title', 'asc')->get();
    	$posts = Post::with('author')->latestFirst()->published()->simplePaginate($this->limit);
    	return view("blog.index", compact("posts", "categories"));

    	// dd(\DB::getQueryLog());
    }

    public function category($id) {
    	$categories = Category::with(['posts' => function($query) {
    		$query->published();
    	}])->orderBy('title', 'asc')->get();
    	$posts = Post::with('author')->where('category_id', $id)->latestFirst()->published()->simplePaginate($this->limit);
    	return view("blog.index", compact("posts", "categories"));
    }

    public function show(Post $post) {
    	return view("blog.show", compact("post"));
    }
}
