@extends('layouts.app')

@section('title', 'Editar Implemento')

@section('content')
    <div class="content-wrapper" style="background: linear-gradient(to bottom right, #e0f2e9, #e3f5dc, #f1fff2);">
        <section class="content-header">
            <div class="container-fluid"></div>
        </section>

        @include('layouts.partial.msg')

        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="card" style="background-color: #f8fff5; border: 1px solid #cde7c8;">
                            <div class="card-header" style="background-color: #b8e994;">
                                <h3 class="text-success m-0">@yield('title')</h3>
                            </div>

                            <form method="POST" action="{{ route('products.update', $product) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body">

                                    {{-- Nombre --}}
                                    <div class="form-group">
                                        <label>Nombre <strong style="color:red;">(*)</strong></label>
                                        <input type="text" class="form-control" name="name"
                                            placeholder="Nombre del producto"
                                            value="{{ $product->name }}">
                                    </div>

                                    {{-- Descripción --}}
                                    <div class="form-group">
                                        <label>Descripción <strong style="color:red;">(*)</strong></label>
                                        <input type="text" class="form-control" name="description"
                                            placeholder="Breve descripción"
                                            value="{{ $product->description }}">
                                    </div>

                                    {{-- Precio --}}
                                    <div class="form-group">
                                        <label>Precio <strong style="color:red;">(*)</strong></label>
                                        <input type="number" step="0.01" class="form-control" name="price"
                                            placeholder="Ej: 9.99"
                                            value="{{ $product->price }}">
                                    </div>

                                    {{-- Cantidad --}}
                                    <div class="form-group">
                                        <label>Cantidad <strong style="color:red;">(*)</strong></label>
                                        <input type="number" class="form-control" name="quantity"
                                            placeholder="Unidades disponibles"
                                            value="{{ $product->quantity }}">
                                    </div>

                                    {{-- Imagen --}}
                                    <div class="form-group">
                                        <label>Imagen</label>
                                        <input type="file" class="form-control-file" name="image" id="image">
                                    </div>

                                </div>

                                <div class="card-footer" style="background-color: #ecf9e6;">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                            <button type="submit" class="btn btn-success btn-block">
                                                <i class="fas fa-save"></i> Guardar
                                            </button>
                                        </div>
                                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
                                            <a href="{{ route('products.index') }}" class="btn btn-outline-danger btn-block">
                                                <i class="fas fa-arrow-left"></i> Atrás
                                            </a>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div> <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
