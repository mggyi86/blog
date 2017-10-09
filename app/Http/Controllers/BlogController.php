<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\User;
use App\Tag;

class BlogController extends Controller
{
	protected $limit = 2;

    public function index() {
    	// \DB::enableQueryLog();
    	$posts = Post::with('author', 'tags', 'category')
                    ->latestFirst()->published()
                    ->filter(request()->only(['term', 'year', 'month']))
                    ->simplePaginate($this->limit);

    	return view("blog.index", compact("posts"));

    	// dd(\DB::getQueryLog());
    }

    public function category(Category $category) {
        
        $categoryName = $category->title;

    	// $posts = Post::with('author')->where('category_id', $id)->latestFirst()->published()->simplePaginate($this->limit);
        $posts = $category->posts()->with('author', 'tags')->latestFirst()->published()->simplePaginate($this->limit);

    	return view("blog.index", compact("posts", "categoryName"));

    }

    public function tag(Tag $tag) {

        $tagName = $tag->name;

        $posts = $tag->posts()->with('author', 'category')->latestFirst()->published()->simplePaginate($this->limit);

        return view("blog.index", compact("posts", "tagName"));

    }

    public function author(User $author) {

        $authorName = $author->name;

        // $posts = Post::with('author')->where('category_id', $id)->latestFirst()->published()->simplePaginate($this->limit);
        $posts = $author->posts()->with('category', 'tags')->latestFirst()->published()->simplePaginate($this->limit);

        return view("blog.index", compact("posts", "authorName"));
    }

    public function show(Post $post) {
        $post->increment('view_count');
    	return view("blog.show", compact("post"));
    }
}
