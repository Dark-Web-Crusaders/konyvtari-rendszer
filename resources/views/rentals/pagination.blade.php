<div class="my-2">

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg m-1">
        @include('inc.messages')
        <form id="searchForm" class="search" action="{{route('rentals')}}" method="POST">
            @csrf
            <input name="search" type="text" class="search-box"/>
            <span class="search-button">
                <span class="search-icon"></span>
            </span>
        </form>
        <table id="table" class="w-full text-center">
            <tr>
                <th>memberID</th>
                <th>bookID</th>
                <th>created_at</th>
                <th>deadline</th>
            </tr>
        @foreach ($rentals as $rental)
            <tr>
                <td>{{$rental->memberID}}</td>
                <td>{{$rental->bookID}}</td>
                <td>{{$rental->created_at}}</td>
                <td>{{$rental->deadline}}</td>
                <td>
                    <a href="{{ route('rentalview', ['id' => $rental->id]) }}" title="Könyv visszavétele">
                        <x-edit-logo class="fill-current float-right text-gray-600"/>
                    </a>
                </td>
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
