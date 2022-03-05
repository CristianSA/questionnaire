@extends('layouts.student.layout')
@section('title', 'Modules')
@section('content')
<student-modules :project="{{ $project }}"></student-modules>
@endsection