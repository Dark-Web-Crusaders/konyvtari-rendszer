<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Returning {{ $rental->title }}
        </h2>
    </x-slot>

    <div class="absolute right-1/2 translate-x-1/2">
        <div id="grid"
            class="bg-white overflow-hidden shadow-sm w-72 sm:rounded-lg m-2">
            <div class="p-6 bg-white border-gray-600 gap-1 text-left w-72">
                <div class="flex justify-center">
                    <img src="{{ URL($rental->image) }}">
                </div>
                <div class="flex justify-center">
                    <span>Title: {{ $rental->title }} </span>
                </div>
                <div class="flex justify-center">
                    <span>Author: {{ $rental->author }} </span>
                </div>
                <div class="flex justify-center">
                    <span>Publisher: {{ $rental->publisher }} </span>
                </div>
                <div class="flex justify-center">
                    <span>Year of publication: {{ $rental->published }} </span>
                </div>
                <div class="flex justify-center">
                    <span>Quantity: {{ $rental->quantity }} </span>
                </div>
                <div class="flex justify-center">
                    <span>ISBN: {{ $rental->isbn }} </span>
                </div>
                <div class="flex justify-center">
                    <span>ISBN13: {{ $rental->isbn13 }} </span>
                </div>

                <div class="flex justify-center">
                    <span>PIN: {{ $rental->PIN }} </span>
                </div>
                <div class="flex justify-center">
                    <span>Name: {{ $rental->name }} </span>
                </div>
                <div class="flex justify-center">
                    <span>Due Date: {{ $rental->deadline }} </span>
                </div>
                @if (-now()->diffInDays($rental->deadline, false) > 0)
                    <div class="flex justify-center">
                        <span>Lateness: {{ -now()->diffInDays($rental->deadline, false)  }} days</span>
                    </div>
                @endif
                <div class="flex justify-center">
                    <form action='/rentals/{{ $rental->rentalID }}' method="POST">
                        @method('PUT')
                        @csrf
                        <button class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow" type="submit">Return Book</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
