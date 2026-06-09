<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;

Route::get('/events', [ApiController::class, 'getEvents']);
Route::get('/achievements', [ApiController::class, 'getAchievements']);
Route::get('/members', [ApiController::class, 'getMembers']);
