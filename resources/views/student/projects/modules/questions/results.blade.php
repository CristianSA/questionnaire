@extends('layouts.student.layout')
@section('title', 'Results')
@section('content')
<student-results :module="{{ $module }}"></student-results>
@endsection