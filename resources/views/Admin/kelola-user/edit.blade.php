@extends('Admin.layouts.app')

@section('content')

<div class="mb-6 flex items-center justify-between">

    <div>

        <h2 class="text-2xl font-bold">
            Edit User
        </h2>

        <p class="text-gray-500 mt-1">
            Ubah informasi pengguna
        </p>

    </div>

    <a href="{{ route('admin.kelola-user.index') }}"
        class="px-4 py-2 rounded-xl border border-gray-300 hover:bg-gray-50">

        Kembali

    </a>

</div>

<div class="bg-white rounded-2xl shadow overflow-hidden">

    <div class="px-6 py-4 border-b">

        <h3 class="font-semibold text-lg">
            Form Edit User
        </h3>

    </div>

    <form
        action="{{ route('admin.kelola-user.update', $user->id) }}"
        method="POST">

        @csrf
        @method('PUT')

        <div class="p-6 space-y-6">

            <div>

                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Nama Lengkap
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $user->name) }}"
                    class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary">

                @error('name')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            <div>

                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email', $user->email) }}"
                    class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary">

                @error('email')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            <div>

                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Nomor HP
                </label>

                <input
                    type="text"
                    name="nomor_hp"
                    value="{{ old('nomor_hp', $user->nomor_hp) }}"
                    class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary">

                @error('nomor_hp')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            <div>

                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Status Member
                </label>

                <select
                    name="status_member"
                    class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary">

                    <option
                        value="biasa"
                        {{ old('status_member', $user->status_member) == 'biasa' ? 'selected' : '' }}>

                        Biasa

                    </option>

                    <option
                        value="member"
                        {{ old('status_member', $user->status_member) == 'member' ? 'selected' : '' }}>

                        Member

                    </option>

                </select>

                @error('status_member')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror

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

                Simpan Perubahan

            </button>

        </div>

    </form>

</div>

@endsection