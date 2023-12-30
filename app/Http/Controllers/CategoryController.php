<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\Category;
use Spatie\QueryBuilder\QueryBuilder;
use App\Services\PaginationMetaService;
use App\Http\Resources\SitesListResource;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoriesListResource;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\CategoryDetailsResource;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoryController extends Controller
{
    protected $paginationMetaService;

    public function __construct(PaginationMetaService $paginationMetaService)
    {
        $this->paginationMetaService = $paginationMetaService;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categoriesQuery = QueryBuilder::for(Category::class)
            ->with(['media'])
            ->select(['id', 'name', 'created_at'])
            ->allowedFilters(['name'])
            ->latest();

        $categories = request()->page === null ? $categoriesQuery->get() : $categoriesQuery->paginate(request()->input('limit'));

        // Use PaginationMetaService to get pagination meta data
        $paginationMeta = $categories instanceof LengthAwarePaginator ?
            $this->paginationMetaService->generatePaginationMeta($categories) : null;

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
        $sitesQuery = QueryBuilder::for(Site::class)
            ->where('category_id', $category->id)
            ->with(['media'])
            ->select(['id', 'name', 'created_at'])
            ->allowedFilters(['name'])
            ->latest();

        $sites = request()->page === null ? $sitesQuery->get() : $sitesQuery->paginate(request()->input('limit'));

        // Use PaginationMetaService to get pagination meta data
        $paginationMeta = $sites instanceof LengthAwarePaginator ?
            $this->paginationMetaService->generatePaginationMeta($sites) : null;

        return response()->json([
            'meta' => $paginationMeta,
            'category' => $category->name,
            'data' => SitesListResource::collection($sites),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->validated());

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $category->clearMediaCollection('photos');
            $photo = $request->file('photo');
            $category->addMedia($photo)->toMediaCollection('photos');
        }

        // $oldPhotoPath = $category->photo; // Get the path of the old photo
        // if ($oldPhotoPath && Storage::disk('public')->exists($oldPhotoPath)) {
        //     Storage::disk('public')->delete($oldPhotoPath); // Delete the old photo
        // }

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
}
