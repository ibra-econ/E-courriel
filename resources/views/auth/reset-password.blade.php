<x-guest-layout>

    <div class="fxt-inner-wrap fxt-opacity fxt-transition-delay-13">
        <h2 class="fxt-page-title">Reinitialisation de mot de passe</h2>
        <p class="fxt-description">
    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
        </p>

           <form method="POST" action="{{ route('password.update') }}">
               @csrf

               <!-- Password Reset Token -->
               <input type="hidden" name="token" value="{{ $request->route('token') }}">

               <!-- Email Address -->
               <div class="form-group">
                <label for="email" class="fxt-label">Email</label>
                <input type="email" class="form-control" name="email" value="{{ $request->email }}" required autofocus>
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" name="password" required class="form-control" id="password"
                    autocomplete="new-password">


            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation" required class="form-control"
                    id="password_confirmation">

            </div>

            <div class="form-group mb-3">
                <button type="submit" class="fxt-btn-fill">Valider</button>
            </div>
           </form>
        </div>
</x-guest-layout>
