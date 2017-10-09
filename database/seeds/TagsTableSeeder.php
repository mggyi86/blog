<?php

use Illuminate\Database\Seeder;
use App\Tag;
use App\Post;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->truncate();

        $tag_data = [
        	"PHP"			=>	"php",
        	"Symphony"		=>	"symphony",
        	"Codeigniter"	=> "codeigniter",
        	"Yii"			=>	"yii",
        	"Laravel"		=> "laravel",
        	"Ruby on Rails" => "ruby-on-rails",
        	"jQuery"		=> "j-query",
        	"Vue Js"		=> "vue-js",
        	"React Js"		=>	"react-js"
        ];


        foreach($tag_data as $key=>$value) {
        	$tag = new Tag();
        	$tag->name = $key;
        	$tag->slug = $value;
        	$tag->save();
        }

        // $php = new Tag();
        // $php->name = "PHP";
        // $php->slug = "php";
        // $php->save();

        // $laravel = new Tag();
        // $laravel->name = "Laravel";
        // $laravel->slug = "laravel";
        // $laravel->save();

        // $symphony = new Tag();
        // $symphony->name = "Symphony";
        // $symphony->slug = "symphony";
        // $symphony->save();

        // $vue = new Tag();
        // $vue->name = "Vue JS";
        // $vue->slug = "vuejs";
        // $vue->save();

        foreach(Tag::all() as $tag) {
        	$tags[] = $tag->id;
        }

        foreach (Post::all() as $post)
        {
        	shuffle($tags);

        	for($i=0;$i<rand(0, count($tags)-1);$i++)
        	{
        		$post->tags()->detach($tags[$i]);
        		$post->tags()->attach($tags[$i]);
        	}
        }
    }
}
