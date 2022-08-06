<?php

namespace App\Http\Controllers;

use App\Models\Nature;
use Illuminate\Http\Request;

class NatureController extends Controller
{
    public function create(Request $request)
    {

        $request->validate([
            'nom' => ['required'],
        ]);

        $nature = new Nature();
        $nature->nom = $request->nom;
        $nature->save();
        return back()->with('insert', 'nature ajouter avec success');
    }

    public function edit(int $id)
    {
        $nature = Nature::find($id);
        return view('nature_update', compact(["nature"]));
    }
    public function update(Request $request)
    {
        $nature = nature::find($request->id);
        $nature->nom = $request->nom;
        $nature->save();
        return back()->with('update', 'nature mise à jour avec success');
    }
    public function delete(int $id)
    {
        // si oui supprimer de la BD
        $delete = Nature::destroy($id);
        // check data deleted or not
        if ($delete == 1) {
            $success = true;
            $message = "nature supprimer avec success";
        } else {
            $success = true;
            $message = "nature not found";
        }

        //  return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
}
