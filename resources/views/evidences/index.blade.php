@extends('layouts.app')

@section('title', 'Evidence List')

@section('content')
    <!-- Google Maps Modal -->
    <div class="modal fade" id="locationModal" tabindex="-1" role="dialog" aria-labelledby="locationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background: linear-gradient(to right, #2E7D32, #4CAF50);">
                    <h5 class="modal-title text-white" id="locationModalLabel">Location Details</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="map" style="height: 400px; width: 100%;"></div>
                </div>
            </div>
        </div>
    </div>

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
            background-color: #4CAF50 !important;
            border-color: #2E7D32 !important;
        }

        .btn-primary:hover {
            background-color: #388E3C !important;
        }

        .table th {
            background-color: #A5D6A7 !important;
            color: #1B5E20 !important;
        }

        .table-hover tbody tr:hover {
            background-color: #E8F5E9;
        }

        .toggle-class {
            background-color: #4CAF50;
            border-color: #2E7D32;
        }
    </style>

    <div class="content-wrapper" style="background: linear-gradient(to bottom right, #e0f2e9, #d9e4cf, #e6f7f1);">
        <!-- Content Header -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="text-dark">Evidence List</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color: #2E7D32;">Home</a></li>
                            <li class="breadcrumb-item active">Evidence</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card" style="background-color: #f5fff8; border: 1px solid #cce3d2;">
                            <div class="card-header">
                                <h3 class="card-title text-lg">Evidence Records</h3>
                                <div class="card-tools">
                                    <a href="{{ route('evidences.create') }}" class="btn btn-primary float-right mr-2">
                                        <i class="fas fa-plus nav-icon"></i>
                                    </a>
                                    <a href="{{ route('evidencias.index') }}" class="btn btn-success float-right">
                                        <i class="fas fa-map-marked-alt"></i> Segmentación IA
                                    </a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="evidence-table" class="table table-bordered table-hover">
                                        <thead class="text-primary">
                                            <tr>
                                                <th>Date</th>
                                                <th>Photo</th>
                                                <th>Description</th>
                                                <th>Location</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($evidences as $evidence)
                                            <tr>
                                                <td>{{ $evidence->date->format('Y-m-d H:i:s') }}</td>
                                                <td>
                                                    <img src="{{ Storage::url($evidence->photo) }}" 
                                                         alt="Evidence Photo" 
                                                         class="img-thumbnail shadow-sm"
                                                         style="max-width: 100px; cursor: pointer"
                                                         onclick="window.open(this.src, '_blank')">
                                                </td>
                                                <td>{{ $evidence->description }}</td>                                                <td>
                                                    @if($evidence->location)
                                                        <a href="javascript:void(0);" 
                                                           class="text-decoration-none show-location" 
                                                           data-location="{{ $evidence->location }}"
                                                           style="color: #2E7D32;">
                                                            <i class="fas fa-map-marker-alt mr-1"></i>
                                                            {{ $evidence->location }}
                                                        </a>
                                                    @else
                                                        <span class="text-muted">N/A</span>
                                                    @endif
                                                </td>
                                                <td>                                                <button class="btn btn-sm status-toggle rounded-pill" 
                                                            style="{{ $evidence->status ? 'background-color: #4CAF50; color: white;' : 'background-color: #dc3545; color: white;' }}"
                                                            data-id="{{ $evidence->id }}">
                                                        <i class="fas fa-{{ $evidence->status ? 'check-circle' : 'times-circle' }} mr-1"></i>
                                                        {{ $evidence->status ? 'Active' : 'Inactive' }}
                                                    </button>
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="{{ route('evidences.edit', $evidence) }}" 
                                                           class="btn btn-primary btn-sm"
                                                           title="Edit Evidence">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('evidences.destroy', $evidence) }}" 
                                                              method="POST" 
                                                              class="d-inline delete-form">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger" title="Delete Evidence">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
<script>
    $(function() {
        $("#evidence-table").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "pageLength": 10,
            "language": {
                "lengthMenu": "Show _MENU_ entries per page",
                "zeroRecords": "No evidence found",
                "info": "Showing page _PAGE_ of _PAGES_",
                "infoEmpty": "No evidence available",
                "infoFiltered": "(filtered from _MAX_ total records)"
            },
            "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                  "<'row'<'col-sm-12'tr>>" +
                  "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            "buttons": [
                {
                    extend: 'collection',
                    text: '<i class="fas fa-download"></i> Export',
                    className: 'btn-success',
                    buttons: [
                        {
                            extend: 'copy',
                            className: 'btn-success'
                        },
                        {
                            extend: 'csv',
                            className: 'btn-success'
                        },
                        {
                            extend: 'excel',
                            className: 'btn-success'
                        },
                        {
                            extend: 'pdf',
                            className: 'btn-success'
                        },
                        {
                            extend: 'print',
                            className: 'btn-success'
                        }
                    ]
                },
                {
                    extend: 'colvis',
                    text: '<i class="fas fa-columns"></i> Columns',
                    className: 'btn-success'
                }
            ]
        }).buttons().container().appendTo('#evidence-table_wrapper .col-md-6:eq(0)');

        // Add hover effect to table rows
        $('#evidence-table tbody tr').hover(
            function() { $(this).addClass('table-success'); },
            function() { $(this).removeClass('table-success'); }
        );

        // Handle delete confirmation
        $('.delete-form').on('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: '¿Estás seguro?',
                text: "Esta evidencia se eliminará permanentemente",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#dc3545',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });

        // Handle status toggle with animation
        $('.status-toggle').on('click', function() {
            const $button = $(this);
            const id = $button.data('id');
            $button.prop('disabled', true);
            
            $.ajax({
                url: `/evidences/${id}/toggle-status`,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },                success: function(response) {
                    if (response.success) {
                        if (response.status) {
                            $button
                                .attr('style', 'background-color: #4CAF50; color: white;')
                                .html('<i class="fas fa-check-circle mr-1"></i>Active');
                        } else {
                            $button
                                .attr('style', 'background-color: #dc3545; color: white;')
                                .html('<i class="fas fa-times-circle mr-1"></i>Inactive');
                        }

                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Status updated successfully',
                            showConfirmButton: false,
                            timer: 1500,
                            background: '#28a745',
                            iconColor: '#ffffff',
                            customClass: {
                                title: 'text-white',
                                popup: 'bg-success'
                            }
                        });
                    }
                    $button.prop('disabled', false);
                },                error: function() {
                    if ($button.attr('style').includes('#4CAF50')) {
                        $button
                            .attr('style', 'background-color: #dc3545; color: white;')
                            .html('<i class="fas fa-times-circle mr-1"></i>Inactive');
                    } else {
                        $button
                            .attr('style', 'background-color: #4CAF50; color: white;')
                            .html('<i class="fas fa-check-circle mr-1"></i>Active');
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong updating the status!',
                        confirmButtonColor: '#28a745'
                    });
                    $button.prop('disabled', false);
                }
            });
        });

        // Add tooltips
        $('[title]').tooltip({
            placement: 'top',
            trigger: 'hover'
        });        // Initialize Google Maps Modal functionality
        let map;
        let marker;
        
        function initMap(latitude, longitude) {
            const location = { lat: latitude, lng: longitude };
            map = new google.maps.Map(document.getElementById("map"), {
                zoom: 15,
                center: location,
                styles: [
                    {
                        "featureType": "poi",
                        "elementType": "labels",
                        "stylers": [{ "visibility": "off" }]
                    }
                ]
            });
            
            marker = new google.maps.Marker({
                position: location,
                map: map,
                animation: google.maps.Animation.DROP,
                icon: {
                    path: google.maps.SymbolPath.CIRCLE,
                    scale: 10,
                    fillColor: "#4CAF50",
                    fillOpacity: 1,
                    strokeColor: "#2E7D32",
                    strokeWeight: 2,
                }
            });
        }

        // Handle location click
        $('.show-location').on('click', function() {
            const location = $(this).data('location');
            
            // Use the Geocoding service to convert the location string to coordinates
            const geocoder = new google.maps.Geocoder();
            geocoder.geocode({ address: location }, function(results, status) {
                if (status === 'OK') {
                    const latitude = results[0].geometry.location.lat();
                    const longitude = results[0].geometry.location.lng();
                    
                    // Initialize/update the map
                    $('#locationModal').on('shown.bs.modal', function () {
                        initMap(latitude, longitude);
                    });
                    
                    // Show the modal
                    $('#locationModal').modal('show');
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Location Error',
                        text: 'Could not find the location on the map.',
                        confirmButtonColor: '#4CAF50'
                    });
                }
            });
        });
    });
</script>

<!-- Google Maps JavaScript API -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDWTxatftrY7rPWW5LSVbJpTvmPYhlykpI" async defer></script>

<style>
    .table-success {
        --bs-table-bg: rgba(40, 167, 69, 0.1);
    }
    .swal2-popup.bg-success {
        border: none;
    }
    .status-toggle {
        transition: all 0.3s ease;
    }
    .status-toggle:disabled {
        opacity: 0.7;
        cursor: wait;
    }
    #evidence-table_wrapper .dt-buttons .btn-success {
        margin-right: 5px;
    }
    
    /* Map Modal Styles */
    #locationModal .modal-dialog {
        max-width: 800px;
    }
    
    #locationModal .modal-content {
        border: none;
        border-radius: 1rem;
        overflow: hidden;
    }
    
    #locationModal .close {
        opacity: 1;
    }
    
    #locationModal .close:hover {
        opacity: 0.75;
    }
    
    .show-location {
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .show-location:hover {
        opacity: 0.8;
        text-decoration: underline !important;
    }
</style>
@endpush
