@extends('admin.template')

@section('header')
<div class="mb-7">
</div>
@endsection

@section('content')
  <div class="contaner-fluid mt--7">
    <div class="container">
      <div class="card shadow">
        <div class="card-header">

        </div>
        <div class="p-4">
          <form class="" action="{{ route('admin.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <p>Diákok</p>
            <input type="file" name="students" value="">
            <p>Tanárok</p>
            <input type="file" name="teachers" value="">
            <p>Csoportok</p>
            <input type="file" name="groups" value="">
            <input type="submit" name="" value="submint">
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
