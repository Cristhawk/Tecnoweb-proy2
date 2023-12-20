@extends('layout.panel')

@section('content')
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
  /* Estilo para el contenedor del gráfico */
  #chart-container {
    width: 400px; /* Ajusta el ancho del contenedor según tu preferencia */
    height: 300px; /* Ajusta la altura del contenedor según tu preferencia */
  }
</style>
<!-- Basic tables title -->
<div class="mb-3">
    <h6 class="mb-0 font-weight-semibold">
      Reporte stock de productos 
    </h6>
</div>
<!-- /basic tables title -->


<!-- Basic table -->
<div class="card">

  <div id="chart-container">
    <canvas id="myChart"></canvas>
  </div>
</div>
<div class="mb-3">
  <h6 class="mb-0 font-weight-semibold">
      Reporte stock de compras por proveedores
  </h6>
</div>
<div class="card">

  <div id="chart-container">
    <canvas id="myChart2"></canvas>
  </div>
</div>
<!-- /basic table -->

@endsection
@push('scripts')     
<script>
  // Datos para el gráfico (puedes usar datos reales en tu aplicación)
  var datos = {
    labels: [{!! json_encode($arrayProducto) !!}],
    datasets: [{
      label: 'Ventas',
      data: [{!! json_encode($arrayStock) !!}], // Datos para las barras
      backgroundColor: 'rgba(54, 162, 235, 0.5)', // Color de las barras
      borderColor: 'rgba(54, 162, 235, 1)', // Color del borde de las barras
      borderWidth: 1 // Ancho del borde de las barras
    }]
  };

  var datos2 = {
    labels: [{!! json_encode($arrayProveedor) !!}],
    datasets: [{
      label: 'Ventas',
      data: [{!! json_encode($arrayStockP) !!}], // Datos para las barras
      backgroundColor: 'rgba(54, 162, 235, 0.5)', // Color de las barras
      borderColor: 'rgba(54, 162, 235, 1)', // Color del borde de las barras
      borderWidth: 1 // Ancho del borde de las barras
    }]
  };

  // Opciones del gráfico
  var opciones = {
    responsive: true,
    maintainAspectRatio: false,
    scales: {
      y: {
        beginAtZero: true
      }
    }
  };

  // Obtén el contexto del canvas y crea el gráfico
  var ctx = document.getElementById('myChart').getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: datos,
    options: opciones
  });

  var ctx2 = document.getElementById('myChart2').getContext('2d');
  var myChart2 = new Chart(ctx2, {
    type: 'bar',
    data: datos2,
    options: opciones
  });
</script>
@endpush