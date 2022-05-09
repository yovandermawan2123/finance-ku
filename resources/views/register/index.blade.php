@extends('layouts.main')

@section('container')

<div class="row justify-content-center">
    <div class="col-lg-5">
        <main class="form-registration mt-5">
            <h1 class="h3 mb-3 fw-normal text-center">Registration Form</h1>
            <form action="/register" method="POST">
              @csrf
              {{-- <img class="mb-4" src="../assets/brand/bootstrap-logo.svg" alt="" width="72" height="57"> --}}
              <div class="form-floating">
                <input type="text" name="name" class="form-control rounded-top @error('name')is-invalid @enderror" id="name" placeholder="Name" value="{{ old('name') }}" required>
                <label for="name">Nama</label>
                @error('name')
                <div class="invalid-feedback">
                 {{ $message }}
                </div>
                @enderror
              </div>
               
              <div class="form-floating">
                <input type="email" name="email" class="form-control @error('email')is-invalid @enderror" id="email" placeholder="Email" value="{{ old('email') }}" required>
                <label for="email">Email address</label>
                @error('email')
                <div class="invalid-feedback">
                  {{ $message }}
                 </div>
                 @enderror
              </div>
              <div class="form-floating">
                <input type="password" name="password" class="form-control  rounded-bottom @error('password')is-invalid @enderror" id="password" placeholder="Password" required>
                <label for="password">Password</label>
                @error('password')
                <div class="invalid-feedback">
                  {{ $message }}
                 </div>
                 @enderror
              </div>
          
            
              <button class="w-100 btn btn-lg text-white btn-success mt-4" type="submit">Register</button>
              <small class="d-block text-center mt-3">Already Registered? <a href="/" class="text-success">login</a></small>
            </form>
          </main>
    </div>
</div>


@endsection