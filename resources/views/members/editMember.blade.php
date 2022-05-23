<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($member->name) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-center">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @include('inc.messages')
                {{ Form::open(array('route' => ['updateMember', $member->id], 'enctype' => 'multipart/form-data')) }}
                <div class="grid grid-cols-2">
                    <!-- 'title', 'author', 'publisher', 'published', 'quantity', 'isbn', 'isbn13', 'image'-->
                    {{ Form::label('nameLabel', 'Name:', ['class' => 'p-2 my-1 md:mx-1 md:mx-1 mx-10 md:text-right text-center']) }}
                    {{ Form::text('name', $member->name, ['class' => 'border-0 hover:bg-gray-200 focus:bg-gray-200 my-1 md:mx-1 mx-10 md:text-left text-center', 'placeholder' => 'Name'] )}}
                    {{ Form::label('birthdateLabel', 'Birthdate:', ['class' => 'p-2 my-1 md:mx-1 mx-10 md:text-right sm:text-center']) }}
                    {{ Form::date('birthdate', $member->birth_date, ['class' => 'border-0 hover:bg-gray-200 focus:bg-gray-200 my-1 md:mx-1 mx-10 md:text-left text-center']) }}
                    {{ Form::label('addressLaber', 'Address:', ['class' => 'p-2 my-1 md:mx-1 mx-10 md:text-right text-center']) }}
                    {{ Form::text('address', $member->address, ['class' => 'border-0 hover:bg-gray-200 focus:bg-gray-200 my-1 md:mx-1 mx-10 md:text-left text-center', 'placeholder' => 'Address']) }}
                    {{ Form::label('emailLabel', 'Email:', ['class' => 'p-2 my-1 md:mx-1 mx-10 md:text-right text-center']) }}
                    {{ Form::text('email', $member->email, ['class' => 'border-0 hover:bg-gray-200 focus:bg-gray-200 my-1 md:mx-1 mx-10 md:text-left text-center', 'placeholder' => 'Email']) }}
                    {{ Form::label('pinLabel', 'PIN:', ['class' => 'p-2 my-1 md:mx-1 mx-10 md:text-right text-center']) }}
                    {{ Form::text('pin', $member->PIN, ['class' => 'border-0 hover:bg-gray-200 focus:bg-gray-200 my-1 md:mx-1 mx-10 md:text-left text-center', 'placeholder' => 'Pin']) }}
                    {{ Form::label('roleLabel', 'Role:', ['class' => 'p-2 my-1 md:mx-1 mx-10 md:text-right text-center']) }}
                    {{ Form::select('role', ['US' => 'University student', 'UL' => 'University lecturer',
                     'OU' => 'Other University\'s lecturer and student ', 'EE' => 'Everybody else'],
                      $member->role ,['class' => 'border-0 hover:bg-gray-200 focus:bg-gray-200 my-1 md:mx-1 mx-10']) }}
                </div>
                {{ Form::submit('Update changes!', ['class' => 'hover:bg-gray-200 p-2 m-1 sm:rounded-lg']) }}
                {{ Form::close() }}
                {{ Form::open(array('route' => ['deleteMember', $member->id], 'enctype' => 'multipart/form-data')) }}
                {{ Form::submit('Delete member!', ['class' => 'hover:bg-gray-200 p-2 m-1 sm:rounded-lg']) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
</x-app-layout>
