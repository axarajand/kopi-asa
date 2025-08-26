<x-guest-layout>
    <div class="auth-title-section mb-3 text-center"> 
        <h3 class="text-dark fw-medium mb-1">Selamat Datang</h3>
        <p class="text-muted fs-14 mb-0">Silakan masuk untuk melanjutkan</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="card mb-0">
        <div class="card-body">
            <div class="mb-0 p-0 p-lg-3">
                <div class="mb-0 border-0 p-md-3 p-lg-0">
                    <div class="pt-0">
                        <form method="POST" action="{{ route('login') }}" class="mt-0 mb-4">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="email" class="form-label">Alamat Email</label>
                                <input class="form-control" type="email" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Masukkan email Anda">
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input class="form-control" type="password" required id="password" name="password" placeholder="Masukkan password Anda">
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                            
                            <div class="form-group d-flex mb-3">
                                <div class="col-sm-6">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                                        <label class="form-check-label" for="remember_me">Ingat saya</label>
                                    </div>
                                </div>
                                @if (Route::has('password.request'))
                                <div class="col-sm-6 text-end">
                                    <a class="text-muted fs-14" href="{{ route('password.request') }}">Lupa password?</a>
                                </div>
                                @endif
                            </div>
                            
                            <div class="form-group mb-0">
                                <div class="d-grid">
                                    <button class="btn btn-primary fw-semibold" type="submit"> Masuk </button>
                                </div>
                            </div>
                        </form>
                        
                        <div class="text-center text-muted">
                            <p class="mb-0">Belum punya akun? <a class="text-primary ms-2 fw-medium" href="{{ route('register') }}">Buat akun</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>