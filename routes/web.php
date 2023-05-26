<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\MiscController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::middleware("auth")->group(function () {
    Route::get("/", fn () => redirect()->route("contact.index"));
    Route::resource("contact", ContactController::class);
    Route::get("trash", [MiscController::class, 'showTrash'])->name("showTrash");
    Route::delete("trash/{id}", [MiscController::class, 'permanentDelete'])->name("permanentDelete");
    Route::delete("bulkDelete", [MiscController::class, 'bulkDelete'])->name("bulkDelete");
    Route::delete("bulkAction", [MiscController::class, 'bulkAction'])->name('bulkAction');
    Route::post("/send", [MiscController::class, 'sendContact'])->name('sendContact');
    Route::get("/contactQueue/{id}", [MiscController::class, 'contactQueue'])->name('contactQueue');

    Route::post("/contact/accept/{id}", [MiscController::class, 'acceptContact'])->name('contact.accept');
    Route::get("/contact/deny/{id}", [MiscController::class, 'denyContact'])->name('contact.deny');

    Route::get("/notifications", [MiscController::class, 'notifications'])->name('notifications');
    Route::get("/notifications/read/{id}", [MiscController::class, 'notificationsRead'])->name('notification.read');
    Route::get("/notifications/readAll", [MiscController::class, 'notificationsReadAll'])->name('notification.readAll');
});
