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
      <th scope="col" id="id">#</th>
      <th scope="col">Name</th>
      <th scope="col">Wikipedia Link</th>
      <th scope="col">Scientific name</th>
      <th scope="col">Group</th>
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>

  </tbody>
</table>

<a href="{{ route('ingredients.create') }}" class="btn btn-success rounded-circle fixedbutton btn-lg shadow " id="btnAddIngredient"><i class="fas fa-plus pt-2"></i></a>

<script>
  $.ajax({
    url: "{{ url('/api/ingredients') }}",
    success: function(data) {
      $.each(data, function(index, value) {
        $('#myTable > tbody:last-child').append('<tr><th scope="row">' + data[index].id + '</th><td>' + data[index].name +
          '</td><td>' + '<a href="http://wikipedia.org/wiki/"' + data[index].wikipedia_id + '>' + data[index].name + '</a>' +
          '</td><td>' + data[index].name_scientific + '</td><td>' + data[index].group + '</td> <td><a href="/ingredients/' + data[index].id + '" id="btnView" type="button" class="btn btn-primary">Info</a></td>' +
          '<td><button type="button" class="btn btn-dark" id="btnEdit" >Edit</button>' +
          '</td><td><button type="button" class="btn btn-danger" id="btnDelete">Delete</button>' + '</td></tr>');
      })
    },
  });

  $("body").on("click", "#btnDelete", function() {

    var id = $(this).closest('tr').find('th:first');
    id = id.text();
    $.ajax({
      url: '/api/ingredients/' + id,
      type: 'DELETE',
      success: function(result) {
        location.reload();
      }
    });
  });

  $(document).ready(function() {
    $('#btnAddIngredient').on('click', function(e) {
      e.preventDefault();
      var link = this.href;
      $('.modal').modal('toggle');
      $('.modal').load(link, function() {
        $('select').selectpicker();
      })
    });

    $('#btnEdit').on('click', function(e) {
      e.preventDefault();
      var link = this.href;
      $('.modal').modal('toggle');
      $('.modal').load(link, function() {
        $('select').selectpicker();
      })
    });
  });
</script>
@stop