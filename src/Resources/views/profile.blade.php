@extends($layout)
@section('content')
    <div class="login-logo">
        <a href="/maguma">
            <img src="{{ url('packages/cristabel/img/message.svg') }}" width="64">
            <span>Cristabel</span>
        </a>
    </div>
    <div class="login-box-body">
        {!! Form::open(['url' => '/profile/save', 'name' => 'signin', 'class' => 'form-signin', 'role' => 'form']) !!}
            @include('shield::message.error')
            @include('shield::message.success')

            <div style="text-align: center">
                <img src="{{ url('packages/cristabel/img/mitimiti_160.jpg') }}" class="img-circle" alt="user-profile" width="64">
                <h3 class="form-signin-heading">Shield - Profile</h3>
            </div>
            <div class="form-group has-feedback">
                <input type="text" class="form-control" name="name" value="{{ $user->name }}" placeholder="Name">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="email" class="form-control" name="email" value="{{ $user->email }}" placeholder="Email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" name="password" class="form-control" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <a href="{{ url('/shield/logout') }}" class="btn btn-danger btn-block">
                        <span class="glyphicon glyphicon-road"></span> Sign out
                    </a>
                </div>
                <div class="col-lg-6">
                    <button type="submit" class="btn btn-success btn-block">
                        <span class="glyphicon glyphicon-ok"></span> Save
                    </button>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
@endsection
