<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\User;
use Illuminate\Http\Request;

class DepartementController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'nom' => ['required'],
            'user' => ['required'],
            'imputation' => ['required'],
        ]);
        $departement = new Departement();
        $departement->nom = $request->nom;
        $departement->user_id = $request->user;
        $departement->imputation = $request->imputation;
        $departement->save();
        return back()->with('insert', 'departement ajouter avec success');
    }

    public function edit($id)
    {
        $departement = Departement::find($id);
        $user = User::all();
        return view('update', compact(["departement",'user']));
    }
    public function update(Request $request)
    {
        $departement = Departement::find($request->id);
        $departement->nom = $request->nom;
        $departement->user_id = $request->user;
        $departement->imputation = $request->imputation;
        $departement->save();
        return back()->with('update', 'departement mise à jour avec success');
    }
    public function delete($id)
    {
        // si oui supprimer de la BD
        $delete = Departement::destroy($id);
        // check data deleted or not
        if ($delete == 1) {
            $success = true;
            $message = "departement supprimer avec success";
        } else {
            $success = true;
            $message = "departement not found";
        }

        //  return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
}
