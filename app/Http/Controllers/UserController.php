<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\Poste;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Route profile function
    public function profile($id)
    {
        $rows = User::find($id);
        return view('user.profile', compact(["rows"]));
    }

    public function show(int $id)
    {
        $user = User::with('departement','journals','poste')->withCount('courriers','imputations')->find($id);
        // dd($user);
        return view('user.show', compact(['user']));
    }

    public function edit(int $id)
    {
        $user = User::with('poste')->find($id);
        $departement = Departement::all();
        $poste = Poste::all();
        return view('user.update', compact(['user','departement','poste']));
    }

    public function update(Request $request)
    {
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->role = $request->role;
        $user->email = $request->email;
        $user->departement_id = $request->departement;
        $user->save();
        $poste = Poste::where('id',$request->poste)->update(['user_id'=>$request->id]);

        // dd($poste);
        return back()->with('update', 'utilisateur mise à jour avec success');
    }

    // corbeille dashboard
    public function corbeille()
    {
        $rows = User::onlyTrashed()->get();
        return view('user.corbeille', compact(['rows']));
    }

    // restaurer tous un element
    public function restore(int $id)
    {
        $delete = User::where('id', $id)->restore();
        // check data restore or not
        if ($delete == 1) {
            $success = true;
            $message = "Utilisateur restaurer avec success";
        } else {
            $success = true;
            $message = "Utilisateur non trouver";
        }

        //  return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

    // restaurer tous les elements
    public function restore_all()
    {
        $delete = User::withTrashed()->restore();
        // check data restore or not
        if ($delete == 1) {
            $success = true;
            $message = "Tout les utilisateurs ont été restaurés avec success";
        } else {
            $success = true;
            $message = "La corbeille a été vider";
        }

        //  return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

    public function delete($id)
    {
        // si oui supprimer de la BD
        $delete = User::destroy($id);
        // check data deleted or not
        if ($delete == 1) {
            $success = true;
            $message = "utilisateur supprimer avec success";
        } else {
            $success = true;
            $message = "utilisateur not found";
        }

        //  return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
}
