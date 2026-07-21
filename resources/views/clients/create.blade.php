@extends('layouts.app')

@section('Add clients')

@section('content')

    <div class="content-wrapper" style="background: linear-gradient(to bottom right, #e0f2e9, #d9e4cf, #e6f7f1);">
        <section class="content-header">
            <div class="container-fluid">
            </div>
        </section>
        @include('layouts.partial.msg')
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card" style="background-color: #f5fff8; border: 1px solid #cce3d2;">
                            <div class="card-header" style="background-color: #b8e994;">
                                <h3 class="text-success">@yield('title')</h3>
                            </div>
                            <form method="POST" action="{{ route('clients.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Name<strong style="color:red;">(*)</strong></label>
                                                <input type="text" class="form-control" name="name"
                                                    placeholder="Enter the client name" autocomplete="off"
                                                    value="{{ old('nombre') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Document<strong style="color:red;">(*)</strong></label>
                                                <input type="text" class="form-control" name="document"
                                                    placeholder="Enter the client document" autocomplete="off"
                                                    value="{{ old('document') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Photo</label>
                                                <input type="file" class="form-control-file" name="photo" id="photo">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Address<strong style="color:red;">(*)</strong></label>
                                                <textarea class="form-control" name="address" placeholder="Enter the client address" cols="120" rows="4"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group label-floating">
                                                <label class="control-label">City<strong style="color:red;">(*)</strong></label>
                                                <input type="text" class="form-control" name="city"
                                                    placeholder="Enter the client city" autocomplete="off"
                                                    value="{{ old('nombre') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Phone<strong style="color:red;">(*)</strong></label>
                                                <input type="text" class="form-control" name="phone"
                                                    placeholder="Enter the client phone" autocomplete="off"
                                                    value="{{ old('nombre') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Email<strong style="color:red;">(*)</strong></label>
                                                <input type="text" class="form-control" name="email"
                                                    placeholder="Enter the client email" autocomplete="off"
                                                    value="{{ old('nombre') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" class="form-control" name="status" value="1">
                                    <input type="hidden" class="form-control" name="registered_by" value="{{ Auth::user()->id }}">
                                </div>

                                <div class="card-footer" style="background-color: #d9e4cf;">
                                    <div class="row">
                                        <div class="col-lg-2 col-xs-4">
                                            <button type="submit" class="btn btn-success btn-block btn-flat">Register</button>
                                        </div>
                                        <div class="col-lg-2 col-xs-4">
                                            <a href="{{ route('clients.index') }}" class="btn btn-secondary btn-block btn-flat">Back</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
