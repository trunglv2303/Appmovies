<?php

use App\Http\Controllers\ControllerAdminFireBase;
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
    Route::get('/admin',function(){
        return view('Admin.main');
    
    });
    // Route::get('/productmovie', [ ControllerAdminFireBase::class, 'addMovie']);
    Route::prefix('/movie')->group(function () {
        Route::get('/add', [ ControllerAdminFireBase::class, 'viewaddproductmovie']);
        Route::post('/addmovie', [ ControllerAdminFireBase::class, 'addMovie'])->name('add_movie');
        Route::get('/list', [ ControllerAdminFireBase::class, 'listsmovie']);
        Route::get('/edit/{id}', [ ControllerAdminFireBase::class, 'editmovie']);
        Route::post('/edit/{id}', [ ControllerAdminFireBase::class, 'editmoviepost'])->name('editmovie');
    
        Route::get('/delete/{id}', [ ControllerAdminFireBase::class, 'deletemovie']);
    });
    Route::prefix('/type_movie')->group(function () {
        Route::get('/add', [ ControllerAdminFireBase::class, 'viewtype']);
        Route::post('/add', [ ControllerAdminFireBase::class, 'addtypemovie'])->name('addtype');
        Route::get('/edit/{id}', [ ControllerAdminFireBase::class, 'edittypemovie']);
        Route::post('/edit/{id}', [ ControllerAdminFireBase::class, 'edittypemoviepost'])->name('edittypemovie');
        Route::get('/delete/{id}', [ ControllerAdminFireBase::class, 'deletetypemovie'])->name('edittypemovie');
    
        Route::get('/list', [ ControllerAdminFireBase::class, 'listtype']);
    
    });
    Route::prefix('/user')->group(function () {
        Route::get('/list', [ ControllerAdminFireBase::class, 'listuser']);
        Route::get('/delete/{id}', [ ControllerAdminFireBase::class, 'deleteuser']);
    });
    Route::prefix('/comment')->group(function () {
        Route::get('/list', [ ControllerAdminFireBase::class, 'listcomment']);
        Route::get('/delete/{id}', [ ControllerAdminFireBase::class, 'deletecomment']);
    });
    Route::get('/addmovie', [ ControllerAdminFireBase::class, 'viewaddproductmovie']);
    Route::post('/addmovie', [ ControllerAdminFireBase::class, 'addMovie'])->name('add_movie');
    
  
    Route::get('/insert', function () {
     $stuRef=app('firebase.firestore')->database()->collection('Students')->newDocument();
     $stuRef->set(['
     firstname'=>'Seven','lastname'=>'Stac','age'=>19]);
    });
    

    
Route::get('/login',[ControllerAdminFireBase::class,'login'])->name('loginadmin');
Route::post('/loginadmin',[ControllerAdminFireBase::class,'loginadmin'])->name('login');
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
