<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add member') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-center">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @include('inc.messages')
                {{ Form::open(array('route' => 'addBook', 'enctype' => 'multipart/form-data')) }}
                <div class="grid grid-cols-2">
                    <!-- 'title', 'author', 'publisher', 'published', 'quantity', 'isbn', 'isbn13', 'image'-->
                    {{ Form::label('titleLabel', 'Title:', ['class' => 'p-2 m-1 text-right'])}}
                    {{ Form::text('title', '', ['class' => 'border-0 hover:bg-gray-200 w-64 focus:bg-gray-200 m-1', 'placeholder' => 'Title'] )}}
                </div>
                {{ Form::submit('Add member!', ['class' => 'hover:bg-gray-200 p-2 m-1 sm:rounded-lg']) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
</x-app-layout>
