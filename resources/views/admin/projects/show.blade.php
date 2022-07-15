@extends('layouts.admin.layout')
@section('title', 'Project: '.$project->name)
@section('content')
<show-project :project="{{ $project }}"/>
@endsection