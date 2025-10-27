@extends('layouts.user')

@section('css')
<style>
    body {
        background: #0f0e17;
    }

    .btn-purple {
        background: #ff8906;
        width: 100%;
        color: #fff;
    }

</style>
@endsection

@section('title', 'Halaman Daftar')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <h2 class="text-center text-white mb-0 mt-5">COCOMP</h2>
            <P class="text-center text-white mb-5">Community Complaints</P>
            <div class="card mt-5">
                <div class="card-body">
                    <h2 class="text-center mb-5">FORM REGISTER</h2>
                    <form action="{{ route('pekat.register') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="number" name="nik" placeholder="ID Number" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" name="nama" placeholder="Full Name" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" name="username" placeholder="Username" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" placeholder="Password" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="number" name="telp" placeholder="Phone Number" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-purple">REGISTER</button>
                    </form>
                </div>
            </div>
            @if (Session::has('pesan'))
            <div class="alert alert-danger mt-2">
                {{ Session::get('pesan') }}
            </div>
            @endif
            <a href="{{ route('pekat.index') }}" class="btn btn-warning text-white mt-3" style="width: 100%">Return to the Main Page</a>
        </div>
    </div>
</div>
@endsection
