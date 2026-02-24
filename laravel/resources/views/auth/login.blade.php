@include('partials.header')
        <!-- Left panel — branding -->
        

        <!-- Right panel — form -->
        <main class="auth-main">
            <div class="auth-card">

                <div class="auth-header">
                    <h2 class="auth-title">Bon retour 👋</h2>
                    <p class="auth-subtitle">Connectez-vous à votre colocation</p>
                </div>

                {{-- Session status --}}
                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="auth-form">
                    @csrf

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email" class="form-label">Adresse e-mail</label>
                        <div class="input-wrapper">
                            <svg class="input-icon" viewBox="0 0 20 20" fill="none">
                                <path d="M2.5 5.5A1.5 1.5 0 014 4h12a1.5 1.5 0 011.5 1.5v9A1.5 1.5 0 0116 16H4a1.5 1.5 0 01-1.5-1.5v-9z" stroke="currentColor" stroke-width="1.4"/>
                                <path d="M2.5 6l7.116 4.823a.75.75 0 00.768 0L17.5 6" stroke="currentColor" stroke-width="1.4"/>
                            </svg>
                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                class="form-input @error('email') is-invalid @enderror"
                                placeholder="vous@exemple.com"
                                required
                                autofocus
                                autocomplete="username"
                            >
                        </div>
                        @error('email')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <div class="label-row">
                            <label for="password" class="form-label">Mot de passe</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="forgot-link">Oublié ?</a>
                            @endif
                        </div>
                        <div class="input-wrapper">
                            <svg class="input-icon" viewBox="0 0 20 20" fill="none">
                                <rect x="3" y="9" width="14" height="9" rx="2" stroke="currentColor" stroke-width="1.4"/>
                                <path d="M6.5 9V6.5a3.5 3.5 0 017 0V9" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
                                <circle cx="10" cy="13.5" r="1.25" fill="currentColor"/>
                            </svg>
                            <input
                                id="password"
                                type="password"
                                name="password"
                                class="form-input @error('password') is-invalid @enderror"
                                placeholder="••••••••"
                                required
                                autocomplete="current-password"
                            >
                            <button type="button" class="toggle-password" onclick="togglePassword('password', this)" aria-label="Afficher le mot de passe">
                                <svg viewBox="0 0 20 20" fill="none" class="eye-icon">
                                    <path d="M2 10s3-6 8-6 8 6 8 6-3 6-8 6-8-6-8-6z" stroke="currentColor" stroke-width="1.4"/>
                                    <circle cx="10" cy="10" r="2.5" stroke="currentColor" stroke-width="1.4"/>
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Remember me -->
                    <div class="form-check">
                        <input id="remember_me" type="checkbox" name="remember" class="check-input">
                        <label for="remember_me" class="check-label">Se souvenir de moi</label>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="btn-primary">
                        Se connecter
                        <svg viewBox="0 0 20 20" fill="none" class="btn-arrow">
                            <path d="M4 10h12M12 6l4 4-4 4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>

                </form>

                <div class="auth-footer">
                    <p>Pas encore de compte ? <a href="{{ route('register_form') }}" class="auth-link">Créer un compte</a></p>
                </div>

            </div>
        </main>

    </div>
@include('partials.footer')