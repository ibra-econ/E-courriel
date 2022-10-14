<x-guest-layout>

    <div class="fxt-inner-wrap fxt-opacity fxt-transition-delay-13">
        <div class="text-center">
            <img src="{{ asset('assets/images/logo_icon.png') }}" height="100" width="100"  alt="Logo">
        </div>
        <h2 class="fxt-page-title">Connexion</h2>
        <p class="fxt-description">
             <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
        </p>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="email" class="fxt-label">Email</label>
                <input type="text" class="form-control" name="email"
                placeholder="Email ou numero de telephone" :value="old('email')" required autofocus>
            </div>

            <div class="form-group">
                <label for="password" class="fxt-label">Mot de passe</label>
                <input type="password" class="form-control" name="password" placeholder="Entrer votre mot de passe"
                id="password"  required autocomplete="current-password">
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-check form-check-inline">
                        <input id="remember_me" name="remember" class="form-check-input"
                            type="checkbox">
                        <label class="form-check-label text-dark" for="Check">Se souvenir de moi?
                        </label>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="form-group">
                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"> Mot de passe oublié?</a>
                    @endif
                    </div>
                </div>
            </div>

            <div class="form-group mb-3">
                <button type="submit" class="fxt-btn-fill">Connexion</button>
            </div>
        </form>
    </div>
</x-guest-layout>
