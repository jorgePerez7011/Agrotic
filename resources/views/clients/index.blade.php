@extends('layouts.app')

@section('title', 'Listado de Usuarios')

@section('content')
    <div class="content-wrapper" style="background: linear-gradient(to bottom right, #e0f2e9, #d9e4cf, #e6f7f1);">
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
                        <div class="card" style="background-color: #f5fff8; border: 1px solid #cce3d2;">
                            <div class="card-header" style="background-color: #b8e994;">
                                <h3 class="text-success">@yield('title')</h3>
                                <a href="{{ route('clients.create') }}" class="btn btn-success float-right">
                                    <i class="fas fa-plus nav-icon"></i> 
                                </a>
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-hover">
                                    <thead class="text-success" style="background-color: #dff5e3;">
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Documento</th>
                                            <th>Foto</th>
                                            <th>Dirección</th>
                                            <th>Ciudad</th>
                                            <th>Teléfono</th>
                                            <th>Email</th>
                                            <th>Estado</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($clients as $client)
                                            <tr>
                                                <td>{{ $client->id }}</td>
                                                <td>{{ $client->name }}</td>
                                                <td>{{ $client->document }}</td>
                                                <td>
                                                    @if ($client->photo)
                                                        <center>
                                                            <img class="img-thumbnail" src="{{ asset('uploads/clients/' . $client->photo) }}" style="height: 70px; width: 70px;" alt="Foto">
                                                        </center>
                                                    @else
                                                        <span class="text-muted">Sin foto</span>
                                                    @endif
                                                </td>
                                                <td>{{ $client->address }}</td>
                                                <td>{{ $client->city }}</td>
                                                <td>{{ $client->phone }}</td>
                                                <td>{{ $client->email }}</td>
                                                <td>
                                                    <input data-id="{{ $client->id }}" class="toggle-class" type="checkbox"
                                                        data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                                        data-on="Activo" data-off="Inactivo"
                                                        {{ $client->status ? 'checked' : '' }}>
                                                </td>
                                                <td>
                                                    <a href="{{ route('clients.edit', $client->id) }}"
                                                        class="btn btn-outline-success btn-sm" title="Editar">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    <form class="d-inline delete-form"
                                                        action="{{ route('clients.destroy', $client) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger btn-sm" title="Eliminar">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div> <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(function () {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "language": {
                    "sLengthMenu": "Mostrar _MENU_ entradas",
                    "sEmptyTable": "No hay datos disponibles en la tabla",
                    "sInfo": "Mostrando _START_ a _END_ de _TOTAL_ entradas",
                    "sInfoEmpty": "Mostrando 0 a 0 de 0 entradas",
                    "sSearch": "Buscar:",
                    "sZeroRecords": "No se encontraron registros coincidentes en la tabla",
                    "sInfoFiltered": "(Filtrado de _MAX_ entradas totales)",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sPrevious": "Anterior",
                        "sNext": "Siguiente",
                        "sLast": "Último"
                    }
                }
            });
        });

        $(function () {
            $('.toggle-class').change(function () {
                var estado = $(this).prop('checked') ? 1 : 0;
                var arl_id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: 'changeclienturl',
                    data: {
                        'status': estado,
                        'client_id': arl_id
                    },
                    success: function (data) {
                        console.log(data.success)
                    }
                });
            });
        });

        $('.delete-form').submit(function (e) {
            e.preventDefault();
            Swal.fire({
                title: '¿Estás seguro?',
                text: "Este registro se eliminará definitivamente.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#4CAF50',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    </script>

    @if (session('eliminar') == 'ok')
        <script>
            Swal.fire(
                'Eliminado',
                'El registro ha sido eliminado exitosamente.',
                'success'
            );
        </script>
    @endif
@endpush
