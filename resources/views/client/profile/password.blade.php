@extends('layout.client.master')
@section('content')
    <main>
        <article class="wrap-login">
            <h1 class="login-title">Change Password</h1>
            <section class="login">
                <form action="{{ route('changePassword') }}" method="POST">
                    @csrf
                    @if (session()->has('msg'))
                        <div class="alert alert-success">
                            {{ session()->get('msg') }}
                        </div>
                    @endif
                    @if (session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session()->get('error') }}
                        </div>
                    @endif
                    <div class="login__account">
                        <div class="login__wrap-input">
                            <input type="text" value="{{old('current_psw')}}" placeholder="Mật khẩu hiện tại" name="current_psw"
                                class="login__input login-email">
                        </div>
                        <div class="login__wrap-input">
                            <input type="text" placeholder="Mật khẩu mới" name="new_psw"
                                class="login__input login-email">
                        </div>
                        <div class="login__wrap-input">
                            <input type="text" placeholder="Nhập lại mật khẩu mới " name="re_newpsw"
                                class="login__input login-password">
                        </div>
                        @if (session()->has('error2'))
                            <div class="alert alert-danger">
                                {{ session()->get('error2') }}
                            </div>
                        @endif
                    </div>
                    <div class="login__account-btn">
                        <button type="submit" class="btn-login">Thay Đổi</button>
                        {{-- <div class="login__box-register">
                            <p>DON'T HAVE AN ACCOUNT ?</p>
                            <a href="register.html">Register Now --&gt;</a>
                        </div> --}}
                    </div>
                </form>


            </section>
        </article>
    </main>
@endsection
