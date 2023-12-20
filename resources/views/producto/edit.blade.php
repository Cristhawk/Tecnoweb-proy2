@extends('layout.panel')


@section('content')
<!-- Basic tables title -->
<div class="mb-3">
    <h6 class="mb-0 font-weight-semibold">
        Editar producto
    </h6>
</div>
<!-- /basic tables title -->
<div class="card">
	<div class="card-body">
	    <form method="post" action="" id="formulario" enctype="multipart/form-data">
	    <input type="hidden" name="_token" value="{{ csrf_token() }}">
	    <input type="hidden" name="id" value="{{ $producto->id }}">
			<fieldset class="mb-3">
				<div class="form-group row">
					<label class="col-form-label col-md-2">Nombre</label>
					<div class="col-md-10">
						<input type="text" class="form-control font-weight-bold" id="nombre" name="nombre" placeholder="Nombre" value="{{$producto->nombre}}" required>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-md-2">Precio</label>
					<div class="col-md-10">
						<input type="text" class="form-control font-weight-bold" id="precio" name="precio" value="{{$producto->precio}}"  placeholder="descripcion" required>
					</div>
				</div>	
				<div class="form-group row">
					<label class="col-form-label col-md-2">Categoria</label>
					<div class="col-md-10">
						<select class="form-control select" data-fouc="" id="categoria" name="categoria" required>
							@foreach ($categorias as $item)
							@if ($producto->id_categoria==$item->id)
								<option value="{{$item->id}}" selected>{{$item->nombre}}</option>
							@else
								<option value="{{$item->id}}" >{{$item->nombre}}</option>
							@endif
							@endforeach
							
						</select>
					</div>
				</div>	
			</fieldset>
			<div class="text-right">
				<button id="guardar" type="button" class="btn btn-primary">Guardar <i class="icon-paperplane ml-2"></i></button>
			</div>


		</form>
	</div>
</div>

@endsection  
@push('scripts')     
<script src="{{asset('js/jquery.blockUI.js')}}" type="text/javascript"></script>  
<script>
$(document).ready(function(){
	$('#navUser').addClass('nav-item-open');
	
	var formulario = document.getElementById('formulario');

	$.ajaxSetup({
		headers: {
		  'X-CSRF-TOKEN': $('input[name="_token"]').val()
		}
	});


    var user = {!! json_encode($producto) !!};
   

	$('#guardar').click(function() {

		if (formulario.checkValidity()) {
			$.ajax({
				type: "POST",
				url: "{{url('producto/update')}}",
				data: new FormData($("#formulario")[0]),
				dataType:'json',
				async:true,
				type:'post',
				processData: false,
				contentType: false,
				success: function( response ) {
					if (response.codigo==0) {
						setTimeout(function(){window.location = "https://mail.tecnoweb.org.bo/inf513/grupo02sa/proyecto2/public/producto"} , 100);   
					}else{
						alert(response.mensaje);
					}
				},
				error: function (xhr, ajaxOptions, thrownError) {

				}
			});
		}else{
			formulario.reportValidity();
		}

    }); 



});



$(document).ajaxStart(function (){

    $.blockUI({ 
		message: '<h3><img style="height: 90px;width: 90px;" src="{{asset('busy.gif')}}" /> Cargando </h3>',
		css: { 
	        border: 'none', 
	        padding: '15px', 
	        backgroundColor: '#000', 
	        '-webkit-border-radius': '10px', 
	        '-moz-border-radius': '10px', 
	        opacity: .5, 
	        color: '#fff'
		}
    });		
       
	}).ajaxStop(function (){
		$.unblockUI();
		}
	);

</script>
@endpush
