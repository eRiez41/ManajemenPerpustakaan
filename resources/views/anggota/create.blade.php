<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Anggota Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 dark:bg-red-900 border border-red-200 dark:border-red-700 text-red-700 dark:text-red-200 rounded-md">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('anggota.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            {{-- Nama Lengkap --}}
                            <div>
                                <label for="nama_lengkap" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Nama Lengkap</label>
                                <input id="nama_lengkap" name="nama_lengkap" type="text" value="{{ old('nama_lengkap') }}" class="block w-full mt-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required autofocus>
                            </div>

                            {{-- Nomor Identitas (NIM/NIDN) --}}
                            <div>
                                <label for="nomor_identitas" class="block font-medium text-sm text-gray-700 dark:text-gray-300">NIM / NIDN</label>
                                <input id="nomor_identitas" name="nomor_identitas" type="text" value="{{ old('nomor_identitas') }}" class="block w-full mt-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                            </div>

                            {{-- Tipe Anggota (Dropdown) --}}
                            <div>
                                <label for="tipe_anggota" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Tipe Anggota</label>
                                <select id="tipe_anggota" name="tipe_anggota" class="block w-full mt-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                    <option value="">Pilih Tipe</option>
                                    <option value="Mahasiswa" {{ old('tipe_anggota') == 'Mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                                    <option value="Dosen" {{ old('tipe_anggota') == 'Dosen' ? 'selected' : '' }}>Dosen</option>
                                    <option value="Staff" {{ old('tipe_anggota') == 'Staff' ? 'selected' : '' }}>Staff</option>
                                </select>
                            </div>

                            {{-- Status Keanggotaan (Dropdown) --}}
                            <div>
                                <label for="status_keanggotaan" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Status Keanggotaan</label>
                                <select id="status_keanggotaan" name="status_keanggotaan" class="block w-full mt-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                    <option value="Aktif" {{ old('status_keanggotaan', 'Aktif') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="Nonaktif" {{ old('status_keanggotaan') == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                </select>
                            </div>
                            
                            {{-- Email (Opsional) --}}
                            <div>
                                <label for="email" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Email (Opsional)</label>
                                <input id="email" name="email" type="email" value="{{ old('email') }}" class="block w-full mt-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            </div>

                            {{-- Nomor Telepon (Opsional) --}}
                            <div>
                                <label for="nomor_telepon" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Nomor Telepon (Opsional)</label>
                                <input id="nomor_telepon" name="nomor_telepon" type="text" value="{{ old('nomor_telepon') }}" class="block w-full mt-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            </div>

                            {{-- Alamat (Opsional) --}}
                            <div class="md:col-span-2">
                                <label for="alamat" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Alamat (Opsional)</label>
                                <textarea id="alamat" name="alamat" rows="3" class="block w-full mt-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('alamat') }}</textarea>
                            </div>
                        </div>

                        {{-- TOMBOL --}}
                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('anggota.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 mr-4">
                                Batal
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                Simpan
                            </button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>