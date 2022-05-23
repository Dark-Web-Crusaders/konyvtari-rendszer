<div class="my-2">

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-t-lg m-1">
        @include('inc.messages')
        <div class="grid grid-cols-2 m-4">
            <form id="searchForm" class="search" action="{{ route('searchMember') }}" method="POST">
                @csrf
                <input name="search" type="text" class="search-box" />
                <span class="search-button">
                    <span class="search-icon"></span>
                </span>
            </form>
            <div class="block m-auto">
                <a class="tooltip bg-white" href="{{ route('addmember') }}" title="Add book">
                    <x-pen class="fill-current text-gray-600" />
                </a>
            </div>
        </div>

        <table id="table" class="w-full text-center">
            <tr>
                <th>Name</th>
                <th>Birth date</th>
                <th>Address</th>
                <th>Email</th>
                <th>Pin</th>
                <th>Role</th>
                <th></th>
            </tr>
            @foreach ($members as $member)
                <tr>
                    <td>{{ $member->name }}</td>
                    <td>{{ $member->birth_date }}</td>
                    <td>{{ $member->address }}</td>
                    <td>{{ $member->email }}</td>
                    <td>{{ $member->PIN }}</td>
                    <td>{{ $member->role }}</td>
                    <td>
                        <a href=" {{route('editMember', ['id' => $member->id]) }} ">
                            <button><i class="fa fa-bars w-5 h-5"></i></button>
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    {!! $members->links() !!}
</div>

<script>
    // search button trigger
    $('.search-button').click(function() {
        $(this).parent().toggleClass('open');
        if (!$(this).parent().hasClass('open')) {
            document.getElementById('searchForm').submit();
        }
    });
</script>
