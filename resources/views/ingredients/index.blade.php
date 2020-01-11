@extends('layouts.app')

@section('content')
@if(session()->get('success'))
<div class="alert alert-success">
    {{ session()->get('success') }}
</div><br />
@endif

<table class="table" id="myTable">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Wikipedia Link</th>
      <th scope="col">Scientific name</th>
      <th scope="col">Group</th>
      <th scope="col">View</th>
    </tr>
  </thead>
  <tbody>

  </tbody>
</table>

<script>
    $.ajax({
        url: "{{ url('/api/ingredients') }}",
        success: function(data) {
            $.each(data, function( index, value ) {
                $('#myTable > tbody:last-child').append('<tr><th scope="row">' + data[index].id + '</th><td>' + data[index].name + 
                '</td><td>' + '<a href="http://wikipedia.org/wiki/"'+ data[index].wikipedia_id + '>' + data[index].name + '</a>' + 
                '</td><td>' + data[index].name_scientific + '</td><td>' + data[index].group + '</td> <td><a href="/ingredients/'+ data[index].id +'" id="btnView" type="button" class="btn btn-outline-info">Info</a></td> </tr>');
            })
        },
    });

</script>
@stop