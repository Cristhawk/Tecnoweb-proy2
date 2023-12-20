@extends('layout.panel')

@section('content')
<input type="hidden" name="_token" value="{{ csrf_token() }}">


<!-- Basic tables title -->
<div class="mb-3">
    <h6 class="mb-0 font-weight-semibold">
        Listado de administradores  <a href="{{url('user/create')}}" class="btn btn-success rounded-round">Nuevo</a> 
    </h6>
</div>
<!-- /basic tables title -->


<!-- Basic table -->
<div class="card">
  <form action="{{ url('user') }}" method="get">
    <label for="busqueda">Buscar :</label>
    <input type="text" name="busqueda" id="busqueda" value="{{ $busqueda ?? '' }}" required>
    <button type="submit">Buscar</button>
</form>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th> # </th>
                    <th> Nombre </th>
                    <th> Email </th>
                    <th> Tipo usuario </th>
                    <th> Opciones </th>
                </tr>
            </thead>
            <tbody>
            	@foreach($users as $item)
                <tr >
                    <td>  {{$item->id}} </td>
                    <td> {{$item->nombre}}</td>
                    <td> {{$item->email}} </td>
                    <td> 
                    	@if($item->id_grupo==1)
                      Administrativo
                    	@elseif($item->id_grupo==2)
                    		Empleado
                      @else
                      Proveedor
                    	@endif
                    </td>
                    <td>      
                		<a href="{{url('user/'.$item->id.'/edit')}}" class="btn btn-primary rounded-round">Editar</a> 
                            <button type="button" data-target="#user{{$item->id}}" data-toggle="modal" class="btn btn-danger rounded-round">Inhabilitar</button>
                      
                        @include('user.modal-estado')
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- /basic table -->

@endsection
@push('scripts')     
<script>

$('#navUser').addClass('nav-item-open');

$(document).ready(function(){

	$.ajaxSetup({
		headers: {
		  'X-CSRF-TOKEN': $('input[name="_token"]').val()
		}
	});


    inhabilitar = function (id){
      var idAdministrador = id;
      $.ajax({
        type: "POST",
        url: "{{url('user/estado')}}",
        data: {id: idAdministrador,estado:1},
        success: function( response ) {
          if (response.codigo==0) {
            setTimeout(function(){window.location = "https://mail.tecnoweb.org.bo/inf513/grupo08sc/proyecto2/public/user"} , 100);   
          }else{

	          alert(response.mensaje);
          }
        },
        error: function (xhr, ajaxOptions, thrownError) {
         
        }

      });
    }

    habilitar = function (id){
      var idAdministrador = id;
      $.ajax({
        type: "POST",
        url: "{{url('user/estado')}}",
        data: {id: idAdministrador,estado:0},
        success: function( response ) {
          if (response.codigo==0) {
            setTimeout(function(){window.location = "https://mail.tecnoweb.org.bo/inf513/grupo08sc/proyecto2/public/user"} , 100);   
          }else{

              alert(response.mensaje);
          }
        },
        error: function (xhr, ajaxOptions, thrownError) {
         
        }

      });
    }


});




</script>
@endpush