@extends('layouts.student.layout')
@section('title', 'Dashboard')
@section('content')
<div class="container">
    <div class="row align-items-center">
        <div class="col-md-12 text-center">
            <h4 class="text-white display-3">
                Bienvenido {{ Auth::guard('student')->user()->name }}
            </h4>
        </div>
    </div>
</div>
@endsection