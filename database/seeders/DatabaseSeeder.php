<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Like;
use App\Models\Question;
use App\Models\Reply;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use function Symfony\Component\String\truncate;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */



    public function run()
    {

//        User::query()->truncate();
//        Question::query()->truncate();
//        Category::query()->truncate();
//        Reply::query()->truncate();


        User::factory(10)->create();
        Category::factory(5)->create();
        Question::factory(10)->create();

        // Whenever we create reply
        // Each reply has 1 like or likes
        // ** That will create only one like/likes on each reply **

        Reply::factory(50)->create()->each(function ($reply){
            return $reply->like()->save(Like::factory()->make());
        });
    }
}
