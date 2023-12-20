<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoriesListResource;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\CategoryDetailsResource;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categoriesQuery = QueryBuilder::for(Category::class)
            ->select(['id', 'name', 'created_at'])
            ->allowedFilters(['name'])
            ->latest();

        $categories = request()->page === null ? $categoriesQuery->get() : $categoriesQuery->paginate(request()->input('limit'));

        // Get the pagination meta information using the function
        $paginationMeta = $this->generatePaginationMeta($categories);

        return response()->json([
            'meta' => $paginationMeta,
            'data' => CategoriesListResource::collection($categories),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = Category::create($request->validated());

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $category->addMedia($photo)->toMediaCollection('photos');
        }

        return response()->json([
            'message' => trans('messages.add'),
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return response()->json([
            'data' => new CategoryDetailsResource($category),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->validated());

        return response()->json([
            'message' => trans('messages.edit'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json([
            'message' => trans('messages.delete'),
        ]);
    }


    // Function to generate meta information for pagination
    public function generatePaginationMeta(LengthAwarePaginator $paginator = null)
    {
        if ($paginator) {
            return [
                "current_page" => $paginator->currentPage(),
                "last_page" => $paginator->lastPage(),
                "per_page" => $paginator->perPage(),
                "path" => $paginator->path(),
                "fragment" => $paginator->fragment(),
                "first_page_url" => $paginator->url(1),
                "last_page_url" => $paginator->url($paginator->lastPage()),
                "next_page_url" => $paginator->nextPageUrl(),
                "prev_page_url" => $paginator->previousPageUrl(),
                "from" => $paginator->firstItem(),
                "to" => $paginator->lastItem(),
                "total" => $paginator->total(),
                'links' => $paginator->render(),
            ];
        }

        return null;
    }
}
