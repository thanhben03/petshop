@extends('layout.client.master')
@section('content')
    <main>
        <article class="wrap-login">
            <h1 class="login-title">Xác nhận địa chỉ thanh toán</h1>
            <section class="login">
                    @csrf
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="fullname" class="col-form-label">Full Name:</label>
                            <input type="text" class="form-control" name="fullname" value="{{ $address_payment->fullname }}" id="fullname">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Phone Number:</label>
                            <input type="number" class="form-control" name="phone" value="{{ $address_payment->phone }}" id="phone">

                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-12">
                            <label for="message-text" class="col-form-label">Address:</label>
                            <input type="text" class="form-control" placeholder="Ex: An Thạnh Trung, Chợ Mới, An Giang"
                                name="address" value="{{ $address_payment->address }}" id="address">

                        </div>
                    </div>
                    <div class="login__account-btn">
                        <button type="submit" class="btn-save-address ">Xác Nhận</button>
                        {{-- <div class="login__box-register">
                            <p>DON'T HAVE AN ACCOUNT ?</p>
                            <a href="register.html">Register Now --&gt;</a>
                        </div> --}}
                    </div>


            </section>
        </article>
    </main>
@endsection
@push('js')
    <script>
        $(".btn-save-address").on('click', function() {
            $.ajax({
                type: "POST",
                url: "{{ route('addAddress') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    fullname: $("#fullname").val(),
                    phone: $("#phone").val(),
                    address: $("#address").val(),
                },
                dataType: "json",
                success: function(response) {
                    if (response.status == 'success') {
                        toastr.success(response.msg, 'success!');
                    }
                }
            });
        })
    </script>
@endpush
