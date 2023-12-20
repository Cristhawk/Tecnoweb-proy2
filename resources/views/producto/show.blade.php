@extends('layout.panel')


@section('content')
<!-- Basic tables title -->
<div class="mb-3">
    <h6 class="mb-0 font-weight-semibold">
        Detalle del usuario
    </h6>
</div>
<!-- /basic tables title -->


<div class="card">
    <div class="col-md-4">
        <div class="card-body border-top-0">
            <div class="d-sm-flex flex-sm-wrap mb-3">
                <div class="font-weight-semibold">Nombre:</div>
                <div class="ml-sm-auto mt-2 mt-sm-0">{{$user->name}}</div>
            </div>
            <div class="d-sm-flex flex-sm-wrap mb-3">
                <div class="font-weight-semibold">Email:</div>
                <div class="ml-sm-auto mt-2 mt-sm-0">{{$user->email}}</div>
            </div>
            <div class="d-sm-flex flex-sm-wrap mb-3">
                <div class="font-weight-semibold">Tipo usuario:</div>
                <div class="ml-sm-auto mt-2 mt-sm-0">{{$user->name}}</div>
            </div>

            <div class="d-sm-flex flex-sm-wrap mb-3">
                <div class="font-weight-semibold">Perfil:</div>
                <div class="ml-sm-auto mt-2 mt-sm-0"><img src="{{asset($user->perfil)}}" alt="Fotografia" style="width: 150px;object-fit: contain;"></div>
            </div>
        </div>
    </div>
</div>


@endsection  
@push('scripts')
<script>
    $('#navUser').addClass('nav-item-open');
</script>
@endpush