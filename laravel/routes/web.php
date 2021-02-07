<?php

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
})->name('login');

Route::get('/teste', function()
{
     // \App\Models\User::factory(10)->create();
    //  \App\Models\User::insert([
    //     'name' => 'User1',
    //     'email' => 'user1@email.com',
    //     'password' => bcrypt('password'),
    // ]);
    // \App\Models\User::insert([
    //     'name' => 'user2',
    //     'email' => 'user2@email.com',
    //     'password' => bcrypt('password'),
    // ]);

    dd(\App\Models\User::all());
})->name('teste');;
