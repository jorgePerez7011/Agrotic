@extends('layouts.app')
@section('title', 'Listado de implementos')

@section('content')

    <style>
        body {
            background: linear-gradient(to bottom right, #D9F99D, #F0FDF4);
        }

        .card {
            border-radius: 1rem;
            box-shadow: 0 10px 20px rgba(0, 128, 0, 0.1);
        }

        .card-header {
            background: linear-gradient(to right, #2E7D32, #4CAF50, #AEEA00);
            color: white;
            font-weight: bold;
        }

        .btn-primary {
            background-color: #4CAF50;
            border-color: #2E7D32;
            color: white;
        }

        .btn-primary:hover {
            background-color: #388E3C;
        }

        .btn-info {
            background-color: #7CB342;
            border-color: #558B2F;
            color: white;
        }

        .btn-info:hover {
            background-color: #689F38;
        }

        .btn-danger {
            background-color: #F9A825;
            border-color: #F57F17;
            color: white;
        }

        .btn-danger:hover {
            background-color: #F57F17;
        }

        .table th {
            background-color: #A5D6A7;
            color: #1B5E20;
        }

        /* Pagination Styles */
        .pagination {
            margin: 20px 0;
        }

        .page-item.active .page-link {              
            background-color: #4CAF50;
            border-color: #2E7D32;
        }

        .page-link {
            color: #2E7D32;
        }

        .page-link:hover {
            color: #1B5E20;
            background-color: #E8F5E9;
            border-color: #2E7D32;
        }

        .page-item.disabled .page-link {
            color: #9E9E9E;
        }
    </style>

    @push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.bootstrap4.min.css">
    <style>
        /* Estilos para DataTables */
        .dataTables_wrapper .dataTables_filter input {
            border: 2px solid #4CAF50;
            border-radius: 4px;
            padding: 6px 12px;
        }

        .dataTables_wrapper .dataTables_length select {
            border: 2px solid #4CAF50;
            border-radius: 4px;
        }

        .dataTables_info {
            color: #2E7D32 !important;
        }

        /* Estilos para los botones de paginación */
        .page-item .page-link {
            padding: 0.5rem 1rem;
            margin: 0 3px;
            border-radius: 5px;
            border: 2px solid #4CAF50;
            color: #2E7D32;
            background-color: white;
            font-weight: 500;
        }

        .page-item.active .page-link {
            background-color: #4CAF50;
            border-color: #2E7D32;
            color: white;
        }

        .page-item.disabled .page-link {
            border-color: #A5D6A7;
            color: #A5D6A7;
        }

        .dataTables_paginate {
            margin-top: 20px !important;
            padding-top: 20px !important;
        }

        .dataTables_wrapper .row:last-child {
            border-top: 1px solid #dee2e6;
            padding-top: 15px;
            margin-top: 15px;
        }
    </style>
    @endpush

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    @include('layouts.partial.msg')
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-title">@yield('title')</h3>
                                <div>
                                    <a href="{{ route('products.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus nav-icon"></i>
                                    </a>
                                    <a href="{{ route('evidencias.index') }}" class="btn btn-success ml-2">
                                        <i class="fas fa-map-marked-alt"></i> Evidencias de Terreno
                                    </a>
                                </div>
                            </div>

                          

                                <div class="table-responsive">
                                    <table id="products-table" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nombre</th>
                                                <th>Descripcion</th>
                                                <th>Imagen</th>
                                                <th>Precio</th>
                                                <th>Cantidad</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($products as $product)
                                                <tr>
                                                    <td>{{ $product->id }}</td>
                                                    <td>{{ $product->name }}</td>
                                                    <td>{{ $product->description }}</td>
                                                    <td>
                                                        @if ($product->image)
                                                            <center>
                                                                    @if (filter_var($product->image, FILTER_VALIDATE_URL))
                                                                    <img class="img-thumbnail"
                                                                        src="{{ $product->image }}"
                                                                        style="max-width: 100px; height: auto;" 
                                                                        alt="{{ $product->name }}"
                                                                        onerror="this.src='{{ secure_asset('backend/dist/img/no-image.png') }}'; this.onerror=null;">
                                                                @else
                                                                    <img class="img-thumbnail"
                                                                        src="{{ secure_asset('uploads/products/' . $product->image) }}"
                                                                        style="max-width: 100px; height: auto;" 
                                                                        alt="{{ $product->name }}"
                                                                        onerror="this.src='{{ secure_asset('backend/dist/img/no-image.png') }}'; this.onerror=null;">
                                                                @endif
                                                            </center>
                                                        @else
                                                            <center>
                                                                <img class="img-thumbnail"
                                                                    src="{{ secure_asset('backend/dist/img/no-image.png') }}"
                                                                    style="max-width: 100px; height: auto;" 
                                                                    alt="Sin imagen">
                                                            </center>
                                                        @endif
                                                    </td>
                                                    <td>{{ $product->price }}</td>
                                                    <td>{{ $product->quantity }}</td>
                                                    <td>
                                                        <input data-id="{{ $product->id }}" class="toggle-class"
                                                            type="checkbox" data-onstyle="success" data-offstyle="danger"
                                                            data-toggle="toggle" data-on="Activo" data-off="Inactivo"
                                                            {{ $product->status ? 'checked' : '' }}>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('products.edit', $product->id) }}"
                                                            class="btn btn-info btn-sm" title="Editar">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </a>
                                                        <form class="d-inline delete-form"
                                                            action="{{ route('products.destroy', $product) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                title="Eliminar">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap4.min.js"></script>
    <script type="text/javascript">
        $(function() {
            $("#products-table").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "pageLength": 10, // Cambiamos a 10 registros por página por defecto
                "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Todos"]], // Opciones de registros por página
                "language": {
                    "lengthMenu": "Mostrar _MENU_ registros por página",
                    "zeroRecords": "No se encontraron resultados",
                    "info": "Mostrando página _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay registros disponibles",
                    "infoFiltered": "(filtrado de _MAX_ registros totales)",
                    "search": "Buscar:",
                    "paginate": {
                        "first": "<i class='fas fa-angle-double-left'></i> Primero",
                        "last": "Último <i class='fas fa-angle-double-right'></i>",
                        "next": "Siguiente <i class='fas fa-angle-right'></i>",
                        "previous": "<i class='fas fa-angle-left'></i> Anterior"
                    }
                },
                "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                      "<'row'<'col-sm-12'tr>>" +
                      "<'row align-items-center'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                "paging": true, // Habilitamos la paginación
                "drawCallback": function(settings) {
                    if (settings._iRecordsTotal === 0) {
                        $('.dataTables_info').html('No se encontraron registros');
                    }
                }
            });

            $('.toggle-class').change(function() {
                var estado = $(this).prop('checked') ? 1 : 0;
                var arl_id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: 'changeproducturl',
                    data: {
                        'status': estado,
                        'product_id': arl_id
                    },
                    success: function(data) {
                        console.log(data.success)
                    }
                });
            });

            $('.delete-form').submit(function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Estas seguro?',
                    text: "Este registro se eliminara definitivamente",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#2E7D32',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                })
            });
        });

        @if (session('eliminar') == 'ok')
            Swal.fire(
                'Eliminado',
                'El registro ha sido eliminado exitosamente',
                'success'
            )
        @endif
    </script>
@endpush
