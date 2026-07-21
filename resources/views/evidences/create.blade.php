@extends('layouts.app')

@section('title', isset($evidence) ? 'Edit Evidence' : 'Add Evidence')

@section('content')
<div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ isset($evidence) ? 'Edit Evidence' : 'Add Evidence' }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('evidences.index') }}">Evidence List</a></li>
                        <li class="breadcrumb-item active">{{ isset($evidence) ? 'Edit' : 'Add' }}</li>
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
                            <h3 class="card-title">{{ isset($evidence) ? 'Edit Evidence Details' : 'Add New Evidence' }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{ isset($evidence) ? route('evidences.update', $evidence) : route('evidences.store') }}"
                                  method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                @if(isset($evidence))
                                    @method('PUT')
                                @endif

                                <div class="form-group">
                                    <label for="photo">Photo</label>
                                    <input type="file" 
                                           class="form-control @error('photo') is-invalid @enderror" 
                                           id="photo" 
                                           name="photo" 
                                           accept="image/*"
                                           {{ !isset($evidence) ? 'required' : '' }}>
                                    @error('photo')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    @if(isset($evidence) && $evidence->photo)
                                        <div class="mt-2">
                                            <img src="{{ Storage::url($evidence->photo) }}" 
                                                 alt="Current Evidence Photo" 
                                                 class="img-thumbnail"
                                                 style="max-width: 200px;">
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" 
                                              id="description" 
                                              name="description" 
                                              rows="4"
                                              required>{{ isset($evidence) ? $evidence->description : old('description') }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="location">Location</label>
                                    <input type="text" 
                                           class="form-control @error('location') is-invalid @enderror" 
                                           id="location" 
                                           name="location" 
                                           value="{{ isset($evidence) ? $evidence->location : old('location') }}"
                                           placeholder="Enter location"
                                           required>
                                    @error('location')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="date">Date</label>
                                    <input type="datetime-local" 
                                           class="form-control @error('date') is-invalid @enderror" 
                                           id="date" 
                                           name="date" 
                                           value="{{ isset($evidence) ? $evidence->date->format('Y-m-d\TH:i') : old('date') }}"
                                           required>
                                    @error('date')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control @error('status') is-invalid @enderror" 
                                            id="status" 
                                            name="status">
                                        <option value="1" {{ (isset($evidence) && $evidence->status) || old('status') == '1' ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ (isset($evidence) && !$evidence->status) || old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        {{ isset($evidence) ? 'Update Evidence' : 'Add Evidence' }}
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
