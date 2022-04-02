<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Library') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Books
                    <a class="tooltip bg-white float-right" href="{{ route('addBook') }}" title="Könyv hozzáadása">
                        <x-pen class="fill-current float-right text-gray-600" />
                    </a>
                </div>
            </div>
            @include('books.pagination')
        </div>
    </div>
</x-app-layout>
