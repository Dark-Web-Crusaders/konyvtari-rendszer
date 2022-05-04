@if (count($errors) > 0)
    @foreach ($errors->all() as $error)
        <div id="mydiv" class="m-1 text-center block bg-red-400 sm:rounded-lg">
            {{ $error }}
        </div>
    @endforeach
@endif

@if (session('success'))
    <div class="m-1 text-center block bg-green-300 sm:rounded-lg">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="m-1 text-center block bg-orange-300 sm:rounded-lg">
        {{ session('warning') }}
    </div>
@endif
