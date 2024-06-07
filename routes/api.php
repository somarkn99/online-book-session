<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    /**
     * Auth Routes
     *
     * These routes handle user authentication, including login, registration, and logout.
    */
    Route::controller(AuthController::class)->group(function () {
        /**
         * Login Route
         *
         * @method POST
         * @route /v1/login
         * @desc Authenticates a user and returns a JWT token.
         */
        Route::post('login', 'login');

        /**
         * Register Route
         *
         * @method POST
         * @route /v1/register
         * @desc Registers a new user and returns a JWT token.
         */
        Route::post('register', 'register');

        /**
         * Logout Route
         *
         * @method POST
         * @route /v1/logout
         * @desc Logs out the authenticated user.
         * @middleware auth:api
         */
        Route::post('logout', 'logout')->middleware('auth:api');
    });

    /**
     * Author Management Routes
     *
     * These routes handle author management operations.
     */
    Route::apiResource('authors', AuthorController::class)->middleware(['auth:api'])->except(['index', 'show']);

});
