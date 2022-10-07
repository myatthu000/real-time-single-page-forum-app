<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use \Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Builder[]|Collection
     */
    public function index()
    {
        return Category::query()->latest()->get();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        Category::query()->create($request->all());
        $category = new Category();
        $category->name = $request->name;
        $category->slug = Str::of($category->name)->slug("-");
        $category->saveOrFail();
        return response("Created",Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return Category
     */
    public function show(Category $category)
    {
        return $category;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $category->updateOrFail(
            [
                'name' => $request->name,
                'slug'=>Str::of($request->name)->slug("-")
            ]
        );
//        $category->name = $request->name;
//        $category->slug = Str::of($category->name)->slug("-");
//        $category->saveOrFail();
        return response("Updated", Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->deleteOrFail();
        return \response(null, Response::HTTP_NO_CONTENT);
    }
}
