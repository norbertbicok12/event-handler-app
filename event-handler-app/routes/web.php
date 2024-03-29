<?php

use App\Http\Controllers\AuthController;
use \App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [EventController::class, 'index'])->name('index');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');
Route::get('/search', [EventController::class, 'search'])->name('events.search');
Route::get('/subscribe/{id}', [EventController::class, 'subscribe'])->name('subscribe');
Route::get('/unsubscribe/{id}', [EventController::class, 'unsubscribe'])->name('unsubscribe');
Route::get('/create', [EventController::class, 'showCreateForm'])->name('create');
Route::get('/my_events', [EventController::class, 'showUserEvents'])->name('my.events');

Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
Route::post('/register', [AuthController::class, 'registerPost'])->name('register.post');

Route::post('/create', [EventController::class, 'createEvent'])->name('create.event');
Route::delete('/events/{id}', [EventController::class, 'destroy'])->name('events.destroy');
Route::post('/update', [EventController::class, 'updateEventPost'])->name('update.event.post');

Route::get('/update/{id}', [EventController::class, 'updateEvent'])->name('update.event');

Route::get('/my_participations', [EventController::class, 'showUserParticipations'])->name('my.participations');
