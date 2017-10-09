<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use Carbon\Carbon;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('posts')->truncate();

        $posts = [];
        $faker = Factory::create();
        $date  = Carbon::create();

        for ($i = 0; $i <100; $i++)
        {
        	$image = "Post_Image_" . rand(1, 5) . ".jpg";
        	$date = $date->subMonths(1);
            $publishedDate = clone($date);

        	$posts[] = [
        		'author_id' => rand(1, 3),
        		'title' => $faker->sentence(rand(8, 12)),
        		'excerpt' => $faker->text(rand(250, 300)),
        		'body' => $faker->paragraphs(rand(10, 15), true),
        		'slug'		=> $faker->slug(),
        		'image'		=> rand(0,1) == 1? $image : NULL,
        		'created_at' => clone($date->addDays(rand(1,30))),
        		'updated_at' => clone($date),
                'published_at' => $i < 3 ? $publishedDate : ( rand(0,1) == 0? NULL : $publishedDate->subMonths(4)),
                'view_count'   => rand(1,10) * 10
        	];
        }

        DB::table('posts')->insert($posts);
    }
}
