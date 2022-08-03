<?php

use App\Http\Controllers\AnnotationController;
use App\Http\Controllers\CorrespondantController;
use App\Http\Controllers\CourrierController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\NatureController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\TraitementController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// route des dashboard
Route::controller(RouteController::class)->group(function () {
    Route::get('/', 'home')->name('Acceuil');

    Route::get('profile', 'profile')->name('Profile');

    Route::get('compte', 'compte')->name('Compte');

    Route::get('traitement', 'traitement')->name('Traitement');

    Route::get('nature', 'nature')->name('Nature');

    Route::get('departement', 'departement')->name('Departement');

    Route::get('correspondant', 'correspondant')->name('Correspondant');

    Route::get('annotation', 'annotation')->name('Annotation');

    Route::get('imputation', 'imputation')->name('Imputation');

    Route::get('archive/courrier', 'archive_courrier')->name('archive.courrier');

    Route::get('archive/document', 'archive_document')->name('archive.document');
});

// route courrier controlleur
Route::controller(CourrierController::class)->group(function () {
    Route::post('new/courrier', 'create')->name('new.courrier');
    Route::get('edit/courrier/{id}', 'edit')->whereNumber('id')->name('edit.courrier');
    Route::get('show/courrier/{id}', 'show')->whereNumber('id')->name('show.courrier');
    Route::post('update/courrier', 'update')->name('update.courrier');
    Route::post('delete/courrier/{id}', 'delete');
    // Route::get('pdf', 'createPDF');
});

// route nature courrier controlleur
Route::controller(NatureController::class)->group(function () {
    Route::post('new/nature', 'create')->name('new.nature');
    Route::get('edit/nature/{id}', 'edit')->whereNumber('id')->name('edit.nature');
    Route::post('update/nature', 'update')->name('update.nature');
    Route::post('delete/nature/{id}', 'delete');
});

// route traitement courrier
Route::controller(TraitementController::class)->group(function () {
    // Route::post('new/traitement', 'create')->name('new.traitement');
    Route::get('edit/traitement/{id}', 'edit')->whereNumber('id')->name('edit.traitement');
    // Route::post('update/traitement', 'update')->name('update.traitement');
    // Route::post('delete/traitement/{id}', 'delete');
});

// route departement controlleur
Route::controller(DepartementController::class)->group(function () {
    Route::post('new/departement', 'create')->name('new.departement');
    Route::get('edit/departement/{id}', 'edit')->whereNumber('id')->name('edit.departement');
    Route::post('update/departement', 'update')->name('update.departement');
    Route::post('delete/departement/{id}', 'delete');
});

// route correspondant controlleur
Route::controller(CorrespondantController::class)->group(function () {
    Route::post('new/correspondant', 'create')->name('new.correspondant');
    Route::get('edit/correspondant/{id}', 'edit')->whereNumber('id')->name('edit.correspondant');
    Route::post('update/correspondant', 'update')->name('update.correspondant');
    Route::post('delete/correspondant/{id}', 'delete');
});

// route Annotation courrier
Route::controller(AnnotationController::class)->group(function () {
    Route::post('new/annotation', 'create')->name('new.annotation');
    Route::get('edit/annotation/{id}', 'edit')->whereNumber('id')->name('edit.annotation');
    Route::post('update/annotation', 'update')->name('update.annotation');
    Route::post('delete/annotation/{id}', 'delete');
});

// route utilisateur controlleur
Route::controller(UserController::class)->group(function () {
    Route::get('edit/user/{id}', 'edit')->whereNumber('id')->name('edit.user');
    Route::post('update/user', 'update')->name('update.user');
    Route::post('delete/user/{id}', 'delete');
});

// route utilisateur controlleur
Route::controller(DocumentController::class)->group(function () {
    Route::get('edit/document/{id}', 'edit')->whereNumber('id')->name('edit.document');
    Route::post('update/document', 'update')->name('update.document');
    Route::post('delete/document/{id}', 'delete');
});

require __DIR__ . '/auth.php';
