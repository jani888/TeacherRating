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
                    <div class="row d-flex align-items-center pl-3 mb-3">
                        <div class="col-md-3">
                            <div class="form-group mb-0">
                                <input class="form-control small" type="text" placeholder="Csoprotok szűrése" id="filter-group-name">
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group mb-0">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="filter-radio-begins" name="filter-radio" class="custom-control-input">
                                    <label class="custom-control-label" for="filter-radio-begins">Elején</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="filter-radio-ends" name="filter-radio" class="custom-control-input">
                                    <label class="custom-control-label" for="filter-radio-ends">Végén</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="filter-radio-contains" name="filter-radio" class="custom-control-input" checked>
                                    <label class="custom-control-label" for="filter-radio-contains">Tartalmazza</label>
                                </div>
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
                                        <label class="custom-toggle mb-0">
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
            filter();
        });
        $("input[name=filter-radio]").on("click", function() {
          filter();
        });
      });

      function filter(){
        var value = $("#filter-group-name").val().toLowerCase();
        $("#results-table tr.group-row").filter(function() {
          let text = $(this).children(".name").text();
          if($("input#filter-radio-begins").prop("checked")){
            $(this).toggle(text.startsWith(value));
          }else if($("input#filter-radio-ends").prop("checked")){
            $(this).toggle(text.endsWith(value));
          }else if($("input#filter-radio-contains").prop("checked")){
            $(this).toggle(text.indexOf(value) > -1)
          }
      });
      }
    </script>
@endpush
