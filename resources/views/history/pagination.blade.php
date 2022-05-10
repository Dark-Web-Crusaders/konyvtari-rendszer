<div class="my-2">

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg m-1">
        @include('inc.messages')
        <form id="searchForm" class="search" action="{{route('history')}}" method="POST" >
            @csrf
            <input name="search" type="text" class="search-box" placeholder="Filter by PIN"/>
            <span class="search-button">
                <span class="search-icon"></span>
            </span>
        </form>
        <table id="table" class="w-full text-center">
            <tr>
                <th>PIN</th>
                <th>Name</th>
                <th>ISBN</th>
                <th>Title</th>
                <th>Due Date</th>
            </tr>
        @foreach ($rentals as $rental)
            <tr>
                <td>{{$rental->PIN}}</td>
                <td>{{$rental->name}}</td>
                <td>{{$rental->isbn}}</td>
                <td>{{$rental->title}}</td>
                <td>{{$rental->deadline}}</td>

            </tr>
        @endforeach
        </table>
    </div>
    {!! $rentals->links() !!}
</div>

<script>
    var table = document.getElementById("table");
    checkboxes = document.querySelectorAll("input[name=checkbox]");
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                document.getElementById(`nameDiv${this.id}`).contentEditable = true;
            } else {
                document.getElementById(`nameDiv${this.id}`).contentEditable = false;
            }
        });
    });
    $('.search-button').click(function() {
        $(this).parent().toggleClass('open');
        if (!$(this).parent().hasClass('open')) {
            document.getElementById('searchForm').submit();
        }
    });
</script>
