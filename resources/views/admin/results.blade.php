@extends('admin.template')

@section('header')
    <!-- Header -->
    <div class="row justify-content-center">
        <div class="col-xl-4 col-lg-4">
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
        <div class="col-xl-4 col-lg-4">
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
        <div class="row mt-5">
            <div class="col-xl-12">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Tanáronként</h3>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Tanár</th>
                                    <th scope="col">Összes értékelés (db)</th>
                                    <th scope="col"></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($resultsByTeachers as $teacher)
                                    <tr>
                                        <td>{{$teacher->name}}</td>
                                        <td>
                                            {{$teacher->ratingCount}}
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="mr-2">{{number_format($teacher->ratingAverage, 2)}}</span>
                                                <div>
                                                    <div class="progress">
                                                        <div class="progress-bar {{($teacher->ratingAverage < 3 ? "bg-gradient-danger" : ($teacher->ratingAverage < 5 ? "bg-gradient-warning" : ($teacher->ratingAverage < 7.5 ? "bg-gradient-info" : "bg-gradient-success")))}}" role="progressbar" aria-valuenow="{{$teacher->ratingAverage ? 0 : number_format($teacher->resultsAverage, 0)}}" aria-valuemin="0" aria-valuemax="10" style="width: {{number_format($teacher->ratingAverage, 0) * 10}}%;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a class="dropdown-toggle" data-toggle="collapse" href=".rating_{{$teacher->id}}" aria-expanded="false">
                                            </a>
                                        </td>
                                    </tr>
                                    <tr class="no-content">
                                        <td colspan="5">
                                            <div class="collapse rating_{{$teacher->id}}">
                                                <div class="container" style="max-width: 600px">
                                                    @foreach($teacher->ratings as $rating)
                                                        <div class="row">
                                                            <div class="col">{{$rating->ratingType->name}}:</div>
                                                            <div class="col d-flex align-items-center">
                                                                <span class="mr-2">{{number_format($rating->average, 2)}}</span>
                                                                <div>
                                                                    <div class="progress">
                                                                        <div class="progress-bar {{($rating->average < 3 ? "bg-gradient-danger" : ($rating->average < 5 ? "bg-gradient-warning" : ($rating->average < 7.5 ? "bg-gradient-info" : "bg-gradient-success")))}}" role="progressbar" aria-valuenow="{{$rating->average ? 0 : number_format($rating->average, 0)}}" aria-valuemin="0" aria-valuemax="9" style="width: {{number_format($rating->average, 0) * 11.11}}%;"></div>
                                                                    </div>
                                                                </div>
                                                                <span class="text-muted ml-2">({{$rating->count}} leadott szavazat)</span>
                                                            </div>
                                                        </div>
                                                    @endforeach
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
                                @foreach($by_classes_table as $row)
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
@endsection
