@extends('admin.template')


@section('header')
    <div class="mb-0 mb-lg-3"></div>
@endsection

@section('content')
    <div class="contaner-fluid mt--7">
        <div class="container">
            <div class="card card-shadow">
                <div class="card-header">
                    <h3 class="mb-0">Csoportok aktiválása</h3>
                </div>
                <div class="card-body">
                    <div class="row text-right">
                        <div class="col-md-3 float-right">
                            <div class="form-group pl-3">
                                <input class="form-control small" type="text" placeholder="Szűrés" id="filter-group-name">
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table" id="results-table">
                            <thead>
                            <th>Id</th>
                            <th>Csoport</th>
                            <th>Aktív</th>
                            </thead>
                            <tbody>
                            @foreach($groups as $group)
                                <tr class="group-row">
                                    <td>{{$group->id}}</td>
                                    <td class="name">{{ $group->name }}</td>
                                    <td>
                                        <label class="custom-toggle">
                                            <input class="custom-control-input" id="active_{{ $group->id }}" type="checkbox" name="active[{{ $group->id }}]" @if(true) checked @endif>
                                            <span class="custom-toggle-slider rounded-circle"></span>
                                        </label>
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

@push('custom-scripts')
    <script>
      $(document).ready(function(){
        $("#filter-group-name").on("keyup", function() {
          var value = $(this).val().toLowerCase();
          $("#results-table tr.group-row").filter(function() {
            console.log($(this).children(".name").text()); //todo: group filtering
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
          });
        });
      });
    </script>
@endpush
