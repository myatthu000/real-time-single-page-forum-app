<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use function Symfony\Component\String\Slugger\slug;

class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->title;
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'body' => $this->faker->sentence,
            'category_id' => function(){
                return Category::all()->random();
            },
            'user_id' => function(){
                return User::all()->random();
            }
        ];
    }
}
