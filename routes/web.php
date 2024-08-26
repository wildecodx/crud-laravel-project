<?php

use App\Http\Controllers\Usercontroller;
use Illuminate\Support\Facades\Route;


Route::get('/', function() {
  return view('index');
});

Route::post('adddata', [Usercontroller::class, 'adddata']); // call the function in controller and use that controller in routes

Route::get('getdata', [Usercontroller::class, 'getdata']); // retrieve the data from db

Route::post('editdata', [Usercontroller::class, 'editdata']); // edit the data from db

Route::post('deletedata', [Usercontroller::class, 'deletedata']); //delete the data from db