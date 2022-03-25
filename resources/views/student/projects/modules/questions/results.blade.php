@extends('layouts.student.layout')
@section('title', 'Results')
@section('content')
<student-result :module="{{ $module }}"></student-result>
@endsection