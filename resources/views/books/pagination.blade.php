<div>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg m-1">
        @include('inc.messages')
        <form id="searchForm" class="search" action="{{route('library')}}" method="POST">
            @csrf
            <input name="search" type="text" class="search-box"/>
            <span class="search-button">
                <span class="search-icon"></span>
            </span>
        </form>
    <div id="grid"
        class="bg-white overflow-hidden shadow-sm sm:rounded-lg m-2 grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        @foreach( $books as $book )
        <div class="flex justify-center">
            <a href="{{ route('bookview', ['id' => $book->id]) }}">
                <div class="p-6 bg-white border-gray-600 gap-1 text-left w-72 h-full max-w-xs">
                    <div class="flex justify-center h-72">
                        <img class="" src="{{ URL($book->image) }}">
                    </div>
                    <div class="flex justify-center">
                        <span>Cím: {{ $book->title }} </span>
                    </div>
                    <div class="flex justify-center">
                        <span>Író: {{ $book->author }} </span>
                    </div>
                    <div class="flex justify-center">
                        <span>Kiadó: {{ $book->publisher }} </span>
                    </div>
                    <div class="flex justify-center">
                        <span>Kiadás éve: {{ $book->published }} </span>
                    </div>
                    <div class="flex justify-center">
                        <span>Mennyiség: {{ $book->quantity }} </span>
                    </div>
                    <div class="flex justify-center">
                        <span>ISBN: {{ $book->isbn }} </span>
                    </div>
                    <div class="flex justify-center">
                        <span>ISBN13: {{ $book->isbn13 }} </span>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
    {!! $books->links() !!}
</div>

<script>
    $('.search-button').click(function() {
        $(this).parent().toggleClass('open');
        if (!$(this).parent().hasClass('open')) {
            document.getElementById('searchForm').submit();
        }
    });
</script>
