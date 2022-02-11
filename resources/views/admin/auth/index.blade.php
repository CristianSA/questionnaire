@extends('layouts.admin.guest')
@section('title', 'Login admin')
@section('content')
<div class="container">
    <div class="row align-items-center h-100">
        <div class="col-12 col-md-6 py-5 mx-auto">
            
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin validate') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email"/>
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password"/>
                        </div>
                        
                        
                        <input type="submit" class="btn btn-block btn-success text-white" value="Access"/>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection