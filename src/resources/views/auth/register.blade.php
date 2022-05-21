@extends('layouts.auth.app')

@section('content')

<section class="login_box_area section_gap">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="login_box_img">
                    <img class="img-fluid" src="/img/login.jpg" alt="">
                    <div class="hover">
                        <h4>You have Account ?</h4>
                        <p>If you loggined ago click her To login</p>
                        <a class="primary-btn" href="{{route('login')}}">Log in</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="login_form_inner">
                    <h3>Sign Up</h3>
                    <form class="row login_form" action="{{ route('register') }}" method="post" id="contactForm" novalidate="novalidate">
                        @csrf
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Username" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                             @enderror
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                            @enderror
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control @error('number') is-invalid @enderror" id="number" name="number" placeholder="Number" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Number'">
                            @error('number')
                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                            @enderror
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                            @enderror
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Password Confirmation" onfocus="this.placeholder = ''" onblur="this.placeholder = 'password_confirmation'">
                            @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-12 form-group">
                            <button type="submit" value="submit" class="primary-btn">Sign up</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
