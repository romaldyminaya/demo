<?php

use App\Http\Livewire\Form;
use App\Models\Blog\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

\Illuminate\Support\Facades\Route::get('form', Form::class);

Route::get('test', function (Request $request) {
    return Author::all();
});
