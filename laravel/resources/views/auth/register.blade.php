@include('partials.header')

    <div class="auth-wrapper">


        <!-- Right panel — form -->
        <main class="auth-main">
            <div class="auth-card">

                <div class="auth-header">
                    <h2 class="auth-title">Créer un compte</h2>
                    <p class="auth-subtitle">Rejoignez EasyColoc gratuitement</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="auth-form">
                    @csrf

                    <!-- Name -->
                    <div class="form-group">
                        <label for="name" class="form-label">Nom complet</label>
                        <div class="input-wrapper">
                            <svg class="input-icon" viewBox="0 0 20 20" fill="none">
                                <circle cx="10" cy="7" r="3.5" stroke="currentColor" stroke-width="1.4"/>
                                <path d="M2.5 17c0-3.314 3.358-6 7.5-6s7.5 2.686 7.5 6" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
                            </svg>
                            <input
                                id="name"
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                class="form-input @error('name') is-invalid @enderror"
                                placeholder="Jean Dupont"
                                required
                                autofocus
                                autocomplete="name"
                            >
                        </div>
                        @error('name')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

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
                                autocomplete="username"
                            >
                        </div>
                        @error('email')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="password" class="form-label">Mot de passe</label>
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
                                placeholder="8 caractères minimum"
                                required
                                autocomplete="new-password"
                            >
                            <button type="button" class="toggle-password" onclick="togglePassword('password', this)" aria-label="Afficher">
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

                    <!-- Confirm Password -->
                    <!-- <div class="form-group">
                        <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                        <div class="input-wrapper">
                            <svg class="input-icon" viewBox="0 0 20 20" fill="none">
                                <rect x="3" y="9" width="14" height="9" rx="2" stroke="currentColor" stroke-width="1.4"/>
                                <path d="M6.5 9V6.5a3.5 3.5 0 017 0V9" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
                                <path d="M7.5 13.5l2 2 3-3" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <input
                                id="password_confirmation"
                                type="password"
                                name="password_confirmation"
                                class="form-input @error('password_confirmation') is-invalid @enderror"
                                placeholder="••••••••"
                                required
                                autocomplete="new-password"
                            >
                            <button type="button" class="toggle-password" onclick="togglePassword('password_confirmation', this)" aria-label="Afficher">
                                <svg viewBox="0 0 20 20" fill="none" class="eye-icon">
                                    <path d="M2 10s3-6 8-6 8 6 8 6-3 6-8 6-8-6-8-6z" stroke="currentColor" stroke-width="1.4"/>
                                    <circle cx="10" cy="10" r="2.5" stroke="currentColor" stroke-width="1.4"/>
                                </svg>
                            </button>
                        </div>
                        @error('password_confirmation')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div> -->

                    <!-- Submit -->
                    <button type="submit" class="btn-primary">
                        Créer mon compte
                        <svg viewBox="0 0 20 20" fill="none" class="btn-arrow">
                            <path d="M4 10h12M12 6l4 4-4 4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>

                </form>

                <div class="auth-footer">
                    <p>Déjà un compte ? <a href="{{ route('login_form') }}" class="auth-link">Se connecter</a></p>
                </div>

            </div>
        </main>

    </div>
@include('partials.footer')