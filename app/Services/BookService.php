<?php

namespace App\Services;

use App\Models\Book;
use Illuminate\Pagination\LengthAwarePaginator;

class BookService
{
    /**
     * List all books with optional filters.
     *
     * @param array $filters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function listBooks(array $filters, int $perPage): LengthAwarePaginator
    {
        // Initialize the query builder for the Book model
        $books = Book::query();

        // Apply author filter if provided
        if (isset($filters['author'])) {
            $books->where('author_id', $filters['author']);
        }

        // Return the paginated result of the query
        return $books->paginate($perPage);
    }

    /**
     * Create a new book.
     *
     * @param array $data
     * @return \App\Models\Book
     */
    public function createBook(array $data)
    {
        // Create a new book record with the provided data
        return Book::create($data);
    }

    /**
     * Get the details of a specific book by its ID.
     *
     * @param int $id
     * @return \App\Models\Book
     */
    public function getBook(int $id)
    {
        // Find the book by ID or fail with a 404 error if not found
        return Book::findOrFail($id);
    }

    /**
     * Update the details of a specific book.
     *
     * @param array $data
     * @param int $id
     * @return \App\Models\Book
     */
    public function updateBook(array $data, int $id)
    {
        // Find the book by ID or fail with a 404 error if not found
        $book = Book::findOrFail($id);

        // Update the book with the provided data, filtering out null values
        $book->update(array_filter($data));

        // Return the updated book
        return $book;
    }

    /**
     * Delete a specific book by its ID.
     *
     * @param int $id
     * @return void
     */
    public function deleteBook(int $id)
    {
        // Find the book by ID or fail with a 404 error if not found
        $book = Book::findOrFail($id);

        // Delete the book
        $book->delete();
    }
}
