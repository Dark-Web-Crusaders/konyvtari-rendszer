<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($book->title) }}
        </h2>
    </x-slot>

    <div class="absolute right-1/2 translate-x-1/2">
        <div id="grid"
            class="bg-white overflow-hidden shadow-sm w-72 sm:rounded-lg m-2">
            <div class="p-6 bg-white border-gray-600 gap-1 text-left w-72">
                <div class="flex justify-center">
                    <img src="{{ URL($book->image) }}">
                </div>
                <div class="flex justify-center">
                    <span>Title: {{ $book->title }} </span>
                </div>
                <div class="flex justify-center">
                    <span>Author: {{ $book->author }} </span>
                </div>
                <div class="flex justify-center">
                    <span>Publisher: {{ $book->publisher }} </span>
                </div>
                <div class="flex justify-center">
                    <span>Year of publication: {{ $book->published }} </span>
                </div>
                <div class="flex justify-center">
                    <span>Quantity: {{ $book->quantity }} </span>
                </div>
                <div class="flex justify-center">
                    <span>ISBN: {{ $book->isbn }} </span>
                </div>
                <div class="flex justify-center">
                    <span>ISBN13: {{ $book->isbn13 }} </span>
                </div>
                <div class="flex justify-center">
                    <a href="{{ route('editView', ['id' => $book->id]) }}">
                        <x-edit-logo class="fill-current float-right text-gray-600"/>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
