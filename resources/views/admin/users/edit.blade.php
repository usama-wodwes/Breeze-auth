@extends('layouts.app')

@section('content')
    <x-card class="p-10 rounded-lg shadow-lg">
        <header class="mb-6">
            <h1 class="text-3xl text-center font-bold uppercase text-gray-800">
                Edit User
            </h1>
        </header>

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div>
                <label class="block font-semibold text-gray-700">Name:</label>
                <input type="text" name="name" value="{{ $user->name }}" required
                    class="w-full border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-400">
            </div>

            <!-- Email -->
            <div>
                <label class="block font-semibold text-gray-700">Email:</label>
                <input type="email" name="email" value="{{ $user->email }}" required
                    class="w-full border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-400">
            </div>

            <!-- Role -->
            <div>
                <label class="block font-semibold text-gray-700">Role:</label>
                <select name="role"
                    class="w-full border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-400">
                    <option value="user" {{ $user->hasRole('user') ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ $user->hasRole('admin') ? 'selected' : '' }}>Admin</option>
                </select>

            </div>

            <!-- Buttons -->
            <div class="flex justify-between mt-6">
                <a href="{{ route('admin.users.index') }}"
                    class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">
                    <i class="fa-solid fa-arrow-left"></i> Back
                </a>

                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition">
                    <i class="fa-solid fa-check"></i> Update User
                </button>
            </div>
        </form>
    </x-card>
@endsection
