<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AppController;

Route::get('/', function () {
    return view('site.index');
});

Route::view('/chatbot', 'site.components.chatbot')->name('chatbot');


#--------- rotas dinamicas ---------
Route::get('{pagename}',[AppController::class,'index'])->name('app.index');
Route::get('{pagename}/create',[AppController::class,'create'])->name('app.create');
Route::post('{pagename}/store',[AppController::class,'store'])->name('app.store');
Route::get('{pagename}/{id}/show/', [AppController::class,'show'])->name('app.show');
Route::get('{pagename}/{id}/edit',[AppController::class,'edit'])->name('app.edit');
Route::put('{pagename}/{id}/update',[AppController::class,'update'])->name('app.update');
Route::delete('{pagename}/remove',[AppController::class,'remove'])->name('app.remove');
Route::delete('{pagename}/destroy',[AppController::class,'destroy'])->name('app.destroy');
Route::delete('{pagename}/restore',[AppController::class,'restore'])->name('app.restore');


// rota de post dinâmico geral: Agrupada em Route::match para evitar conflito de nome.
// Esta linha substitui as 3 rotas separadas (POST, PUT, DELETE) que tinham o mesmo nome 'app.post'.
Route::match(['post', 'put', 'delete'], '{pagename}/{methodname}/{arg1?}', [AppController::class, 'post'])->name('app.post');

// Rota GET dinâmica continua separada
Route::get('{pagename}/{methodname}/{arg1?}',[AppController::class,'get'])->name('app.get');