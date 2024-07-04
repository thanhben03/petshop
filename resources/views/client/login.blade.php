@extends('layout.client.master')
@section('content')
    <main>
        <article class="wrap-login">
            <h1 class="login-title">Đăng nhập hệ thống!</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $err)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session()->has('msg'))
                <div class="alert alert-danger">
                    {{ session()->get('msg') }}
                </div>
            @endif
            <section class="login">
                <form action="{{ route('processLogin') }}" method="POST">
                    @csrf
                    <div class="login__account">
                        <div class="login__wrap-input">
                            <input type="text" placeholder="username" 
                            name="username"
                            class="login__input login-email">
                        </div>
                        <div class="login__wrap-input">
                            <input type="text" placeholder="Password" 
                            name="password"
                            class="login__input login-password">
                        </div>
                        <a href="#">Forgot your password?</a>
                    </div>
                    <div class="login__account-btn">
                        <button type="submit" class="btn-login">LOG IN</button>
                        <div class="login__box-register">
                            <p>DON'T HAVE AN ACCOUNT ?</p>
                            <a href="{{ route('register') }}">Register Now --&gt;</a>
                        </div>
                    </div>
                </form>


            </section>
        </article>
    </main>
@endsection
