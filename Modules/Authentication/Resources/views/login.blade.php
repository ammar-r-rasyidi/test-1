@extends('templates::layouts.frontend')

@push('regular_css')
  <style type="text/css">

    #show-password{
      cursor: pointer;
      z-index: 2
    } 
  </style>

@endpush

@push('regular_js')

  <script type="text/javascript">
    $(document).ready(function(){

      $(document).on('click','#show-password', function (e) {
        e.preventDefault();
        e.stopPropagation();

        var x = document.getElementById("login_password");
        if (x.type === "password") {
          x.type = "text";
        } else {
          x.type = "password";
        }

      });
    });  
  </script>
@endpush
@section('content')
  <div class="row justify-content-center">
    <div class="col-lg-6 col-md-6 col-11">
      <div class="card">
        <div class="card-body">
          <div class="text-center">
            <img style="height: 100px; margin-right: -15px; padding: 30px 20px 20px; border-radius: 20px !important;" class="img-fluid" src="{{ asset('logo.png') }}">
          </div>
          <div class="row justify-content-center">
            <div class="col-lg-8 col-md-8 col-11">
              <form id="needs-validation" class="form-store" method="POST" action="{{ route('login') }}">
                {!! csrf_field() !!}
                <div class="form-group">
                  @if(session('errors'))
                    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                      @if(count( $errors ) > 0)
                        @foreach ($errors->all() as $error)
                          <span>{{ $error }}</span>
                        @endforeach
                      @endif
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span class="fas fa-times-circle"></span>
                      </button>
                    </div>
                  @endif
                </div>
                <div class="input-group mb-3">
                  <input type="text" class="form-control" name="name" placeholder="Username or Email" required="">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-envelope"></span>
                    </div>
                  </div>
                </div>
                <div class="input-group mb-3">
                  <input id="login_password" type="password" class="form-control" name="password" placeholder="Password" required="">
                  <div id="show-password" class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-eye"></span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-8">
                    <div class="icheck-primary">
                      <input id="remember" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                      <label for="remember">
                        Remember Me
                      </label>
                    </div>
                  </div>
                </div>                
                <button id="login_submit" type="submit" class="btn btn-secondary float-right mb-4">
                  Masuk
                </button>
              </form> 
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection