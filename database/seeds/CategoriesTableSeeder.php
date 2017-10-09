<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->truncate();

        DB::table('categories')->insert([
        	[
        		'title'	=> 'Web Design',
        		'slug'	=> 'web-design'
        	],
        	[
        		'title'	=> 'Web Programming',
        		'slug'	=> 'web-programming'
        	],
        	[
        		'title'	=> 'Internet',
        		'slug'	=> 'internet'
        	],
        	[
        		'title'	=> 'Social Marketing',
        		'slug'	=> 'social-marketing'
        	],
        	[
        		'title'	=> 'Photography',
        		'slug'	=> 'photography'
        	],
            [
                'title' => 'Uncategorized',
                'slug'  => 'uncategorized'
            ],
        ]);

        foreach(Post::pluck('id') as $postId)
        {
            $categories = Category::pluck('id');
        	$categoryId = $categories[rand(0,$categories->count()-1)];

        	DB::table('posts')->where('id', $postId)->update(['category_id' => $categoryId]);
        }
    }
}
