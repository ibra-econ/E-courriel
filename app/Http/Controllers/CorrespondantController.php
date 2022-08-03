<?php

namespace App\Http\Controllers;

use App\Models\Correspondant;
use Illuminate\Http\Request;

class CorrespondantController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'nom' => ['required'],
            'prenom' => ['required'],
            'phone' => ['required'],
            'fonction' => ['required', 'string'],
        ]);
        $correspondant = new Correspondant;
        $correspondant->nom = $request->nom;
        $correspondant->prenom = $request->prenom;
        $correspondant->email = $request->email;
        $correspondant->phone = $request->phone;
        $correspondant->fonction = $request->fonction;
        $correspondant->save();
        return back()->with('insert', 'Correspondant mise à jour avec success');
    }

    public function edit(int $id){
        $row = Correspondant::find($id);
        return view('correspondant_update', compact(['row']));
    }

    public function update(Request $request)
    {
        $correspondant = Correspondant::find($request->id);
        $correspondant->nom = $request->nom;
        $correspondant->prenom = $request->prenom;
        $correspondant->email = $request->email;
        $correspondant->phone = $request->phone;
        $correspondant->fonction = $request->fonction;
        $correspondant->save();
        return back()->with('update', 'Correspondant mise à jour avec success');
    }

    public function delete($id)
    {
        $delete = Correspondant::destroy($id);
        // check data deleted or not
        if ($delete == 1) {
            $success = true;
            $message = "Correspondant supprimer avec success";
        } else {
            $success = true;
            $message = "Correspondant not found";
        }

        //  return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
}
