<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Rentalview
        </h2>
    </x-slot>

    <div class="absolute right-1/2 translate-x-1/2">
        <div id="grid"
            class="bg-white overflow-hidden shadow-sm w-72 sm:rounded-lg m-2">
            <div class="p-6 bg-white border-gray-600 gap-1 text-left w-72">
                <div class="flex justify-center">
                    <span>memberID: {{ $rental->memberID }} </span>
                </div>
                <div class="flex justify-center">
                    <span>bookID: {{ $rental->bookID }} </span>
                </div>
                <div class="flex justify-center">
                    <span>Határidő: {{ $rental->deadline }} </span>
                </div>
                <div class="flex justify-center">
                    <a href="{{ route('rentals', ['id' => $rental->id]) }}">
                        <x-edit-logo class="fill-current float-right text-gray-600"/>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>