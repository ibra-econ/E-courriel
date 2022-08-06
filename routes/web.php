<?php

use App\Http\Controllers\AnnotationController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\CorrespondantController;
use App\Http\Controllers\CourrierController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ImputationController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\NatureController;
use App\Http\Controllers\PosteController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
// route des dashboard
Route::controller(RouteController::class)->group(function () {
    Route::get('/', 'dashboard')->name('dashboard');

    Route::get('courrier/arriver', 'arriver')->name('Arriver');

    Route::get('courrier/depart', 'depart')->name('Depart');

    Route::get('profile', 'profile')->name('Profile');

    Route::get('compte', 'compte')->name('Compte');

    Route::get('config', 'config')->name('Config');

    Route::get('traitement', 'traitement')->name('Traitement');

    Route::get('nature', 'nature')->name('Nature');

    Route::get('departement', 'departement')->name('Departement');

    Route::get('correspondant', 'correspondant')->name('Correspondant');

    Route::get('annotation', 'annotation')->name('Annotation');

    Route::get('imputation', 'imputation')->name('Imputation');

    Route::get('archive/courrier', 'archive_courrier')->name('archive.courrier');

    Route::get('document', 'document')->name('document');

    Route::get('journal', 'journal')->name('Journal');
});
});
// route courrier controlleur
Route::controller(CourrierController::class)->group(function () {
    Route::post('new/courrier', 'create')->name('new.courrier');

    Route::get('edit/courrier/{id}', 'edit')->whereNumber('id')->name('edit.courrier');

    Route::get('show/courrier/{id}', 'show')->whereNumber('id')->name('show.courrier');

    Route::get('fiche/courrier/{id}', 'fiche')->whereNumber('id')->name('fiche.courrier');

    Route::post('update/courrier', 'update')->name('update.courrier');

    Route::post('delete/courrier/{id}', 'delete');

    Route::get('courrier/corbeille', 'corbeille')->name('corbeille.courrier');

    Route::post('restore/courrier/{id}', 'restore');

    Route::post('restore/all/courrier', 'restore_all');
});

// route config controlleur
Route::controller(ConfigController::class)->group(function () {
    Route::get('edit/config/{id}', 'edit')->whereNumber('id')->name('edit.config');
    Route::post('update/config', 'update')->name('update.config');
});

// route user login journal controlleur
Route::controller(JournalController::class)->group(function () {
    Route::post('new/journal', 'create')->name('new.journal');

    Route::get('edit/journal/{id}', 'edit')->whereNumber('id')->name('edit.journal');

    Route::post('update/journal', 'update')->name('update.journal');

    Route::post('delete/journal/{id}', 'delete');

    Route::get('journal/corbeille', 'corbeille')->name('corbeille.journal');

    Route::post('restore/journal/{id}', 'restore');

    Route::post('restore/all/journal', 'restore_all');
});

// route nature courrier controlleur
Route::controller(NatureController::class)->group(function () {
    Route::post('new/nature', 'create')->name('new.nature');

    Route::get('edit/nature/{id}', 'edit')->whereNumber('id')->name('edit.nature');

    Route::post('update/nature', 'update')->name('update.nature');

    Route::post('delete/nature/{id}', 'delete');

    Route::get('nature/corbeille', 'corbeille')->name('corbeille.nature');

    Route::post('restore/nature/{id}', 'restore');

    Route::post('restore/all/nature', 'restore_all');
});

// route imputation courrier
Route::controller(ImputationController::class)->group(function () {
    Route::post('new/imputation', 'create')->name('new.imputation');

    Route::get('show/imputation/{id}', 'show')->whereNumber('id')->name('show.imputation');

    Route::get('edit/imputation/{id}', 'edit')->whereNumber('id')->name('edit.imputation');

    Route::get('pdf/imputation/{id}', 'fiche')->whereNumber('id')->name('pdf.imputation');

    Route::post('update/imputation', 'update')->name('update.imputation');

    Route::post('delete/imputation/{id}', 'delete');

    Route::get('imputation/corbeille', 'corbeille')->name('corbeille.imputation');

    Route::post('restore/imputation/{id}', 'restore');

    Route::post('restore/all/imputation', 'restore_all');
});

// route departement controlleur
Route::controller(DepartementController::class)->group(function () {
    Route::post('new/departement', 'create')->name('new.departement');

    Route::get('edit/departement/{id}', 'edit')->whereNumber('id')->name('edit.departement');

    Route::post('update/departement', 'update')->name('update.departement');

    Route::post('delete/departement/{id}', 'delete');

    Route::get('departement/corbeille', 'corbeille')->name('corbeille.departement');

    Route::post('restore/departement/{id}', 'restore');

    Route::post('restore/all/departement', 'restore_all');
});

// route correspondant controlleur
Route::controller(CorrespondantController::class)->group(function () {

    Route::post('new/correspondant', 'create')->name('new.correspondant');

    Route::get('edit/correspondant/{id}', 'edit')->whereNumber('id')->name('edit.correspondant');

    Route::post('update/correspondant', 'update')->name('update.correspondant');

    Route::post('delete/correspondant/{id}', 'delete');

    Route::get('correspondant/corbeille', 'corbeille')->name('corbeille.correspondant');

    Route::post('restore/correspondant/{id}', 'restore');

    Route::post('restore/all/correspondant', 'restore_all');
});

// route Annotation courrier
Route::controller(AnnotationController::class)->group(function () {
    Route::post('new/annotation', 'create')->name('new.annotation');

    Route::get('edit/annotation/{id}', 'edit')->whereNumber('id')->name('edit.annotation');

    Route::post('update/annotation', 'update')->name('update.annotation');

    Route::post('delete/annotation/{id}', 'delete');

    Route::get('annotation/corbeille', 'corbeille')->name('corbeille.annotation');

    Route::post('restore/annotation/{id}', 'restore');

    Route::post('restore/all/annotation', 'restore_all');

    // Route::get('supprimer/annotation/{id}', 'force_delete');

    // Route::get('supprimer/all/annotation', 'force_delete_all');
});

// route utilisateur controlleur
Route::controller(UserController::class)->group(function () {

    Route::get('show/user/{id}', 'show')->whereNumber('id')->name('show.user');

    Route::get('edit/user/{id}', 'edit')->whereNumber('id')->name('edit.user');

    Route::post('update/user', 'update')->name('update.user');

    Route::post('delete/user/{id}', 'delete');

    Route::get('user/corbeille', 'corbeille')->name('corbeille.user');

    Route::post('restore/user/{id}', 'restore');

    Route::post('restore/all/user', 'restore_all');
});

// route poste controlleur
Route::controller(PosteController::class)->group(function () {
    Route::post('new/poste', 'create')->name('new.poste');

    Route::get('edit/poste/{id}', 'edit')->whereNumber('id')->name('edit.poste');

    Route::post('update/poste', 'update')->name('update.poste');

    Route::post('delete/poste/{id}', 'delete');

    Route::get('poste/corbeille', 'corbeille')->name('corbeille.poste');

    Route::post('restore/poste/{id}', 'restore');

    Route::post('restore/all/poste', 'restore_all');
});

// route document controlleur
Route::controller(DocumentController::class)->group(function () {
    Route::get('edit/document/{id}', 'edit')->whereNumber('id')->name('edit.document');

    Route::get('file_view/document/{id}', 'file_view')->whereNumber('id')->name('show.document');

    Route::post('update/document', 'update')->name('update.document');

    Route::post('delete/document/{id}', 'delete');

    Route::get('document/corbeille', 'corbeille')->name('corbeille.document');

    Route::post('restore/document/{id}', 'restore');

    Route::post('restore/all/document', 'restore_all');
});

require __DIR__ . '/auth.php';
