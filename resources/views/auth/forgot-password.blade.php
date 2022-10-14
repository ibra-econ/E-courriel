<x-guest-layout>
    <div class="fxt-inner-wrap fxt-opacity fxt-transition-delay-13">
    <h2 class="fxt-page-title">Reinitialisation de mot de passe</h2>
    <p class="fxt-description">
        <div class="mb-4 text-sm text-gray-600">
            {{ __("Indiquez-nous simplement votre adresse e-mail et nous vous enverrons par e-mail un lien de réinitialisation de mot de passe qui vous permettra d'en choisir un nouveau.") }}
        </div>
         <!-- Session Status -->
<x-auth-session-status class="mb-4" :status="session('status')" />

<!-- Validation Errors -->
<x-auth-validation-errors class="mb-4" :errors="$errors" />
    </p>

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="form-group">
                <label for="email" class="fxt-label">Email</label>
                <input type="email" id="email" class="form-control" name="email" :value="old('email')" placeholder="Entrer votre email" required autofocus>
            </div>
            <div class="form-group mb-3">
                <button type="submit" class="fxt-btn-fill">Valider</button>
            </div>
        </form>
    </div>
</x-guest-layout>
