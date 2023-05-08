<x-app-layout>
    <x-slot name="header">
    <div class="flex gap-20">
    <div>
        <h3 class="mt-3 mb-4 display-6">Manage Users:</h3>
        <a href="{{ route('users.index') }}" class="btn btn-primary">Go to User Management</a>
    </div>

    <div>
        <h3 class="mt-3 mb-4 display-6">Friends:</h3>
        <a href="{{ route('friends.index') }}" class="btn btn-primary">Go to Friends</a>
    </div>
    </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>