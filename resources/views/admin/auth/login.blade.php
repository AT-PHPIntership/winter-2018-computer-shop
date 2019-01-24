    @extends('admin.layout.app')

    @section('content')
    <div class="container d-flex align-items-center">
            <div class="form-holder has-shadow">
              <div class="row">
                <!-- Logo & Information Panel-->
                <div class="col-lg-6">
                  <div class="info d-flex align-items-center">
                    <div class="content">
                      <div class="logo">
                        <h1>Dashboard</h1>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Form Panel    -->
                <div class="col-lg-6 bg-white">
                  <div class="form d-flex align-items-center">
                    <div class="content">
                     

                      <form method="post" class="form-validate" novalidate="novalidate" action="{{ route('login') }}">
                        <div class="form-group">
                            @csrf
                            @if (session('warning'))
                                <div class="alert alert-warning">
                                    {{ session('warning') }}
                                </div>
                            @endif
                          <label  class="label">Email</label>

                          <input type="text" id="email" name="email" placeholder="Email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" required autofocus>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                          <label class="label">Password</label>

                          <input id="password" type="password" name="password"
                          placeholder="Password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required>
                          @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                          @endif
                        </div>
                        <button id="login" type="submit" class="btn btn-primary">
                            {{ __('common.btn_login')}}
                        </button>
                        <!-- This should be submit button but I replaced it with <a> for demo purposes-->
                      </form><a href="#" class="forgot-pass">Forgot Password?</a><br><small>Do not have an account? </small><a href="register.html" class="signup">Signup</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
    @endsection
