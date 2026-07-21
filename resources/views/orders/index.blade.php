@extends('layouts.app')
@section('title', 'List of loans')

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
        }

        .btn-primary:hover {
            background-color: #388E3C;
        }

        .table th {
            background-color: #A5D6A7;
            color: #1B5E20;
        }

        .table-hover tbody tr:hover {
            background-color: #E8F5E9;
        }

        .toggle-class {
            /* Style for the toggle button */
            background-color: #4CAF50;
            border-color: #2E7D32;
        }
    </style>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="background: linear-gradient(to bottom right, #e0f2e9, #d9e4cf, #e6f7f1);">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">

                    @include('layouts.partial.msg')

                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card" style="background-color: #f5fff8; border: 1px solid #cce3d2;">
                            <div class="card-header">
                                <h3 class="card-title text-lg">@yield('title')</h3>

                                <a href="{{ route('orders.create') }}" class="btn btn-primary float-right"><i
                                        class="fas fa-plus nav-icon"></i></a>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-hover">
                                    <thead class="text-primary">
                                        <tr>
                                            <th>ID</th>
                                            <th>User Name</th>
                                            <th>User Document</th>
                                            <th>Date</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>{{ $order->id }}</td>
                                                <td>{{ $order->client->name }}</td>
                                                <td>{{ $order->client->document }}</td>
                                                <td>{{ $order->date_order }}</td>
                                                <td>${{ $order->total }}</td>

                                                <td>
                                                    <input data-id="{{ $order->id }}" class="toggle-class"
                                                        type="checkbox" data-onstyle="success" data-offstyle="danger"
                                                        data-toggle="toggle" data-on="Activo" data-off="Inactivo"
                                                        {{ $order->status ? 'checked' : '' }}>
                                                </td>

                                                <td>
                                                    <a href="{{ route('orders.show', $order) }}"
                                                        class="btn btn-primary btn-sm" title="View bill">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </a>
                                                    <a href="{{ $order->route }}" class="btn btn-primary btn-sm"
                                                        title="Download bill">
                                                        <i class="fa-solid fa-file-pdf"></i>
                                                    </a>
                                                    <form class="d-inline delete-form"
                                                        action="{{ route('orders.destroy', $order) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class=" btn btn-danger btn-sm"
                                                            title="Delete">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->


                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                //"buttons": ["excel", "pdf", "print", "colvis"],
                "language": {
                    
                    "sEmptyTable": "No hay datos disponibles en la tabla",
                   
                    "sInfoEmpty": "Mostrando 0 a 0 de 0 entradas",
                    "sSearch": "Buscar:",
                    "sZeroRecords": "No se encontraron registros coincidentes en la tabla",
                    "sInfoFiltered": "(Filtrado de MAX entradas totales)",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sPrevious": "Anterior",
                        "sNext": "Siguiente",
                        "sLast": "Ultimo"
                    },
                    /*"buttons": {
                    	"print": "Imprimir",
                    	"colvis": "Visibilidad Columnas"
                    	/*"create": "Nuevo",
                    	"edit": "Cambiar",
                    	"remove": "Borrar",
                    	"copy": "Copiar",
                    	"csv": "fichero CSV",
                    	"excel": "tabla Excel",
                    	"pdf": "documento PDF",
                    	"collection": "Colección",
                    	"upload": "Seleccione fichero...."
                    }*/
                }
            }); //.buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>

    <script>
        $(document).ready(function() {
            $("example1").DataTable()
        });
        $(function() {
            $('.toggle-class').change(function() {
                var estado = $(this).prop('checked') == true ? 1 : 0;
                var arl_id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: 'changeorderurl',
                    data: {
                        'status': estado,
                        'order_id': arl_id
                    },
                    success: function(data) {
                        console.log(data.success)
                    }
                });
            })
        })
    </script>

    <script>
        $('.delete-form').submit(function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Estas seguro?',
                text: "Este registro se eliminara definitivamente",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            })
        });
    </script>

    @if (session('eliminar') == 'ok')
        <script>
            Swal.fire(
                'Eliminado',
                'El registro ha sido eliminado exitosamente',
                'success'
            )
        </script>
    @endif


@endpush
