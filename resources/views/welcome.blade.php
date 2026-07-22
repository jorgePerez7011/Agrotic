<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agricultura</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        html {
            scroll-behavior: smooth;
        }
        section {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }
        section.visible {
            opacity: 1;
            transform: translateY(0);
        }
        .fade-in {
            animation: fadeIn 1s ease-in forwards;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sections = document.querySelectorAll('section');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, {
                threshold: 0.1
            });

            sections.forEach(section => {
                observer.observe(section);
            });
        });
    </script>
</head>

<body class="antialiased bg-gradient-to-br from-green-100 via-lime-100 to-green-200">

   <!-- Barra superior -->
<!-- Barra superior con fondo verde -->
<nav class="w-full bg-gradient-to-r from-green-700 via-green-600 to-lime-600 px-6 py-4 flex justify-between items-center fixed top-0 z-50 shadow-lg">
    <!-- Logo con degradado -->
    <a href="{{ url('/') }}" class="text-2xl font-bold bg-gradient-to-r from-lime-200 via-white to-lime-200 bg-clip-text text-transparent">
        AGROTIC
    </a>

    <!-- Enlaces de navegación -->
    <div class="hidden md:flex space-x-4">
        <a href="#mision-vision" class="px-4 py-2 text-white hover:bg-green-600 rounded-lg transition">Misión y Visión</a>
        <a href="#servicios" class="px-4 py-2 text-white hover:bg-green-600 rounded-lg transition">Servicios</a>
        <a href="#contacto" class="px-4 py-2 text-white hover:bg-green-600 rounded-lg transition">Contacto</a>
    </div>

    @if (Route::has('login'))
        <div class="space-x-4">
            @auth
                <a href="{{ url('/dashboard') }}"
                    class="px-4 py-2 bg-white text-green-800 font-semibold rounded-lg shadow-md hover:bg-gray-100 transition">
                    Dashboard
                </a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit"
                        class="px-4 py-2 bg-red-100 text-red-700 font-semibold rounded-lg shadow-md hover:bg-red-200 transition">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}"
                    class="px-4 py-2 bg-white text-green-800 font-semibold rounded-lg hover:bg-gray-100 transition shadow-md">
                    Log in
                </a>
                
            @endauth
        </div>
    @endif
</nav>



    <!-- Contenido principal -->
    <div class="relative flex items-top justify-center min-h-screen pt-28 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto p-6 lg:p-8">
            <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-green-700 via-lime-600 to-green-400 rounded-3xl shadow-2xl p-12 flex flex-col items-center justify-center text-center mb-24 mt-8">
        <h1 class="text-5xl md:text-6xl font-extrabold text-white drop-shadow-lg mb-6">Soluciones Inteligentes para la Agricultura</h1>
        <p class="text-xl md:text-2xl text-lime-100 mb-8 max-w-2xl mx-auto">Impulsamos la transformación digital del campo con tecnología de drones, análisis de datos y soporte experto para una gestión agrícola eficiente y sostenible.</p>
        <a href="#contacto" class="inline-block px-8 py-4 bg-white text-green-800 font-bold rounded-full shadow-lg hover:bg-lime-100 transition text-lg">Solicita una Demo</a>

    </section>

    <!-- Misión y Visión -->
    <section id="mision-vision" class="max-w-6xl mx-auto mb-24 mt-24">
        <h2 class="text-3xl font-extrabold text-green-700 text-center mb-12">Nuestra Misión y Visión</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <!-- Misión -->
            <div class="bg-white rounded-2xl shadow-xl p-8 transform hover:scale-105 transition-all duration-300">
                <div class="bg-gradient-to-br from-green-100 to-lime-50 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-6">
                    <svg class="h-10 w-10 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 20c4.418 0 8-4 8-4s-3.582-4-8-4-8 4-8 4 3.582 4 8 4z" />
                        <circle cx="12" cy="12" r="3" />
                        <circle cx="12" cy="12" r="8" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-green-800 text-center mb-4">Misión</h3>
                <p class="text-gray-600 text-center leading-relaxed">
                    Desarrollar y proporcionar soluciones tecnológicas avanzadas para la gestión agrícola en la Universidad Francisco de Paula Santander, 
                    mediante el uso de drones y análisis de datos. Nuestro compromiso es optimizar la producción agrícola, 
                    garantizar la sostenibilidad y fomentar la innovación en el sector agrícola educativo.
                </p>
            </div>

            <!-- Visión -->
            <div class="bg-white rounded-2xl shadow-xl p-8 transform hover:scale-105 transition-all duration-300">
                <div class="bg-gradient-to-br from-green-100 to-lime-50 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-6">
                    <svg class="h-10 w-10 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7z" />
                        <circle cx="12" cy="12" r="3" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-green-800 text-center mb-4">Visión</h3>
                <p class="text-gray-600 text-center leading-relaxed">
                    Ser líderes en la implementación de tecnología agrícola innovadora, transformando la granja de la UFPS en un modelo 
                    de agricultura de precisión. Aspiramos a ser referentes en la integración de drones y análisis de datos para 
                    la gestión agrícola educativa, promoviendo prácticas sostenibles y formando profesionales del futuro.
                </p>
            </div>
        </div>
    </section>

    <!-- Beneficios / Ventajas -->
    <section class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 mb-24 mt-24">
        <div class="bg-white rounded-xl shadow-lg p-8 flex flex-col items-center">
            <div class="bg-lime-100 rounded-full p-4 mb-4"><svg class="h-10 w-10 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 8v4l3 3"/><circle cx="12" cy="12" r="10"/></svg></div>
            <h3 class="font-bold text-green-800 mb-2">Automatización</h3>
            <p class="text-gray-600 text-center">Optimiza procesos agrícolas y reduce errores humanos con monitoreo automatizado.</p>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-8 flex flex-col items-center">
            <div class="bg-lime-100 rounded-full p-4 mb-4"><svg class="h-10 w-10 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 12l2-2 4 4 8-8 2 2-10 10z"/></svg></div>
            <h3 class="font-bold text-green-800 mb-2">Precisión</h3>
            <p class="text-gray-600 text-center">Datos exactos y en tiempo real para una toma de decisiones más inteligente.</p>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-8 flex flex-col items-center">
            <div class="bg-lime-100 rounded-full p-4 mb-4"><svg class="h-10 w-10 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 2a10 10 0 100 20 10 10 0 000-20z"/><path d="M2 12h20"/></svg></div>
            <h3 class="font-bold text-green-800 mb-2">Sostenibilidad</h3>
            <p class="text-gray-600 text-center">Promueve el uso eficiente de recursos y la protección del medio ambiente.</p>
        </div>
    </section>

    <!-- Servicios Modernos -->
    <section id="servicios" class="max-w-7xl mx-auto mb-24 mt-24">
        <h2 class="text-3xl font-extrabold text-green-700 text-center mb-12">Nuestros Servicios</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            <div class="bg-gradient-to-br from-green-100 via-lime-50 to-white rounded-2xl shadow-xl p-8 flex flex-col items-center hover:scale-105 transition">
                <img src="https://cdn-icons-png.flaticon.com/512/2913/2913461.png" alt="Monitoreo" class="w-16 mb-4">
                <h3 class="font-bold text-green-800 text-lg mb-2">Monitoreo con Drones</h3>
                <p class="text-gray-600 text-center">Supervisión aérea de cultivos, detección de plagas y análisis visual avanzado.</p>
            </div>
            <div class="bg-gradient-to-br from-green-100 via-lime-50 to-white rounded-2xl shadow-xl p-8 flex flex-col items-center hover:scale-105 transition">
                <img src="https://cdn-icons-png.flaticon.com/512/2913/2913467.png" alt="Análisis" class="w-16 mb-4">
                <h3 class="font-bold text-green-800 text-lg mb-2">Análisis de Datos Agrícolas</h3>
                <p class="text-gray-600 text-center">Procesamiento inteligente de datos para optimizar riego, fertilización y cosecha.</p>
            </div>
            <div class="bg-gradient-to-br from-green-100 via-lime-50 to-white rounded-2xl shadow-xl p-8 flex flex-col items-center hover:scale-105 transition">
                <img src="https://cdn-icons-png.flaticon.com/512/2913/2913465.png" alt="Soporte" class="w-16 mb-4">
                <h3 class="font-bold text-green-800 text-lg mb-2">Capacitación y Soporte</h3>
                <p class="text-gray-600 text-center">Formación personalizada y asistencia técnica para sacar el máximo provecho a la tecnología.</p>
            </div>
        </div>
    </section>

    <!-- Partners / Clientes -->
    <section class="max-w-6xl mx-auto mb-24 mt-24">
        <h2 class="text-2xl font-bold text-green-700 text-center mb-8">Confían en Nosotros</h2>
        <div class="flex flex-wrap justify-center items-center gap-8">
            <img src="https://ufpso.edu.co/plantilla/img/iconos_redes/LogoufpsoMen17.png" alt="UFPS" class="h-16 grayscale hover:grayscale-0 transition">
            <img src="https://cdn-icons-png.flaticon.com/512/5968/5968705.png" alt="Partner" class="h-16 grayscale hover:grayscale-0 transition">
            
        </div>
    </section>

    <!-- Carrusel de imágenes -->
    <div class="mb-24 mt-24 max-w-5xl mx-auto" x-data="{ activeSlide: 0 }">
        <div class="relative overflow-hidden rounded-2xl">
            <div class="flex transition-transform duration-500 ease-in-out" :style="'transform: translateX(-' + (activeSlide * 100) + '%)'">
                <div class="w-full flex-shrink-0">
                    <img src="https://colombiaverde.com.co/wp-content/uploads/2023/05/importancia-de-la-agricultura-de-precision.jpg" alt="Imagen 1" class="w-full h-[400px] object-cover rounded-2xl">
                </div>
                <div class="w-full flex-shrink-0">
                    <img src="https://terrasat.com.mx/wp-content/uploads/2021/09/Terrasat-Fotos-Agricultura-de-Precisio%CC%81n-02-768x768.jpg" alt="Imagen 2" class="w-full h-[400px] object-cover rounded-2xl">
                </div>
                <div class="w-full flex-shrink-0">
                    <img src="https://img.lalr.co/cms/2024/07/16224145/CONSEJOS-DEL-PROFESOR-YARUMO-INFORMACION-Y-TECNOLOGIA-1.jpg?w=728" alt="Imagen 3" class="w-full h-[400px] object-cover rounded-2xl">
                </div>
            </div>

            <!-- Botones de navegación -->
            <button @click="activeSlide = activeSlide === 0 ? 2 : activeSlide - 1" 
                    class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white/80 hover:bg-white text-green-700 rounded-full p-2 shadow-lg transition">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M15 18l-6-6 6-6"/>
                </svg>
            </button>
            <button @click="activeSlide = activeSlide === 2 ? 0 : activeSlide + 1"
                    class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white/80 hover:bg-white text-green-700 rounded-full p-2 shadow-lg transition">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M9 6l6 6-6 6"/>
                </svg>
            </button>

            <!-- Indicadores -->
            <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2">
                <template x-for="(slide, index) in 3" :key="index">
                    <button @click="activeSlide = index"
                            :class="{'bg-white': activeSlide === index, 'bg-white/50': activeSlide !== index}"
                            class="w-3 h-3 rounded-full transition-all duration-300">
                    </button>
                </template>
            </div>
        </div>
    </div>

    <!-- Contacto -->
    <div id="contacto" class="mt-24 mb-24 bg-white rounded-xl shadow-lg p-8 flex flex-col md:flex-row md:items-center md:justify-between">
        <div>
            <h2 class="text-2xl font-bold text-green-700 mb-2 flex items-center"><svg class="h-7 w-7 mr-2 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 10.5a8.38 8.38 0 01-1.9.5 3.48 3.48 0 00-6.6 0 8.38 8.38 0 01-1.9-.5"/><path d="M2 12a10 10 0 0020 0"/></svg>Contacto</h2>
            <p class="text-gray-700">Email: <a href="mailto:info@ufps.edu.co" class="text-green-700 underline">info@ufps.edu.co</a></p>
            <p class="text-gray-700">Teléfono: <a href="tel:+5771234567" class="text-green-700 underline">+57 712 34567</a></p>
            <p class="text-gray-700">Vía Universidad Francisco de Paula Santander, Ocaña, Norte de Santander</p>
        </div>
        <div class="mt-6 md:mt-0 flex space-x-4">
            <a href="https://www.facebook.com/UFPSO" target="_blank" class="text-green-700 hover:text-green-900"><svg class="h-8 w-8" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.522-4.477-10-10-10S2 6.478 2 12c0 5.019 3.676 9.163 8.438 9.877v-6.987h-2.54v-2.89h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.242 0-1.63.771-1.63 1.562v1.875h2.773l-.443 2.89h-2.33v6.987C18.324 21.163 22 17.019 22 12z"/></svg></a>
            <a href="https://www.instagram.com/ufpsocana_/" target="_blank" class="text-green-700 hover:text-green-900"><svg class="h-8 w-8" fill="currentColor" viewBox="0 0 24 24"><path d="M7.75 2h8.5A5.75 5.75 0 0122 7.75v8.5A5.75 5.75 0 0116.25 22h-8.5A5.75 5.75 0 012 16.25v-8.5A5.75 5.75 0 017.75 2zm0 1.5A4.25 4.25 0 003.5 7.75v8.5A4.25 4.25 0 007.75 20.5h8.5a4.25 4.25 0 004.25-4.25v-8.5A4.25 4.25 0 0016.25 3.5h-8.5zm4.25 3.25a5.25 5.25 0 110 10.5 5.25 5.25 0 010-10.5zm0 1.5a3.75 3.75 0 100 7.5 3.75 3.75 0 000-7.5zm5.25.75a1 1 0 110 2 1 1 0 010-2z"/></svg></a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="mt-24 text-center text-gray-500 text-base py-8 border-t border-green-200 bg-gradient-to-r from-green-50 via-lime-50 to-green-100">
        <div class="mb-2 font-bold text-green-800">Drosens Agricultura</div>
        <div>© 2025 Universidad Francisco de Paula Santander. Todos los derechos reservados.</div>
        <div class="mt-2 text-xs text-gray-400">Desarrollado por el equipo Drosens | Inspirado en Agrosap</div>
    </footer>
        </div>
    </div>

</body>

</html>
