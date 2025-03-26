<?php

use App\Http\Controllers\Nip05Controller;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/.well-known/nostr.json', [Nip05Controller::class, 'resolve']);
