<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Journal;
use Illuminate\Http\Request;
use Jenssegers\Agent\Facades\Agent;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        // journalisation
        $journal = New Journal();
        $journal->user_id = $request->user()->id;
        $journal->libelle = 'Connexion';
        $journal->save();

        $user = User::where('id',$request->user()->id)->update(['etat' => 1]);

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();
        $journal = New Journal();
        $journal->user_id = $request->id;
        $journal->libelle = 'Deconnexion';
        $journal->save();

        $user = User::where('id',$request->id)->update(['etat' => '0']);
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
