<x-guest-layout>
    <div class="auth-title-section mb-3 text-center"> 
        <h4 class="text-dark fw-semibold mb-1">Daftar Akun Baru</h4>
        <p class="text-muted fs-14 mb-0">Buat akun KopiAsa gratis Anda.</p>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="mb-0 p-0 p-lg-3">
                <div class="mb-0 border-0 p-md-3 p-lg-0">
                    <div class="pt-0">
                        <form method="POST" action="{{ route('register') }}" class="mt-0 mb-4">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <input class="form-control" name="name" type="text" id="name" value="{{ old('name') }}" required autofocus placeholder="Masukkan nama lengkap Anda">
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="email" class="form-label">Alamat Email</label>
                                <input class="form-control" type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="Masukkan email Anda">
                                 <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input class="form-control" type="password" required id="password" name="password" placeholder="Masukkan password Anda">
                                 <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                            
                             <div class="form-group mb-3">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                <input class="form-control" type="password" required id="password_confirmation" name="password_confirmation" placeholder="Ulangi password Anda">
                                 <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>

                            <div class="form-group mb-0">
                                <div class="d-grid">
                                    <button class="btn btn-primary fw-semibold" type="submit"> Daftar </button>
                                </div>
                            </div>
                        </form>
        
                        <div class="text-center text-muted mb-0">
                            <p class="mb-0">Sudah punya akun? <a class="text-primary ms-2 fw-medium" href="{{ route('login') }}">Masuk di sini</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>