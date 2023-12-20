@extends('layout.panel')


@section('content')
<!-- Basic tables title -->
<div class="mb-3">
    <h6 class="mb-0 font-weight-semibold">
        Editar usuario
    </h6>
</div>
<!-- /basic tables title -->
<div class="card">
	<div class="card-body">
	    <form method="post" action="" id="formulario" enctype="multipart/form-data">
	    <input type="hidden" name="_token" value="{{ csrf_token() }}">
	    <input type="hidden" name="id" value="{{ $user->id }}">
			<fieldset class="mb-3">
				<div class="form-group row">
					<label class="col-form-label col-md-2">Nombre</label>
					<div class="col-md-10">
						<input type="text" class="form-control font-weight-bold" id="name" name="name" placeholder="Nombre" value="{{$user->nombre}}" required>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-form-label col-md-2">Email</label>
					<div class="col-md-10">
						<input type="email" class="form-control font-weight-bold" id="email" name="email"  placeholder="Email" value="{{$user->email}}" required>
					</div>
				</div>	
				<div class="form-group row">
					<label class="col-form-label col-md-2">Tipo usuario</label>
					<div class="col-md-10">
						<select class="form-control select" data-fouc="" id="rol" name="rol" required>
							@if($user->id_grupo==1)
								<option value="1" selected>Administrador</option>
							@else
								<option value="1">Administrador</option>
							@endif
							@if($user->id_grupo==2)
								<option value="2" selected>Empleado</option>
							@else
								<option value="2">Empleado</option>
							@endif
							@if($user->id_grupo==3)
								<option value="3" selected>Proveedor</option>
							@else
								<option value="3">Proveedor</option>
							@endif
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


    var user = {!! json_encode($user) !!};
   

	$('#guardar').click(function() {

		if (formulario.checkValidity()) {
			$.ajax({
				type: "POST",
				url: "{{url('user/update')}}",
				data: new FormData($("#formulario")[0]),
				dataType:'json',
				async:true,
				type:'post',
				processData: false,
				contentType: false,
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
