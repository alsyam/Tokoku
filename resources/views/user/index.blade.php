@extends('layouts.main')

@section('container')
    <h1>Halaman Profile</h1>
    @foreach ($users as $user)
        
   <p>{{ $user->name }}</p>
    @endforeach
@endsection
