<?php

use App\Http\Livewire\Administrator;
use App\Http\Livewire\Doctor;
use App\Http\Livewire\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/users', User::class)->name('users.list');
    Route::get('/users/{id}/view-record', [User::class, 'viewRecord'])->name('users.record');
    Route::get('/doctors', Doctor::class)->name('doctors.list');
    Route::get('/administrators', Administrator::class)->name('administrators.list');
});
