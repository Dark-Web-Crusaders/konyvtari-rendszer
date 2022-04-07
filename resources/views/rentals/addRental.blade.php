<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add book rental') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-center">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
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
