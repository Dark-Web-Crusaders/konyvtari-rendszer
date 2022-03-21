<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($book->title) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-center">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @include('inc.messages')
                {{ Form::open(array('route' => ['editBook', $book->id], 'enctype' => 'multipart/form-data')) }}
                <div class="grid grid-cols-2">
                    <!-- 'title', 'author', 'publisher', 'published', 'quantity', 'isbn', 'isbn13', 'image'-->
                    {{ Form::label('titleLabel', 'Title:', ['class' => 'p-2 m-1 text-right'])}}
                    {{ Form::text('title', $book->title, ['class' => 'border-0 hover:bg-gray-200 w-64 focus:bg-gray-200 m-1', 'placeholder' => 'Title'] )}}
                    {{ Form::label('authorLabel', 'Author:', ['class' => 'p-2 text-right'])}}
                    {{ Form::text('author', $book->author, ['class' => 'border-0 hover:bg-gray-200 w-64 focus:bg-gray-200 m-1', 'placeholder' => 'Author'] )}}
                    {{ Form::label('publisherLabel', 'Publisher:', ['class' => 'p-2 text-right'])}}
                    {{ Form::text('publisher', $book->publisher, ['class' => 'border-0 hover:bg-gray-200 w-64 focus:bg-gray-200 m-1', 'placeholder' => 'Publisher'] )}}
                    {{ Form::label('publishedLabel', 'Published at:', ['class' => 'p-2 text-right'])}}
                    {{ Form::number('published', $book->published, ['class' => 'border-0 m-1 w-20']) }}
                    {{ Form::label('quantityLabel', 'Quantity:', ['class' => 'p-2 text-right'])}}
                    {{ Form::number('quantity', $book->quantity, ['class' => 'border-0 m-1 w-20']) }}
                    {{ Form::label('isbnLabel', 'ISBN:', ['class' => 'p-2 m-1 text-right'])}}
                    {{ Form::label('isbn', $book->isbn, ['class' => 'text-left border-0 hover:bg-gray-200 w-64 focus:bg-gray-200 p-2 m-1', 'placeholder' => 'ISBN'] )}}
                    {{ Form::label('isbn13Label', 'ISBN13:', ['class' => 'p-2 m-1 text-right'])}}
                    {{ Form::label('isbn13', $book->isbn13, ['class' => 'text-left border-0 hover:bg-gray-200 w-64 focus:bg-gray-200 p-2 m-1', 'placeholder' => 'ISBN13'] )}}
                    {{ Form::label('imageCover', 'Cover picture:', ['class' => 'p-2 m-1 text-right'])}}
                    {{ Form::file('image', ['class' => 'border-0 hover:bg-gray-200 w-64 focus:bg-gray-200 p-2 m-1'] ) }}
                </div>
                {{ Form::submit('Save changes!', ['class' => 'hover:bg-gray-200 p-2 m-1 sm:rounded-lg']) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
</x-app-layout>
