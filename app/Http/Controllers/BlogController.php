<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\User;

class BlogController extends Controller
{
	protected $limit = 2;

    public function index() {
    	// \DB::enableQueryLog();
    	$posts = Post::with('author')->latestFirst()->published()->simplePaginate($this->limit);
    	return view("blog.index", compact("posts"));

    	// dd(\DB::getQueryLog());
    }

    public function category(Category $category) {
        
        $categoryName = $category->title;

    	// $posts = Post::with('author')->where('category_id', $id)->latestFirst()->published()->simplePaginate($this->limit);
        $posts = $category->posts()->with('author')->latestFirst()->published()->simplePaginate($this->limit);

    	return view("blog.index", compact("posts", "categoryName"));

    }

    public function author(User $author) {

        $authorName = $author->name;

        // $posts = Post::with('author')->where('category_id', $id)->latestFirst()->published()->simplePaginate($this->limit);
        $posts = $author->posts()->with('category')->latestFirst()->published()->simplePaginate($this->limit);

        return view("blog.index", compact("posts", "authorName"));
    }

    public function show(Post $post) {
        $post->increment('view_count');
    	return view("blog.show", compact("post"));
    }
}
