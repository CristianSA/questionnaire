@extends('layouts.student.layout')
@section('title', 'Questions')
@section('content')
<student-questions :questions="{{ $questions }}" :module="{{ $module }}"></student-questions>
@endsection