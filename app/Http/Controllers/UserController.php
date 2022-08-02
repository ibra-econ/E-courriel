<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Route profile function
    public function profile($id)
    {
        $rows = User::find($id);
        return view('profile', compact(["rows"]));
    }

    public function edit(int $id)
    {
        $user = User::find($id);
        return view('update', compact(['user']));
    }

    public function update(Request $request)
    {
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->role = $request->role;
        $user->poste = $request->poste;
        $user->save();
        return back()->with('update', 'utilisateur mise à jour avec success');
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
