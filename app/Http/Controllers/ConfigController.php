<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function edit(int $id)
    {
        $config = Config::find($id);
        return view('config_update', compact(["config"]));
    }
    public function update(Request $request)
    {
        $config = Config::find($request->id);
        $config->nom = $request->nom;
        $config->email = $request->email;
        $config->contact = $request->contact;
        $config->description = $request->description;
        if (!empty($request->file('logo'))):
        // renome le document
        $filename = time() . '.' . $request->logo->extension();
        $chemin = $request->file('logo')->storeAs('config', $filename, 'public');
        $config->logo = $chemin;
        endif;
        $config->save();
        return back()->with('update', 'configuration mise à jour avec success');
    }
}
