<div class="my-2">

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg m-1">
        @include('inc.messages')
        <form id="searchForm" class="search" action="{{route('members')}}" method="POST">
            @csrf
            <input name="search" type="text" class="search-box"/>
            <span class="search-button">
                <span class="search-icon"></span>
            </span>
        </form>
        <table id="table" class="w-full text-center">
            <tr>
                <th>Name</th>
                <th>Birth date</th>
                <th>Address</th>
                <th>Email</th>
                <th>Pin</th>
                <th>Role</th>
            </tr>
        @foreach ($members as $member)
            <tr>
                <td>
                    <div contenteditable="false" id="nameDiv{{$loop->iteration}}" class="border-0 m-0 p-0 text-center">{{$member->name}}</div>
                </td>
                <td>{{$member->birth_date}}</td>
                <td>{{$member->address}}</td>
                <td>{{$member->email}}</td>
                <td>{{$member->PIN}}</td>
                <td>{{$member->role}}</td>
            </tr>
        @endforeach
        </table>
    </div>
    {!! $members->links() !!}
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
