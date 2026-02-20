<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::post("/register", [AuthController::class, "register"])->name("register");
Route::post("/login", [AuthController::class, "login"])->name("login");

Route::middleware("auth:sanctum")->group(function () {
    Route::post("/logout", [AuthController::class, "logout"])->name("logout");
    Route::get("/user", [AuthController::class, "user"])->name("user");

    Route::prefix("posts")->group(function () {
        Route::get("/", [PostController::class, "index"])->name("posts.index");
        Route::post("/", [PostController::class, "store"])->name("posts.store");
        Route::put("/{post}", [PostController::class, "update"])->name("posts.update");
        Route::delete("/{post}", [PostController::class, "destroy"])->name("posts.destroy");
        Route::get("/{post}", [PostController::class, "getById"])->name("posts.getById");
    });

    Route::prefix("comments")->group(function () {
        Route::get("/", [CommentController::class, "index"])->name("comments.index");
        Route::post("/", [CommentController::class, "store"])->name("comments.store");
        Route::put("/{comment}", [CommentController::class, "update"])->name("comments.update");
        Route::delete("/{comment}", [CommentController::class, "destroy"])->name("comments.destroy");
        Route::get("/{comment}", [CommentController::class, "getById"])->name("comments.getById");
    });
});