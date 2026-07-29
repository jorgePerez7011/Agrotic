@extends('layouts.app')

@section('title', 'Edit Evidence')

@section('content')
<div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Evidence</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('evidences.index') }}">Evidence List</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit Evidence Details</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{ route('evidences.update', $evidence) }}"
                                  method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="photo">Photo</label>
                                    <input type="file" 
                                           class="form-control @error('photo') is-invalid @enderror" 
                                           id="photo" 
                                           name="photo" 
                                           accept="image/*">
                                    @error('photo')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    @if($evidence->photo)
                                        <div class="mt-2">
                                            <img src="{{ Storage::url($evidence->photo) }}" 
                                                 alt="Current Evidence Photo" 
                                                 class="img-thumbnail"
                                                 style="max-width: 200px;">
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="date">Date</label>
                                    <input type="datetime-local" 
                                           class="form-control @error('date') is-invalid @enderror" 
                                           id="date" 
                                           name="date" 
                                           value="{{ $evidence->date->format('Y-m-d\TH:i') }}"
                                           required>
                                    @error('date')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="crop">Cultivo</label>
                                    <input type="text"
                                           class="form-control @error('crop') is-invalid @enderror"
                                           id="crop"
                                           name="crop"
                                           value="{{ $evidence->crop }}"
                                           placeholder="Ej. Maíz, café, cacao">
                                    @error('crop')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="total_area">Área total del terreno (m²)</label>
                                    <input type="number"
                                           step="0.01"
                                           class="form-control @error('total_area') is-invalid @enderror"
                                           id="total_area"
                                           name="total_area"
                                           value="{{ $evidence->total_area }}"
                                           placeholder="Ej. 5000">
                                    @error('total_area')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="cultivable_area">Área cultivable (m²)</label>
                                    <input type="number"
                                           step="0.01"
                                           class="form-control @error('cultivable_area') is-invalid @enderror"
                                           id="cultivable_area"
                                           name="cultivable_area"
                                           value="{{ $evidence->cultivable_area }}"
                                           placeholder="Ej. 3500">
                                    @error('cultivable_area')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="description">Descripción / Análisis</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" 
                                              id="description" 
                                              name="description" 
                                              rows="4"
                                              required>{{ $evidence->description }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="location">Ubicación</label>
                                    <input type="text" 
                                           class="form-control @error('location') is-invalid @enderror" 
                                           id="location" 
                                           name="location" 
                                           value="{{ $evidence->location }}"
                                           placeholder="Ingrese la ubicación"
                                           required>
                                    @error('location')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="terrain_zones">Zonas del terreno</label>
                                    <textarea class="form-control @error('terrain_zones') is-invalid @enderror"
                                              id="terrain_zones"
                                              name="terrain_zones"
                                              rows="3">{{ $evidence->terrain_zones }}</textarea>
                                    @error('terrain_zones')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="planting_plan">Plan de siembra</label>
                                    <textarea class="form-control @error('planting_plan') is-invalid @enderror"
                                              id="planting_plan"
                                              name="planting_plan"
                                              rows="3">{{ $evidence->planting_plan }}</textarea>
                                    @error('planting_plan')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="irrigation_system">Sistema de riego</label>
                                    <textarea class="form-control @error('irrigation_system') is-invalid @enderror"
                                              id="irrigation_system"
                                              name="irrigation_system"
                                              rows="3">{{ $evidence->irrigation_system }}</textarea>
                                    @error('irrigation_system')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="transit_route">Ruta de tránsito</label>
                                    <textarea class="form-control @error('transit_route') is-invalid @enderror"
                                              id="transit_route"
                                              name="transit_route"
                                              rows="3">{{ $evidence->transit_route }}</textarea>
                                    @error('transit_route')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="collection_plan">Plan de recolección</label>
                                    <textarea class="form-control @error('collection_plan') is-invalid @enderror"
                                              id="collection_plan"
                                              name="collection_plan"
                                              rows="3">{{ $evidence->collection_plan }}</textarea>
                                    @error('collection_plan')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="additional_considerations">Consideraciones adicionales</label>
                                    <textarea class="form-control @error('additional_considerations') is-invalid @enderror"
                                              id="additional_considerations"
                                              name="additional_considerations"
                                              rows="3">{{ $evidence->additional_considerations }}</textarea>
                                    @error('additional_considerations')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="summary">Resumen</label>
                                    <textarea class="form-control @error('summary') is-invalid @enderror"
                                              id="summary"
                                              name="summary"
                                              rows="3">{{ $evidence->summary }}</textarea>
                                    @error('summary')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="estimated_investment">Inversión estimada</label>
                                    <input type="number"
                                           step="0.01"
                                           class="form-control @error('estimated_investment') is-invalid @enderror"
                                           id="estimated_investment"
                                           name="estimated_investment"
                                           value="{{ $evidence->estimated_investment }}"
                                           placeholder="Ej. 1500000">
                                    @error('estimated_investment')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control @error('status') is-invalid @enderror" 
                                            id="status" 
                                            name="status">
                                        <option value="1" {{ $evidence->status ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ !$evidence->status ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        Update Evidence
                                    </button>
                                    <a href="{{ route('evidences.index') }}" class="btn btn-default">
                                        Cancel
                                    </a>
                                </div>
                            </form>
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
    // Preview uploaded image
    document.getElementById('photo').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.alt = 'Preview';
                img.className = 'img-thumbnail mt-2';
                img.style.maxWidth = '200px';
                
                const previewContainer = document.getElementById('photo').nextElementSibling.nextElementSibling;
                if (previewContainer) {
                    previewContainer.innerHTML = '';
                    previewContainer.appendChild(img);
                } else {
                    const div = document.createElement('div');
                    div.className = 'mt-2';
                    div.appendChild(img);
                    document.getElementById('photo').parentNode.appendChild(div);
                }
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush
