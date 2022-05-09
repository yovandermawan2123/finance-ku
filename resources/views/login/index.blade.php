@extends('layouts.main')

@section('container')

<div class="row justify-content-center">
    <div class="col-md-5">
     @if (session()->has('success'))
         
  
      <div class="alert alert-primary alert-dismissible fade show" role="alert">
     {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif

      @if (session()->has('loginError'))
         
  
      <div class="alert alert-danger  alert-dismissible fade show" role="alert">
     {{ session('loginError') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif
        <main class="form-signin mt-5">
            <h1 class="h3 mb-3 fw-normal text-center">Login</h1>
            <form action="/" method="POST">
              @csrf

              {{-- <img class="mb-4" src="../assets/brand/bootstrap-logo.svg" alt="" width="72" height="57"> --}}
          
              <div class="form-floating">
                <input type="email" name="email" class="form-control @error('email')is-invalid @enderror " id="email" placeholder="name@example.com" autofocus required value="{{ old('email') }}">
                <label for="email">Email address</label>

                @error('email')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
              <div class="form-floating">
                <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                <label for="password">Password</label>
              </div>
          
            
              <button class="w-100 btn btn-lg text-white btn-success" type="submit">Login</button>
              <small class="d-block text-center mt-3">Not Registered? <a href="/register" class="text-success ">Register Now</a></small>
            </form>
          </main>
    </div>
</div>


@endsection