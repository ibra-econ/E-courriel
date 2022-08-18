<?php

use App\Http\Controllers\AgendaController;
use App\Http\Controllers\AnnotationController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\CorrespondantController;
use App\Http\Controllers\CourrierController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\DiffusionController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ImputationController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\NatureController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\TraitementController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// si user is Admin
Route::middleware(['auth', 'isAdmin'])->group(function () {
// route des dashboard
    Route::controller(RouteController::class)->group(function () {

        Route::get('config', 'config')->name('Config');

        Route::get('departement', 'departement')->name('Departement');

        Route::get('journal', 'journal')->name('Journal');

    });

// route config controlleur
    Route::controller(ConfigController::class)->group(function () {
        Route::get('edit/config/{id}', 'edit')->whereNumber('id')->name('edit.config');
        Route::post('update/config', 'update')->name('update.config');
    });

// route user login journal controlleur
    Route::controller(JournalController::class)->group(function () {
        Route::post('delete/journal/{id}', 'delete');

        Route::get('journal/corbeille', 'corbeille')->name('corbeille.journal');

        Route::post('restore/journal/{id}', 'restore');

        Route::post('restore/all/journal', 'restore_all');
    });

    // route courrier controlleur
    Route::controller(CourrierController::class)->group(function () {

        Route::post('delete/courrier/{id}', 'delete');

        Route::get('courrier/corbeille', 'corbeille')->name('corbeille.courrier');

        Route::post('restore/courrier/{id}', 'restore');

        Route::post('restore/all/courrier', 'restore_all');
    });

// route nature courrier controlleur
    Route::controller(NatureController::class)->group(function () {

        Route::post('delete/nature/{id}', 'delete');

        Route::get('nature/corbeille', 'corbeille')->name('corbeille.nature');

        Route::post('restore/nature/{id}', 'restore');

        Route::post('restore/all/nature', 'restore_all');
    });

// route imputation courrier
    Route::controller(ImputationController::class)->group(function () {

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

        Route::post('delete/correspondant/{id}', 'delete');

        Route::get('correspondant/corbeille', 'corbeille')->name('corbeille.correspondant');

        Route::post('restore/correspondant/{id}', 'restore');

        Route::post('restore/all/correspondant', 'restore_all');
    });

// route Annotation courrier
    Route::controller(AnnotationController::class)->group(function () {

        // Route::post('delete/annotation/{id}', 'delete');

        Route::get('annotation/corbeille', 'corbeille')->name('corbeille.annotation');

        Route::post('restore/annotation/{id}', 'restore');

        Route::post('restore/all/annotation', 'restore_all');

    });

// route utilisateur controlleur
    Route::controller(UserController::class)->group(function () {

        Route::post('delete/user/{id}', 'delete');

        Route::get('user/corbeille', 'corbeille')->name('corbeille.user');

        Route::post('restore/user/{id}', 'restore');

        Route::post('restore/all/user', 'restore_all');
    });

    // route diffusion controlleur
    Route::controller(DiffusionController::class)->group(function () {

        Route::get('diffusion/corbeille', 'corbeille')->name('corbeille.diffusion');

        Route::post('restore/diffusion/{id}', 'restore');

        Route::post('restore/all/diffusion', 'restore_all');
    });

// route document controlleur
    Route::controller(DocumentController::class)->group(function () {
        Route::post('delete/document/{id}', 'delete');

        Route::get('document/corbeille', 'corbeille')->name('corbeille.document');

        Route::post('restore/document/{id}', 'restore');

        Route::post('restore/all/document', 'restore_all');
    });
});

// si user is Super user
Route::middleware(['auth', 'IsSuperuser'])->group(function () {
    // route des dashboard
    Route::controller(RouteController::class)->group(function () {

        Route::get('compte', 'compte')->name('Compte');

        Route::get('annotation', 'annotation')->name('Annotation');

        Route::get('diffusion', 'diffusion')->name('Diffusion');

        Route::get('poste', 'poste')->name('Poste');

    });

    // route imputation courrier
    Route::controller(TraitementController::class)->group(function () {
        Route::get('edit/traitement/{id}', 'show')->whereNumber('id')->name('edit.traitement');
        Route::post('update/traitement', 'save_traitement')->name('save.traitement');
    });

    // route diffusion controlleur
    Route::controller(DiffusionController::class)->group(function () {
        Route::get('edit/diffusion/{id}', 'edit')->whereNumber('id')->name('edit.diffusion');

        Route::post('update/diffusion', 'update')->name('update.diffusion');

        Route::post('delete/diffusion/{id}', 'delete');

    });

    // route user
    Route::controller(UserController::class)->group(function () {
        Route::get('compte/register', 'register')->name('register.user');

        Route::post('new/user', 'create')->name('new.user');

        Route::get('edit/user/{id}', 'edit')->whereNumber('id')->name('edit.user');

        Route::post('update/user', 'update')->name('update.user');
    });

    // route Annotation courrier
    Route::controller(AnnotationController::class)->group(function () {

        Route::post('new/annotation', 'create')->name('new.annotation');

        Route::get('edit/annotation/{id}', 'edit')->whereNumber('id')->name('edit.annotation');

        Route::post('update/annotation', 'update')->name('update.annotation');

        Route::post('delete/annotation/{id}', 'delete');

    });

    // route correspondant controlleur
    Route::controller(CorrespondantController::class)->group(function () {
        Route::post('delete/correspondant/{id}', 'delete');

        Route::get('correspondant/corbeille', 'corbeille')->name('corbeille.correspondant');

        Route::post('restore/correspondant/{id}', 'restore');

        Route::post('restore/all/correspondant', 'restore_all');
    });
});

// si user est Secretaire
Route::middleware(['auth', 'IsSecretaire'])->group(function () {
    // route des dashboard
    Route::controller(RouteController::class)->group(function () {

        Route::get('traitement', 'traitement')->name('Traitement');

        Route::get('imputation', 'imputation')->name('Imputation');
    });

// route document controlleur
    Route::controller(DocumentController::class)->group(function () {
        Route::get('edit/document/{id}', 'edit')->whereNumber('id')->name('edit.document');

        Route::get('file_view/document/{id}', 'file_view')->whereNumber('id')->name('show.document');

        Route::post('update/document', 'update')->name('update.document');
    });

    // route imputation courrier
    Route::controller(ImputationController::class)->group(function () {
        Route::post('new/imputation', 'create')->name('new.imputation');

        Route::get('show/imputation/{id}', 'show')->whereNumber('id')->name('show.imputation');

        Route::get('pdf/imputation/{id}', 'fiche')->whereNumber('id')->name('pdf.imputation');

        Route::get('edit/imputation/{imputation}', 'edit')->whereNumber('id')->name('edit.imputation');

        Route::post('update/imputation', 'update')->name('update.imputation');
    });

});

Route::middleware(['auth', 'IsAgent'])->group(function () {
    // route des dashboard
    Route::controller(RouteController::class)->group(function () {

        Route::get('/', 'dashboard')->name('dashboard');

        Route::get('courrier/arriver', 'arriver')->name('Arriver');

        Route::get('courrier/depart', 'depart')->name('Depart');

        Route::get('courrier/interne', 'interne')->name('Interne');

        Route::get('nature', 'nature')->name('Nature');

        Route::get('correspondant', 'correspondant')->name('Correspondant');

        Route::get('archive/courrier', 'archive')->name('Archive');

        Route::get('document', 'document')->name('document');

        Route::get('agenda', 'agenda')->name('Agenda');

    });

    // route courrier controlleur
    Route::controller(CourrierController::class)->group(function () {
        Route::post('new/courrier', 'create')->name('new.courrier');

        Route::get('edit/courrier/{id}', 'edit')->whereNumber('id')->name('edit.courrier');

        Route::get('show/courrier/{id}', 'show')->whereNumber('id')->name('show.courrier');

        Route::get('fiche/courrier/{id}', 'fiche')->whereNumber('id')->name('fiche.courrier');

        Route::post('update/courrier', 'update')->name('update.courrier');

    });

    // route utilisateur controlleur
    Route::controller(UserController::class)->group(function () {

        Route::get('show/user/{id}', 'show')->whereNumber('id')->name('show.user');
    });
    // route nature courrier controlleur
    Route::controller(NatureController::class)->group(function () {
        Route::post('new/nature', 'create')->name('new.nature');

        Route::get('edit/nature/{id}', 'edit')->whereNumber('id')->name('edit.nature');

        Route::post('update/nature', 'update')->name('update.nature');
    });

// route correspondant controlleur
    Route::controller(CorrespondantController::class)->group(function () {
        Route::post('new/correspondant', 'create')->name('new.correspondant');

        Route::get('edit/correspondant/{id}', 'edit')->whereNumber('id')->name('edit.correspondant');

        Route::post('update/correspondant', 'update')->name('update.correspondant');
    });

    // route agenda controlleur
    Route::controller(AgendaController::class)->group(function () {
        Route::post('new/agenda', 'create')->name('new.agenda');

        Route::get('edit/document/{id}', 'edit')->whereNumber('id')->name('edit.agenda');

        Route::post('update/agenda', 'update')->name('update.agenda');

        Route::post('delete/agenda/{id}', 'delete');

        Route::get('agenda/corbeille', 'corbeille')->name('corbeille.agenda');

        Route::post('restore/agenda/{id}', 'restore');

        Route::post('restore/all/agenda', 'restore_all');
    });
});

require __DIR__ . '/auth.php';
