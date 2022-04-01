<div class="my-2">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg m-1">
        <table id="table" class="w-full text-center">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Birth date</th>
                <th>PIN</th>
            </tr>
        @foreach ($members as $member)
            <tr>
                <td>{{$member->id}}</td>
                <td>
                    <div contenteditable="false" id="nameDiv{{$loop->iteration}}" class="border-0 m-0 p-0 text-center">{{$member->name}}</div>
                </td>
                <td>{{$member->birth_date}}</td>
                <td>{{$member->PIN}}</td>
                <td>
                    <input type="checkbox" name="checkbox" id="{{$loop->iteration}}">
                </td>
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


</script>
