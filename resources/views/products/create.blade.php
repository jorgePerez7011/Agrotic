@extends('layouts.app')

@section('title', 'Crear Implementos')

@section('content')

    <style>
        body {
            background: linear-gradient(to bottom right, #D9F99D, #F0FDF4); /* fondo similar al del layout principal */
        }

        .card-header {
            background: linear-gradient(to right, #2E7D32, #4CAF50, #AEEA00); /* verde oscuro a lima */
            color: white;
            font-weight: bold;
        }

        .btn-primary {
            background-color: #4CAF50; /* Verde pasto */
            border-color: #2E7D32;
            color: white;
        }

        .btn-primary:hover {
            background-color: #388E3C;
        }

        .btn-danger {
            background-color: #F9A825; /* Amarillo maíz */
            border-color: #F57F17;
            color: white;
        }

        .btn-danger:hover {
            background-color: #F57F17;
        }

        .form-control,
        .form-control-file {
            border: 1px solid #A5D6A7;
            background-color: #F1F8E9;
        }

        label.control-label {
            color: #2E7D32;
            font-weight: bold;
        }

        .card {
            border-radius: 1rem;
            box-shadow: 0 10px 20px rgba(0, 128, 0, 0.1);
        }

        .card-footer {
            background-color: transparent;
            border-top: none;
        }
    </style>

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
            </div>
        </section>
        @include('layouts.partial.msg')
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="card">
                            <div class="card-header">
                                <h3>@yield('title')</h3>
                            </div>
                            <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <!-- Nombre -->
                                    <div class="form-group">
                                        <label class="control-label">Nombre <strong style="color:red;">(*)</strong></label>
                                        <input type="text" class="form-control" name="name"
                                            placeholder="Ingrese el nombre del producto" autocomplete="off"
                                            value="{{ old('name') }}">
                                    </div>

                                    <!-- Descripción -->
                                    <div class="form-group">
                                        <label class="control-label">Descripcion <strong style="color:red;">(*)</strong></label>
                                        <textarea class="form-control" name="description" placeholder="Ingrese la descripcion del producto" cols="120" rows="4"></textarea>
                                    </div>

                                    <!-- Cantidad -->
                                    <div class="form-group">
                                        <label class="control-label">Cantidad <strong style="color:red;">(*)</strong></label>
                                        <input type="text" class="form-control" name="quantity"
                                            placeholder="Ingrese la cantidad del producto" autocomplete="off"
                                            value="{{ old('quantity') }}">
                                    </div>

                                    <!-- Precio -->
                                    <div class="form-group">
                                        <label class="control-label">Precio <strong style="color:red;">(*)</strong></label>
                                        <input type="text" class="form-control" name="price"
                                            placeholder="Ingrese el precio del producto" autocomplete="off"
                                            value="{{ old('price') }}">
                                    </div>

                                    <!-- Imagen del Producto -->
                                    <div class="form-group">
                                        <label class="control-label">Imagen del Producto</label>
                                        <div class="border p-3 rounded" style="background-color: #F1F8E9;">
                                            <div class="mb-3">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="uploadType1" name="upload_type" value="file" class="custom-control-input" checked>
                                                    <label class="custom-control-label" for="uploadType1">Subir imagen desde mi PC</label>
                                                </div>
                                                <div class="mt-2 upload-file-section">
                                                    <input type="file" class="form-control-file" name="image_file" id="image_file" accept="image/*">
                                                    <small class="form-text text-muted">Formatos permitidos: JPG, PNG, GIF. Tamaño máximo: 2MB</small>
                                                </div>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="uploadType2" name="upload_type" value="url" class="custom-control-input">
                                                    <label class="custom-control-label" for="uploadType2">Usar URL de imagen</label>
                                                </div>
                                                <div class="mt-2 upload-url-section" style="display: none;">
                                                    <input type="url" class="form-control" name="image_url" id="image_url" 
                                                           placeholder="https://ejemplo.com/imagen.jpg">
                                                    <small class="form-text text-muted">Ingresa la URL directa de la imagen</small>
                                                </div>
                                            </div>

                                            <!-- Vista previa de la imagen -->
                                            <div class="mt-3">
                                                <label>Vista previa:</label>
                                                <div id="image-preview" class="mt-2 text-center">
                                                    <img src="" alt="Vista previa" style="max-width: 200px; max-height: 200px; display: none;">
                                                    <p class="text-muted mb-0">No se ha seleccionado ninguna imagen</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Hidden fields -->
                                    <input type="hidden" class="form-control" name="status" value="1">
                                    <input type="hidden" class="form-control" name="registered_by" value="{{ Auth::user()->id }}">
                                </div>

                                <!-- Botones -->
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-lg-3 col-xs-6 mb-2">
                                            <button type="submit" class="btn btn-primary btn-block btn-flat">Registrar</button>
                                        </div>
                                        <div class="col-lg-3 col-xs-6 mb-2">
                                            <a href="{{ route('products.index') }}" class="btn btn-danger btn-block btn-flat">Volver</a>
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

@push('scripts')
<script>
    $(document).ready(function() {
        // Manejar el cambio entre tipo de carga
        $('input[name="upload_type"]').change(function() {
            const selectedType = $(this).val();
            if (selectedType === 'file') {
                $('.upload-file-section').show();
                $('.upload-url-section').hide();
                $('#image_url').val(''); // Limpiar URL
            } else {
                $('.upload-file-section').hide();
                $('.upload-url-section').show();
                $('#image_file').val(''); // Limpiar archivo
            }
            updatePreview();
        });

        // Vista previa para archivo
        $('#image_file').change(function() {
            const file = this.files[0];
            if (file) {
                if (file.size > 2 * 1024 * 1024) { // 2MB en bytes
                    Swal.fire({
                        icon: 'error',
                        title: 'Archivo muy grande',
                        text: 'La imagen no debe superar los 2MB',
                        confirmButtonColor: '#4CAF50'
                    });
                    this.value = '';
                    updatePreview();
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    updatePreview(e.target.result);
                };
                reader.readAsDataURL(file);
            } else {
                updatePreview();
            }
        });

        // Vista previa para URL
        $('#image_url').on('input', function() {
            const url = $(this).val();
            if (url) {
                updatePreview(url);
            } else {
                updatePreview();
            }
        });

        // Función para actualizar la vista previa
        function updatePreview(src = '') {
            const previewImg = $('#image-preview img');
            const previewText = $('#image-preview p');
            
            if (src) {
                previewImg.attr('src', src).show();
                previewText.hide();
            } else {
                previewImg.hide();
                previewText.show();
            }
        }

        // Validar URL cuando se pega
        $('#image_url').on('paste', function(e) {
            setTimeout(() => {
                const url = $(this).val();
                if (url && !isValidImageUrl(url)) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'URL inválida',
                        text: 'Por favor, ingresa una URL válida de imagen (jpg, png, gif)',
                        confirmButtonColor: '#4CAF50'
                    });
                }
            }, 100);
        });

        // Validar formato de URL de imagen
        function isValidImageUrl(url) {
            return url.match(/\.(jpeg|jpg|gif|png)$/i) != null;
        }
    });
</script>
@endpush
