<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-6 col-lg-6">
            <h4 class="display-4 text-white">
                {{ $project->name }}
            </h4>
        </div>
    </div>
    @if($errors->any())
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    @endif
    <form method="POST" action="{{ route('student register-validate', $project->id) }}">
        @csrf
        <input type="hidden" name="project_id" value="{{ $project->id }}"/>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-6">
                <div class="form-group">
                    <label for="nickname">Nickname</label>
                    <input type="text" class="form-control" name="nickname" id="nickname" placeholder="Nickname">
                </div>
            </div>

            
        </div>

        <div class="row">

            <div class="col-12 col-md-6 col-lg-6">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                </div>

            </div>

            <div class="col-12 col-md-6 col-lg-6">
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                </div>

            </div>

        </div>

        <div class="row">
            <div class="col-12 col-md-6 col-lg-12">
                <button type="submit" class="btn btn-primary btn-block">Register</button>
            </div>
        </div>
    </form>
</div>