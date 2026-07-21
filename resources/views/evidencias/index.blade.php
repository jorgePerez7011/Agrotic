@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Evidencias de Terreno - Segmentación IA</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-map-marked-alt"></i>
                                Meta Segment Anything - Análisis de Terreno
                            </h3>
                        </div>
                        <div class="card-body p-3">
                            <!-- Botones de herramientas -->
                            <div class="row mb-4">
                                <div class="col-md-6 text-center mb-3">
                                    <div class="tool-card p-4 border rounded">
                                        <i class="fas fa-map-marked-alt fa-4x text-success mb-3"></i>
                                        <h5 class="text-dark">Segmentación IA</h5>
                                        <p class="text-muted mb-3">
                                            Meta Segment Anything para análisis de terrenos
                                        </p>
                                        <a href="https://aidemos.meta.com/segment-anything" target="_blank" class="btn btn-success">
                                            <i class="fas fa-external-link-alt mr-2"></i>
                                            Abrir Herramienta
                                        </a>
                                    </div>
                                </div>
                                
                                <div class="col-md-6 text-center mb-3">
                                    <div class="tool-card p-4 border rounded">
                                        <i class="fas fa-robot fa-4x text-primary mb-3"></i>
                                        <h5 class="text-dark">Asistente Claude IA</h5>
                                        <p class="text-muted mb-3">
                                            Consulta con inteligencia artificial avanzada
                                        </p>
                                        <a href="https://claude.ai/new" target="_blank" class="btn btn-primary">
                                            <i class="fas fa-external-link-alt mr-2"></i>
                                            Abrir Claude IA
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Información adicional -->
                            <div class="row mt-4">
                                <div class="col-12">
                                    <div class="alert alert-info">
                                        <h6><i class="fas fa-info-circle mr-2"></i>Herramientas de Análisis Agrícola</h6>
                                        <p class="mb-2"><strong>Meta Segment Anything:</strong> Ideal para segmentar y analizar diferentes áreas de tus terrenos, identificar cultivos, malezas, y zonas problemáticas.</p>
                                        <p class="mb-0"><strong>Claude IA:</strong> Asistente inteligente para consultas sobre agricultura, análisis de datos, recomendaciones de cultivos y resolución de problemas.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('styles')
<style>
.tool-card {
    transition: all 0.3s ease;
    height: 100%;
    background: white;
}
.tool-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0,0,0,0.1);
}
.btn {
    border-radius: 6px;
    transition: all 0.3s ease;
}
.btn:hover {
    transform: translateY(-1px);
}
#claude-container {
    animation: slideDown 0.3s ease;
}
@keyframes slideDown {
    from { opacity: 0; transform: translateY(-20px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>
@endpush

