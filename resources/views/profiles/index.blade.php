@extends('layouts.app')

@section('content')
<a type="button" class="btn btn-success fixedbutton" href="{{ route('users.download') }}"> <i class="fas fa-file-excel fa-2x pt-1"></i></a>
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Admin</th>
            <th scope="col">Created At</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <th scope="row">{{ $user->id }}</th>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->is_admin }}</td>
            <td>{{ $user->created_at }}</td>
            <td>
                @if (!$user->is_admin)
                <button id="btnMakeAdmin" type="button" class="btn btn-outline-success">Make Admin</button>
                @elseif ($user->id != 1)
                <button id="btnRemoveAdmin" type="button" class="btn btn-outline-danger">Remove Admin</button>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<script>
    var formData = new FormData();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#btnRemoveAdmin").on('click', function(e) {
        var $tr = $(this).closest('tr');
        var userId = $tr.find("th:eq(0)").text();
        formData.append('_method', 'PATCH');
        formData.append('name', $tr.find("td:eq(0)").text());
        formData.append('email', $tr.find("td:eq(1)").text());
        formData.append('is_admin', '0');

        $.ajax({
            type: 'POST',
            url: "/profile/" + userId,
            contentType: false,
            processData: false,
            data: formData,
            success: function(response) {
                window.location.replace("{{ route('users.index') }}");
            }
        });
    });

    $("#btnMakeAdmin").on('click', function(e) {
        var $tr = $(this).closest('tr');
        var userId = $tr.find("th:eq(0)").text();
        formData.append('_method', 'PATCH');
        formData.append('name', $tr.find("td:eq(0)").text());
        formData.append('email', $tr.find("td:eq(1)").text());
        formData.append('is_admin', '1');

        $.ajax({
            type: 'POST',
            url: "/profile/" + userId,
            contentType: false,
            processData: false,
            data: formData,
            success: function(response) {
                window.location.replace("{{ route('users.index') }}");
            }
        });
    });
</script>

@stop