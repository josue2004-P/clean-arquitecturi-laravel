{{-- SERVICIOS: PORTAFOLIO INMOBILIARIO DE PRECISIÓN --}}
<section id="servicios" class="py-16 md:py-24 bg-white relative overflow-hidden">
    {{-- Decoración de fondo sutil --}}
    <div class="absolute top-0 right-0 w-1/3 h-full bg-slate-50/50 -skew-x-12 translate-x-20 hidden md:block"></div>

    <div class="container mx-auto px-6 lg:pl-20 relative z-10">
        
        {{-- Cabecera de Sección --}}
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 md:mb-20 gap-8">
            <div class="space-y-4 max-w-full">
                <div class="flex items-center gap-2">
                    <span class="text-indigo-600 font-mono text-[10px] tracking-[0.3em] uppercase">02. Líneas de Negocio</span>
                    <div class="h-[1px] w-12 bg-indigo-100"></div>
                </div>
                
                {{-- FIX: Tamaño de fuente fluido y manejo de palabras largas --}}
                <h2 class="text-4xl sm:text-5xl md:text-6xl font-black text-slate-900 tracking-tighter leading-[0.9] break-words">
                    Soluciones <br>
                    <span class="text-slate-400 font-light italic font-serif tracking-normal block mt-2 overflow-visible break-words sm:break-normal">
                        patrimoniales.
                    </span>
                </h2>
            </div>
            
            {{-- FIX: Ajuste de borde y padding en móvil --}}
            <p class="max-w-xs text-slate-500 text-sm leading-relaxed border-l-2 md:border-l border-indigo-500 md:border-slate-200 pl-6 py-2">
                Analizamos cada propiedad con rigor comercial, garantizando certeza jurídica y viabilidad financiera total desde el primer acercamiento.
            </p>
        </div>

        {{-- Grid de Servicios --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-16 md:gap-12">
            @foreach ([
                [
                    'id' => '01',
                    'nombre' => 'Venta Residencial', 
                    'descripcion' => 'Casas, departamentos y terrenos exclusivos seleccionados bajo altos estándares de diseño y ubicación.', 
                    'img' =>  asset('images/img_servicios_1.jpg') , 
                    'icon' => 'fa-home'
                ],
                [
                    'id' => '02',
                    'nombre' => 'Consultoría de Inversión', 
                    'descripcion' => 'Proyectos en preventa y desarrollos comerciales de alta plusvalía con rendimientos proyectados.', 
                    'img' => asset('images/img_servicios_2.png') , 
                    'icon' => 'fa-chart-pie'
                ],
                [
                    'id' => '03',
                    'nombre' => 'Gestión de Arrendamiento', 
                    'descripcion' => 'Administración integral de propiedades y colocación de inquilinos bajo riguroso filtro de confianza.', 
                    'img' => asset('images/img_servicios_3.jpg') , 
                    'icon' => 'fa-key'
                ],
            ] as $servicio)
                <div x-data="{ open: false }" 
                     @mouseenter="open = true" 
                     @mouseleave="open = false"
                     @touchstart="open = !open"
                     class="group relative flex flex-col h-full bg-white transition-all duration-500">
                    
                    {{-- Contenedor de Imagen --}}
                    <div class="relative overflow-hidden aspect-[4/5] md:aspect-[3/4] mb-8 rounded-sm shadow-sm">
                        <img src="{{ $servicio['img'] }}" 
                             alt="{{ $servicio['nombre'] }}" 
                             class="w-full h-full object-cover grayscale transition-transform duration-700 group-hover:scale-105 group-hover:grayscale-0">
                        
                        {{-- Overlay técnico --}}
                        <div class="absolute inset-0 bg-indigo-900/60 opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-center justify-center backdrop-blur-[2px]">
                            <span class="text-white border border-white/40 px-6 py-2 text-[10px] font-black uppercase tracking-[0.3em]">
                                Ver Detalles <i class="fas fa-plus ml-2 text-[8px]"></i>
                            </span>
                        </div>
                        
                        <span class="absolute top-4 left-4 text-white/70 font-mono text-[10px] tracking-widest bg-black/20 px-2 py-1 backdrop-blur-md">{{ $servicio['id'] }}</span>
                    </div>

                    {{-- Contenido --}}
                    <div class="space-y-4 relative px-2">
                        <div class="w-12 h-12 text-indigo-600 transition-transform duration-500 flex items-center justify-start" :class="open ? '-translate-y-2' : ''">
                            <i class="fas {{ $servicio['icon'] }} text-3xl"></i>
                        </div>
                        
                        <h3 class="text-2xl font-black text-slate-900 tracking-tight group-hover:text-indigo-600 transition-colors">
                            {{ $servicio['nombre'] }}
                        </h3>
                        
                        <p class="text-slate-500 leading-relaxed text-sm font-light">
                            {{ $servicio['descripcion'] }}
                        </p>

                        <div class="pt-4">
                            <a href="#contacto" class="inline-flex items-center gap-4 text-[10px] font-black uppercase tracking-[0.3em] text-slate-900 group-hover:gap-6 transition-all group-hover:text-indigo-600">
                                Consultar Disponibilidad
                                <div class="h-[1px] w-8 bg-slate-400 group-hover:w-12 group-hover:bg-indigo-600 transition-all"></div>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>