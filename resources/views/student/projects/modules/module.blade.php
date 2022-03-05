@extends('layouts.student.layout')
@section('title', 'Module')
@section('content')
<student-module :module="{{ $module }}"></student-module>
@endsection