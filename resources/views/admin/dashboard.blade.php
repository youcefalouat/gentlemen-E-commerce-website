@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    
    <div class="row justify-content-center mt-4">
        <div class="col-md-6">
          <canvas id="myChart" width="600" height="400"></canvas>
        </div>
        <!--<div class="col-md-6">
          <canvas id="myChart2" width="600" height="400"></canvas>
        </div>
        <div class="col-md-6">
          <canvas id="myChart3" width="600" height="400"></canvas>
        </div>
    -->
      </div>

    <script>
        $(document).ready(function() {
            $('#productsTable').DataTable();
        });
    </script>
@endsection
@section('after-scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
     const ctx = document.getElementById('myChart');
    fetch("{{ route('chart') }}")
  .then(response => response.json())
  .then(json => {
    const barColors = [
      'rgba(54, 162, 235, 0.5)',    // Color for 'en préparation'
      'rgba(153, 102, 255, 0.5)',    // Color for 'inspection de travail'
      'rgba(255, 206, 86, 0.5)',    // Color for 'au tribunal'
      'rgba(255, 159, 64, 0.5)',    // Color for 'à la cour'
      'rgba(255, 99, 132, 0.5)',   // Color for 'à la cour suprême'
      'rgba(75, 192, 192, 0.5)',    // Color for 'Gagné'
      'rgba(255, 0, 0, 0.5)'        // Color for 'Perdu'
    ];
        new Chart(ctx, {
        type: 'bar',
        data: {
          labels: json.labels,
          datasets: [
                {
                    label: 'Commande par statut',
                    data: json.datasets,
                    backgroundColor: [
      'rgba(255, 159, 64, 0.5)',    // Color for 'en préparation'
      'rgba(54, 162, 235, 0.5)',    // Color for 'inspection de travail'
      'rgba(255, 206, 86, 0.5)',    // Color for 'au tribunal'
      'rgba(153, 102, 255, 0.5)',    // Color for 'à la cour'
      'rgba(255, 0, 0, 0.5)',   // Color for 'à la cour suprême'
      'rgba(75, 192, 192, 0.5)',    // Color for 'Gagné'
      'rgba(255, 99, 132, 0.5)'       // Color for 'Perdu'
    ],
                    borderColor: [
      'rgba(54, 162, 235, 0.5)',    // Color for 'en préparation'
      'rgba(255, 159, 64, 0.5)',    // Color for 'inspection de travail'
      'rgba(255, 206, 86, 0.5)',    // Color for 'au tribunal'
      'rgba(153, 102, 255, 0.5)',    // Color for 'à la cour'
      'rgba(255, 0, 0, 0.5)',        // Color for 'à la cour suprême'
      'rgba(75, 192, 192, 0.5)',    // Color for 'Gagné'
      'rgba(255, 99, 132, 0.5)'       // Color for 'Perdu'
    ],
                    borderWidth: 1,
                }
                ]
        },
        options: {
          responsive: true, // Allow the chart to be responsive
          maintainAspectRatio: false,
          scales: {
            y: {
              beginAtZero: true,
            ticks: {
                precision: 0
                }
            }
          }
        }
      });
});
</script>

<script>
    const ctx2 = document.getElementById('myChart2');
     fetch("{{ route('chart') }}")
    .then(response => response.json())
    .then(json => {
          new Chart(ctx2, {
          type: 'bar',
          data: {
            labels: [
            'w'
              ],
            datasets: [
                  {
                      label: '',
                      data: json.datasets2,
                      backgroundColor: [
                      'rgba(255, 99, 132, 0.5)',
                      'rgba(54, 162, 235, 0.5)'
                      ],
                      borderColor: [
                      'rgba(255, 99, 132, 1)',
                      'rgba(54, 162, 235, 1)'
                      ],
                      borderWidth: 1          
                  }
                  ]
          },
          options: {
            scales: {
              y: {
                beginAtZero: true,
              ticks: {
                  precision: 0
                  }
              }
            }
          }
        });
  }); 
</script>
@endsection