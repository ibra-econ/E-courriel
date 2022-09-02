<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Poste;
use App\Models\Departement;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
      /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function register()
    {
        if(Auth::user()->role === "admin"):
        $departement = Departement::all();
        endif;
        if(Auth::user()->role === "superuser"):
            $departement = Departement::where('id',Auth::user()->departement_id);
        endif;
        return view('user.create', compact(['departement']));
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create(Request $request)
    {
        // dd($request);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string'],
            'poste' => ['required'],
            'departement' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = New User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->poste = $request->poste;
        if(Auth::user()->role === "admin"):
        $user->departement_id = $request->departement;
        endif;
        $user->password = Hash::make($request->password);
        if (!empty($request->file('photo'))):
            // renome le document
            $filename = Str::random(10) . '.' . $request->photo->extension();
                $chemin = $request->file('photo')->storeAs('user/profile', $filename, 'public');
                $user->photo = $chemin;
            $user->photo = $chemin;
        endif;
        $user->save();
        return back()->with('insert', 'utilisateur ajouter avec success');
    }
    // Route profile function
    public function profile($id)
    {
        $rows = User::find($id);
        return view('user.profile', compact(["rows"]));
    }

    public function show(int $id)
    {
        $user = User::with('departement', 'journals')->withCount('courriers', 'imputations')->find($id);
        return view('user.show', compact(['user']));
    }

    public function edit(int $id)
    {
        $user = User::find($id);
        $departement = Departement::all();
        return view('user.update', compact(['user', 'departement']));
    }

    public function update(Request $request)
    {
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->poste = $request->poste;
        // si user is admin
        if (Auth::user()->role === "admin"):
            $user->role = $request->role;
            $user->departement_id = $request->departement;
        endif;
        $user->save();

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
