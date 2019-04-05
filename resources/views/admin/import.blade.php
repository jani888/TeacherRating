@extends('admin.template')

@section('content')
  <form class="" action="{{ route('admin.import') }}" method="post">
    @csrf
    <input type="file" name="students" value="">
    <input type="file" name="teachers" value="">
    <input type="file" name="groups" value="">
    <input type="submit" name="" value="">
  </form>
@endsection
