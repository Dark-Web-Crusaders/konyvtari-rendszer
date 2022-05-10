<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Record New Book Rental') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-center">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                @if (session('status'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                      <strong class="font-bold">Failed to Record New Rental</strong>
                      <span class="block sm:inline">{{session('status')}}</span>
                      <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                      </span>
                    </div>
                @endif

                @include('inc.messages')
                {{ Form::open(array('route' => 'addrental', 'enctype' => 'multipart/form-data')) }}
                <div class="grid md:grid-cols-2 sm:grid-cols-1">
                    {{ Form::label('PIN', 'PIN:', ['class' => 'p-2 my-1 md:mx-1 md:mx-1 mx-10 md:text-right text-center']) }}
                    {{ Form::text('PIN', '', ['class' => 'border-0 hover:bg-gray-200 focus:bg-gray-200 my-1 md:mx-1 mx-10 md:text-left text-center', 'placeholder' => 'PIN'] )}}

                    {{ Form::label('isbn', 'isbn:', ['class' => 'p-2 my-1 md:mx-1 md:mx-1 mx-10 md:text-right text-center']) }}
                    {{ Form::text('isbn', '', ['class' => 'border-0 hover:bg-gray-200 focus:bg-gray-200 my-1 md:mx-1 mx-10 md:text-left text-center', 'placeholder' => 'isbn'] )}}
                </div>
                {{ Form::submit('Add rental!', ['class' => 'hover:bg-gray-200 p-2 my-1 md:mx-1 mx-10 sm:rounded-lg']) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
</x-app-layout>
