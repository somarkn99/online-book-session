<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAuthorRequest;
use App\Models\Author;
use App\Services\ApiResponseService;
use App\Services\AuthorService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthorController extends Controller
{

    protected $authorService;

    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request) : JsonResponse
    {
        $per_page = $request->only(['per_page']);

        $authors = $this->authorService->listAuthor($per_page);

        return ApiResponseService::paginated($authors, 'Authors retrieved successfully');
    }

    /**
     * Store a new author.
     *
     * @param StoreAuthorRequest $request
     * @return JsonResponse
     */
    public function store(StoreAuthorRequest $request): JsonResponse
    {
        // Validate the request data
        $data = $request->validated();

        // Create a new author with the validated data
        $author = $this->authorService->createAuthor($data);

        // Return a success response with the created author data
        return ApiResponseService::success($author, 'Author created successfully', 201);
    }

    /**
     * Show details of a specific author.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        // Retrieve the details of the author by its ID
        $author = $this->authorService->getAuthor($id);

        // Return a success response with the author details
        return ApiResponseService::success($author, 'Author details retrieved successfully');
    }

    /**
     * Update a specific author.
     *
     * @param UpdateAuthorRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateAuthorRequest $request, int $id): JsonResponse
    {
        // Validate the request data
        $data = $request->validated();

        // Update the author with the validated data
        $author = $this->authorService->updateAuthor($data, $id);

        // Return a success response with the updated author data
        return ApiResponseService::success($author, 'Author updated successfully');
    }

    /**
     * Delete a specific author.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        // Delete the author by its ID
        $this->authorService->deleteAuthor($id);

        // Return a success response indicating the author was deleted
        return ApiResponseService::success(null, 'Author deleted successfully');
    }
}
