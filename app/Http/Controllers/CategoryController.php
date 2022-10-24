<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use \Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        // what this jwt do?

        $this->middleware('jwt', ['except' => ['index','show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return CategoryResource::collection(Category::query()->latest()->get());

//        return Category::query()->latest()->get();
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
        return response(new CategoryResource($category),Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return CategoryResource
     */
    public function show(Category $category)
    {
        return new CategoryResource($category);
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
                'slug'=>Str::of($request->name)->slug("-"),
            ]
        );
//        $category->name = $request->name;
//        $category->slug = Str::of($category->name)->slug("-");
//        $category->saveOrFail();
        return response(new CategoryResource($category), Response::HTTP_CREATED);
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
