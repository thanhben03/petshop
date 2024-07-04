@extends('layout.client.master')
@section('content')
    <main>
        <article class="wrap-register">
            <h1 class="register-title">Đăng ký thành viên!</h1>
            <section class="login">
                @if (session()->has('msg'))
                    <div class="alert alert-success">
                        {{ session()->get('msg') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                @endif
                </div>
                <form action="{{ route('processRegister') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="login__wrap-input col-lg-6">
                            <input type="text" placeholder="Full Name" name="fullname"
                                class="login__input register__input">
                        </div>
                        <div class="login__wrap-input col-lg-6">
                            <input type="text" placeholder="Address" name="address" class="login__input register__input">
                        </div>

                    </div>
                    <div class="row">
                        <div class="login__wrap-input col-lg-6">
                            <input type="text" placeholder="Email" name="email" class="login__input register__input">
                        </div>
                        <div class="login__wrap-input col-lg-6">
                            <input type="text" placeholder="Username" name="username"
                                class="login__input register__input">
                        </div>
                    </div>
                    <div class="row">
                        <div class="login__wrap-input col-lg-6">
                            <input type="password" placeholder="Password" name="password"
                                class="login__input register__input">
                        </div>
                        <div class="login__wrap-input col-lg-6">
                            <input type="password" placeholder="Re-Password" name="re-password"
                                class="login__input register__input">
                        </div>
                    </div>
                    <div class="register__account-btn">
                        <button type="submit" class="btn-login">LOG IN</button>
                        <div class="login__box-register">
                            <p>YOU HAVE AN ACCOUNT ?</p>
                            <a href="{{ route('login') }}">Login Now --&gt;</a>
                        </div>
                    </div>
                </form>


            </section>
        </article>
    </main>
@endsection
