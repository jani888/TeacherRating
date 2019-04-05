@extends('admin.template')

@section('content')
  <form class="" action="{{ route('admin.import') }}" method="POST">
    @csrf
    <p>Diákok</p>
    <input type="file" name="students" value="">
    <p>Tanárok</p>
    <input type="file" name="teachers" value="">
    <p>Csoportok</p>
    <input type="file" name="groups" value="">
    <input type="submit" name="" value="submint">
  </form>
@endsection
