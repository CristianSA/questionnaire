@extends('layouts.admin.layout')
@section('title', 'Projects')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-12">
            <h5 class="display-3 text-white">Projects</h5>
        </div>
    </div>

    <div class="row mt-2">
        <div class="d-flex flex-row-reverse mb-4">
            <button class="btn btn-primary">New project</button>
        </div>
        <div class="col-12 col-md-12">
            <div class="table-responsive">
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Start date</th>
                        <th scope="col">End date</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @if($projects->isNotEmpty())
                        @foreach($projects as $project)
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                        @endforeach
                    @else
                        <tr class="text-center">
                            <td colspan="4">No data</td>
                        </tr>
                    @endif
                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection