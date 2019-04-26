@extends('admin.template')

@section('header')
  <!-- Header -->
    <div class="row">
        <div class="col-xl-6 col-lg-6">
            <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Szavazók</h5>
                            <span class="h2 font-weight-bold mb-0">{{$stats['voted']}}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                <i class="fas fa-chart-pie"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6">
            <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Szavazott</h5>
                            <span class="h2 font-weight-bold mb-0">{{$stats['voted_percentage']}}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                <i class="fas fa-percent"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')

  <!-- Page content -->
  <div class="container-fluid mt--6">
      <div class="row">
          <div class="col-xl-12 mb-5 mb-xl-0">
              <div class="card bg-gradient-default shadow">
                  <div class="card-header bg-transparent">
                      <div class="row align-items-center">
                          <div class="col">
                              <h6 class="text-uppercase text-light ls-1 mb-1">Elmúlt 5 nap</h6>
                              <h2 class="text-white mb-0">Szavazatok</h2>
                          </div>
                      </div>
                  </div>
                  <div class="card-body">
                      <!-- Chart -->
                      <div class="">
                          <!-- Chart wrapper -->
                          <canvas id="chart-voters" class="chart-canvas" height="100"></canvas>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="row mt-5">
          <div class="col-xl-12">
              <div class="card shadow">
                  <div class="card-header border-0">
                      <div class="row align-items-center">
                          <div class="col">
                              <h3 class="mb-0">Osztályonként</h3>
                          </div>
                      </div>
                  </div>
                  <div class="table-responsive">
                      <!-- Projects table -->
                      <table class="table align-items-center table-flush">
                          <thead class="thead-light">
                              <tr>
                                  <th scope="col">Osztály</th>
                                  <th scope="col">Szavazott/Összes</th>
                                  <th scope="col"></th>
                              </tr>
                          </thead>
                          <tbody>
                              @foreach($table as $row)
                                  <tr>
                                      <td>{{$row['name']}}</td>
                                      <td>
                                          {{$row['voted']}}/{{$row['students_count']}}
                                      </td>
                                      <td>
                                          <div class="d-flex align-items-center">
                                              <span class="mr-2">{{number_format($row['percentage'], 2)}}%</span>
                                              <div>
                                                  <div class="progress">
                                                      <div class="progress-bar bg-gradient-danger" role="progressbar" aria-valuenow="{{number_format($row['percentage'], 0)}}" aria-valuemin="0" aria-valuemax="100" style="width: {{number_format($row['percentage'], 0)}}%;"></div>
                                                  </div>
                                              </div>
                                          </div>
                                      </td>
                                  </tr>
                              @endforeach
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
      </div>
  </div>

  <script>
      var ctx = document.getElementById('chart-voters').getContext('2d');
      var myChart = new Chart(ctx, {
          type: 'bar',
          data: {
              labels: @json($chart['labels']),
              datasets: [{
                  label: 'Szavazatok',
                  data: @json($chart['series']),
                  backgroundColor: [
                      'rgba(255, 99, 132, 0.2)',
                      'rgba(54, 162, 235, 0.2)',
                      'rgba(255, 206, 86, 0.2)',
                      'rgba(75, 192, 192, 0.2)',
                      'rgba(153, 102, 255, 0.2)',
                      'rgba(255, 159, 64, 0.2)'
                  ],
                  borderColor: [
                      'rgba(255, 99, 132, 1)',
                      'rgba(54, 162, 235, 1)',
                      'rgba(255, 206, 86, 1)',
                      'rgba(75, 192, 192, 1)',
                      'rgba(153, 102, 255, 1)',
                      'rgba(255, 159, 64, 1)'
                  ],
                  borderWidth: 1
              }]
          },
          options: {
              scales: {
                  yAxes: [{
                      ticks: {
                          beginAtZero: true
                      }
                  }]
              }
          }
      });
  </script>
@endsection
