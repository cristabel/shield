@extends($layout)
@section('content')
    <div class="login-logo">
        <a href="/maguma">
            <img src="{{ url('packages/cristabel/img/message.svg') }}" width="64">
            <span>Cristabel</span>
        </a>
    </div>
    <div class="login-box-body">
        {!! Form::open(['url' => '/shield/login', 'name' => 'signin', 'class' => 'form-signin', 'role' => 'form']) !!}
            @include('shield::error.messages')
            <div style="text-align: center">
                <h3 class="form-signin-heading">Shield - Please sign in</h3>
            </div>
            <div class="form-group has-feedback">
                <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" name="password" class="form-control" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-lg-offset-8 col-lg-4">
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
@endsection
