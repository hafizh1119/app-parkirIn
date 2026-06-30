@extends('layouts.app')

@push('styles')
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.bg-white,
.bg-body,
.card,
.card-body,
.card-header,
.card-footer,
div[class*="bg-"],
section[class*="bg-"],
main[class*="bg-"] {
    background-color: transparent !important;
    background: transparent !important;
}

.authentication-wrapper {
    min-height: 100vh;
    background: linear-gradient(145deg, #08081a 0%, #10102a 40%, #18183a 100%) !important;
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 70px 20px 20px 20px;
}

.authentication-wrapper::before {
    content: '';
    position: absolute;
    inset: 0;
    background-image: 
        radial-gradient(2px 2px at 10% 20%, rgba(255,255,255,0.3), transparent),
        radial-gradient(2px 2px at 30% 60%, rgba(255,255,255,0.2), transparent),
        radial-gradient(2px 2px at 50% 10%, rgba(255,255,255,0.3), transparent),
        radial-gradient(2px 2px at 70% 50%, rgba(255,255,255,0.2), transparent),
        radial-gradient(2px 2px at 90% 30%, rgba(255,255,255,0.3), transparent),
        radial-gradient(2px 2px at 20% 80%, rgba(255,255,255,0.2), transparent),
        radial-gradient(2px 2px at 60% 90%, rgba(255,255,255,0.3), transparent),
        radial-gradient(2px 2px at 80% 70%, rgba(255,255,255,0.2), transparent);
    animation: twinkle 6s ease-in-out infinite alternate;
}

@keyframes twinkle {
    0% { opacity: 0.3; }
    100% { opacity: 1; }
}

.authentication-wrapper::after {
    content: '';
    position: absolute;
    width: 600px;
    height: 600px;
    background: radial-gradient(circle, rgba(115, 103, 240, 0.12), transparent 70%);
    border-radius: 50%;
    top: -200px;
    right: -200px;
    animation: orb1 15s ease-in-out infinite alternate;
}

@keyframes orb1 {
    0% { transform: translate(0, 0) scale(1); }
    100% { transform: translate(-50px, 80px) scale(1.5); }
}

.orb-2 {
    position: absolute;
    width: 500px;
    height: 500px;
    background: radial-gradient(circle, rgba(167, 139, 250, 0.1), transparent 70%);
    border-radius: 50%;
    bottom: -150px;
    left: -150px;
    animation: orb2 18s ease-in-out infinite alternate-reverse;
}

@keyframes orb2 {
    0% { transform: translate(0, 0) scale(1); }
    100% { transform: translate(60px, -60px) scale(1.4); }
}

.authentication-inner {
    width: 100%;
    max-width: 1300px;
    margin: 0 auto;
    position: relative;
    z-index: 2;
}

.login-left {
    padding: 40px !important;
    background: transparent !important;
}

.login-brand {
    max-width: 520px;
    margin-top: 20px;
    background: transparent !important;
}

.login-brand .badge-top {
    display: inline-block;
    background: rgba(115, 103, 240, 0.12);
    color: #a78bfa;
    border: 1px solid rgba(115, 103, 240, 0.1);
    padding: 6px 22px;
    border-radius: 50px;
    font-weight: 600;
    font-size: 0.65rem;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    margin-bottom: 16px;
}

.login-brand h1 {
    font-weight: 800;
    font-size: 3.2rem;
    line-height: 1.1;
    margin-bottom: 14px;
    background: linear-gradient(135deg, #ffffff 0%, #a78bfa 50%, #8b5cf6 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.login-brand p {
    color: #a0a0c0;
    font-size: 1.05rem;
    line-height: 1.7;
}

.authentication-bg {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px !important;
    background: transparent !important;
}

.login-card {
    background: #ffffff !important;
    backdrop-filter: none !important;
    -webkit-backdrop-filter: none !important;
    border: none !important;
    border-radius: 24px !important;
    padding: 28px 32px 24px !important;
    box-shadow: 0 40px 100px rgba(0, 0, 0, 0.5) !important;
    width: 100% !important;
    max-width: 520px !important;
    position: relative !important;
    overflow: hidden !important;
    transition: all 0.3s ease !important;
    margin-top: 10px !important;
    margin-left: 100px !important;
}

.login-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 50px 120px rgba(0, 0, 0, 0.6);
}

.login-card * {
    position: relative;
    z-index: 1;
}

.welcome-badge {
    display: inline-block;
    background: #eef2ff;
    color: #4f46e5;
    padding: 3px 16px;
    border-radius: 50px;
    font-size: 0.6rem;
    font-weight: 600;
    letter-spacing: 0.8px;
    text-transform: uppercase;
    margin-bottom: 8px;
    border: 1px solid rgba(79, 70, 229, 0.1);
}

.login-card h4 {
    color: #1a1a2e !important;
    font-weight: 700 !important;
    font-size: 1.2rem !important;
    margin-bottom: 2px !important;
}

.login-card .sub-text {
    color: #6b7280 !important;
    font-size: 0.75rem !important;
    margin-bottom: 14px !important;
}

.form-group {
    margin-bottom: 10px;
}

.form-group label {
    display: block;
    color: #4b5563;
    font-size: 0.7rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 4px;
}

.form-group .form-control,
.form-group .form-select {
    width: 100%;
    background: #f8fafc !important;
    border: 1.5px solid #e2e8f0 !important;
    border-radius: 10px !important;
    padding: 10px 14px !important;
    height: 42px !important;
    color: #1a1a2e !important;
    font-size: 0.85rem !important;
    transition: all 0.3s ease !important;
    outline: none !important;
}

.form-group .form-control:focus,
.form-group .form-select:focus {
    border-color: #4f46e5 !important;
    box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1) !important;
    background: #ffffff !important;
}

.form-group .form-control::placeholder {
    color: #94a3b8;
    font-size: 0.8rem;
}

.form-group .is-invalid {
    border-color: #ef4444 !important;
}

.form-group .invalid-feedback {
    color: #ef4444;
    font-size: 0.7rem;
    margin-top: 3px;
}

.password-group {
    position: relative;
}

.password-group .form-control {
    padding-right: 44px !important;
}

.password-toggle {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: #94a3b8;
    cursor: pointer;
    padding: 4px;
    transition: color 0.3s ease;
}

.password-toggle:hover {
    color: #4f46e5;
}

.form-check {
    display: flex;
    align-items: center;
    gap: 8px;
}

.form-check-input {
    background: #f8fafc !important;
    border: 1.5px solid #cbd5e1 !important;
    width: 14px !important;
    height: 14px !important;
    cursor: pointer;
    border-radius: 4px !important;
    margin: 0 !important;
    flex-shrink: 0;
    appearance: none;
    -webkit-appearance: none;
}

.form-check-input:checked {
    background: #4f46e5 !important;
    border-color: #4f46e5 !important;
}

.form-check-input:checked::after {
    content: '✓';
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 9px;
    font-weight: bold;
}

.form-check-label {
    color: #4b5563 !important;
    font-size: 0.75rem !important;
    cursor: pointer;
}

.btn-login {
    background: linear-gradient(135deg, #4f46e5, #4338ca) !important;
    border: none !important;
    border-radius: 10px !important;
    padding: 10px !important;
    font-weight: 600 !important;
    font-size: 0.85rem !important;
    transition: all 0.3s ease !important;
    box-shadow: 0 4px 20px rgba(79, 70, 229, 0.3) !important;
    color: #fff !important;
    letter-spacing: 0.5px !important;
    height: 42px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 8px !important;
    width: 100% !important;
    cursor: pointer !important;
}

.btn-login:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 8px 35px rgba(79, 70, 229, 0.4) !important;
    background: linear-gradient(135deg, #6366f1, #4f46e5) !important;
}

.register-link {
    color: #6b7280 !important;
    font-size: 0.75rem !important;
    text-align: center !important;
    margin-top: 10px !important;
}

.register-link a {
    color: #4f46e5 !important;
    text-decoration: none !important;
    font-weight: 500 !important;
    transition: color 0.3s ease !important;
}

.register-link a:hover {
    color: #6366f1 !important;
    text-decoration: underline !important;
}

hr {
    margin: 12px 0 !important;
    border-color: #e2e8f0 !important;
}

.label-section {
    color: #4b5563;
    font-size: 0.7rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 8px;
}

.row-2col {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
}

/* FORM 2 KOLOM UNTUK BAGIAN ATAS */
.form-row-2 {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
}

@media (max-width: 768px) {
    .form-row-2 {
        grid-template-columns: 1fr;
    }
    .row-2col {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 992px) {
    .login-brand h1 {
        font-size: 2.4rem;
    }
    
    .login-brand {
        max-width: 100%;
        text-align: center;
    }
    
    .login-left {
        padding: 30px 20px !important;
    }
}

@media (max-width: 576px) {
    .authentication-wrapper {
        padding: 70px 10px 10px 10px;
    }
    
    .login-card {
        padding: 20px 16px 16px !important;
        border-radius: 20px !important;
        max-width: 100% !important;
    }
    
    .login-brand h1 {
        font-size: 1.8rem;
    }
    
    .login-brand p {
        font-size: 0.9rem;
    }
}
</style>
@endpush

@section('content')
<div class="authentication-wrapper">
    <div class="orb-2"></div>
    
    <div class="authentication-inner row m-0 align-items-center">
        <div class="d-none d-lg-flex col-lg-6 col-xl-6 login-left">
            <div class="login-brand">
                <span class="badge-top">✦ Smart Parking Platform</span>
                <h1>Bergabung dengan ParkirIn</h1>
                <p>
                    Buat akun sekarang dan nikmati kemudahan mencari serta<br>
                    memesan slot parkir secara realtime.
                </p>
                @include('partials.parking-illustration')
            </div>
        </div>

        <div class="d-flex col-12 col-lg-6 col-xl-6 authentication-bg">
            <div class="login-card">
                <div class="welcome-badge"> Daftar Sekarang</div>
                <h4>Buat Akun ParkirIn</h4>
                <p class="sub-text">Daftar untuk menikmati fitur pencarian, reservasi, dan monitoring parkir.</p>

                <form action="{{ route('register') }}" method="POST">
                    @csrf

                    
                    <div class="form-row-2">
                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <input
                                type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="Nama lengkap"
                                autofocus
                                required />
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input
                                type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="nama@email.com"
                                required />
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    
                    <div class="form-row-2">
                        <div class="form-group">
                            <label for="nomor_hp">Nomor HP</label>
                            <input
                                type="text"
                                class="form-control @error('nomor_hp') is-invalid @enderror"
                                id="nomor_hp"
                                name="nomor_hp"
                                value="{{ old('nomor_hp') }}"
                                placeholder="08xxxxxxxxxx"
                                required />
                            @error('nomor_hp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group password-group">
                            <label for="password">Password</label>
                            <input
                                type="password"
                                id="password"
                                class="form-control @error('password') is-invalid @enderror"
                                name="password"
                                placeholder="Minimal 8 karakter"
                                autocomplete="new-password"
                                required />
                            <button type="button" class="password-toggle" onclick="togglePassword()">
                                <i class="mdi mdi-eye-off-outline"></i>
                            </button>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <hr>

                    <div class="label-section">Data Kendaraan</div>

                    
                    <div class="form-group">
                        <label for="jenis_kendaraan">Jenis Kendaraan</label>
                        <select class="form-select @error('jenis_kendaraan') is-invalid @enderror" id="jenis_kendaraan" name="jenis_kendaraan" required>
                            <option value="">Pilih jenis kendaraan</option>
                            <option value="motor" {{ old('jenis_kendaraan') == 'motor' ? 'selected' : '' }}>Motor</option>
                            <option value="mobil" {{ old('jenis_kendaraan') == 'mobil' ? 'selected' : '' }}>Mobil</option>
                        </select>
                        @error('jenis_kendaraan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    
                    <div class="row-2col">
                        <div class="form-group">
                            <label for="nomor_polisi">Nomor Polisi</label>
                            <input
                                type="text"
                                class="form-control @error('nomor_polisi') is-invalid @enderror"
                                id="nomor_polisi"
                                name="nomor_polisi"
                                value="{{ old('nomor_polisi') }}"
                                placeholder="B 1234 ABC"
                                required />
                            @error('nomor_polisi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="merk">Merk</label>
                            <input
                                type="text"
                                class="form-control @error('merk') is-invalid @enderror"
                                id="merk"
                                name="merk"
                                value="{{ old('merk') }}"
                                placeholder="Toyota / Honda"
                                required />
                            @error('merk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- WARNA -->
                    <div class="form-group">
                        <label for="warna">Warna</label>
                        <input
                            type="text"
                            class="form-control @error('warna') is-invalid @enderror"
                            id="warna"
                            name="warna"
                            value="{{ old('warna') }}"
                            placeholder="Hitam / Putih / Merah"
                            required />
                        @error('warna')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" required />
                            <label class="form-check-label" for="terms-conditions">
                                Saya setuju dengan <a href="#" style="color:#4f46e5;">syarat & ketentuan</a>
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="btn-login">
                        <i class="mdi mdi-account-plus"></i> DAFTAR
                    </button>
                </form>

                <p class="register-link">
                    Sudah punya akun? <a href="{{ route('login') }}">Masuk sekarang</a>
                </p>
            </div>
        </div>
    </div>
</div>

<script>
function togglePassword() {
    const input = document.getElementById('password');
    const icon = document.querySelector('.password-toggle i');
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.className = 'mdi mdi-eye-outline';
    } else {
        input.type = 'password';
        icon.className = 'mdi mdi-eye-off-outline';
    }
}
</script>
@endsection