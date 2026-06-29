@extends('Admin.layouts.app')

@section('content')

<div class="mb-6 flex items-center justify-between">

    <div>

        <h2 class="text-2xl font-bold">
            Reset Password User
        </h2>

        <p class="text-gray-500 mt-1">
            Buat password baru untuk pengguna
        </p>

    </div>

    <a href="{{ route('admin.kelola-user.index') }}"
        class="px-4 py-2 rounded-xl border border-gray-300 hover:bg-gray-50">

        Kembali

    </a>

</div>

<div class="max-w-2xl">

    <div class="bg-white rounded-2xl shadow overflow-hidden">

        <div class="px-6 py-4 border-b">

            <h3 class="font-semibold text-lg">
                Informasi User
            </h3>

        </div>

        <div class="p-6 border-b bg-gray-50">

            <div class="space-y-2">

                <div>
                    <span class="text-sm text-gray-500">
                        Nama
                    </span>

                    <div class="font-semibold">
                        {{ $user->name }}
                    </div>
                </div>

                <div>
                    <span class="text-sm text-gray-500">
                        Email
                    </span>

                    <div class="font-semibold">
                        {{ $user->email }}
                    </div>
                </div>

            </div>

        </div>

        <form
            action="{{ route('admin.kelola-user.reset-password.update', $user->id) }}"
            method="POST">

            @csrf
            @method('PUT')

            <div class="p-6 space-y-6">

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Password Baru
                    </label>

                    <input
                        type="password"
                        name="password"
                        class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary">

                    @error('password')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Konfirmasi Password Baru
                    </label>

                    <input
                        type="password"
                        name="password_confirmation"
                        class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary">

                </div>

                <div class="rounded-xl bg-yellow-50 border border-yellow-200 p-4">

                    <div class="flex items-start gap-3">

                        <span class="material-symbols-outlined text-yellow-600">
                            warning
                        </span>

                        <div>

                            <p class="font-medium text-yellow-800">
                                Perhatian
                            </p>

                            <p class="text-sm text-yellow-700 mt-1">
                                Password lama pengguna akan diganti dengan password baru yang Anda masukkan.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <div class="px-6 py-4 border-t bg-gray-50 flex justify-end gap-3">

                <a href="{{ route('admin.kelola-user.index') }}"
                    class="px-5 py-2 rounded-xl border border-gray-300 hover:bg-gray-100">

                    Batal

                </a>

                <button
                    type="submit"
                    class="px-5 py-2 rounded-xl bg-primary text-white hover:opacity-90">

                    Simpan Password Baru

                </button>

            </div>

        </form>

    </div>

</div>

@endsection