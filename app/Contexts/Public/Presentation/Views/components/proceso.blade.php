{{-- PROCESO: FLUJO DE ADQUISICIÓN SEGURO --}}
<section id="proceso" class="py-24 bg-slate-50 relative overflow-hidden">
    
    {{-- Decoración de fondo: Grid sutil --}}
    <div class="absolute inset-0 opacity-[0.03] pointer-events-none" style="background-image: radial-gradient(#4f46e5 1px, transparent 1px); background-size: 30px 30px;"></div>

    <div class="container mx-auto px-6 lg:pl-20 relative z-10">
        
        {{-- Encabezado --}}
        <div class="text-center max-w-2xl mx-auto mb-20 space-y-4">
            <h2 class="text-indigo-600 text-[10px] font-black uppercase tracking-[0.4em]">Protocolo Comercial</h2>
            <h3 class="text-4xl lg:text-5xl font-black text-slate-900 tracking-tighter">
                Trazabilidad total en <br>
                <span class="text-slate-400 font-light italic font-serif tracking-normal">cada etapa.</span>
            </h3>
        </div>

        {{-- Grid del Proceso --}}
        <div class="grid md:grid-cols-4 gap-0 relative">
            
            {{-- Línea conectora (Solo en Desktop) --}}
            <div class="hidden md:block absolute top-12 left-0 w-full h-[1px] bg-slate-200 z-0"></div>

            @foreach ([
                [
                    'paso' => '01',
                    'titulo' => 'Perfilamiento',
                    'desc' => 'Análisis inicial de tus necesidades, presupuesto y preferencias para encontrar la propiedad ideal.',
                    'icon' => 'fa-search-location'
                ],
                [
                    'paso' => '02',
                    'titulo' => 'Auditoría Legal',
                    'desc' => 'Validación exhaustiva de escrituras, gravámenes y estatus jurídico del inmueble seleccionado.',
                    'icon' => 'fa-balance-scale'
                ],
                [
                    'paso' => '03',
                    'titulo' => 'Negociación',
                    'desc' => 'Estructuración de ofertas y acuerdos comerciales firmes bajo un marco de transparencia total.',
                    'icon' => 'fa-handshake'
                ],
                [
                    'paso' => '04',
                    'titulo' => 'Cierre y Notaría',
                    'desc' => 'Formalización legal ante notario público y entrega formal de llaves de tu nuevo patrimonio.',
                    'icon' => 'fa-key'
                ]
            ] as $item)
                <div class="relative z-10 p-8 flex flex-col items-center text-center group">
                    {{-- Círculo con número e Icono FA --}}
                    <div class="w-24 h-24 rounded-full bg-white border border-slate-100 shadow-xl flex items-center justify-center mb-8 relative transition-all duration-500 group-hover:border-indigo-500 group-hover:scale-110">
                        <span class="absolute -top-2 -right-2 bg-indigo-600 text-white font-mono text-[10px] w-8 h-8 rounded-full flex items-center justify-center shadow-lg">
                            {{ $item['paso'] }}
                        </span>
                        
                        {{-- Icono FontAwesome --}}
                        <i class="fas {{ $item['icon'] }} text-2xl text-slate-400 group-hover:text-indigo-600 transition-colors duration-500"></i>
                    </div>

                    {{-- Contenido --}}
                    <div class="space-y-3">
                        <h4 class="text-sm font-black uppercase tracking-widest text-slate-900 group-hover:text-indigo-600 transition-colors">
                            {{ $item['titulo'] }}
                        </h4>
                        <div class="w-8 h-[2px] bg-indigo-100 mx-auto group-hover:w-16 transition-all duration-500"></div>
                        <p class="text-xs leading-relaxed text-slate-500 max-w-[200px] font-medium">
                            {{ $item['desc'] }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Call to Action Secundario --}}
        <div class="mt-20 flex justify-center">
            <div class="inline-flex items-center gap-4 px-6 py-3 bg-white border border-slate-200 rounded-full shadow-sm">
                <span class="flex h-2 w-2 relative">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                </span>
                <p class="text-[10px] font-black text-slate-600 uppercase tracking-[0.2em]">Asesores disponibles y certeza jurídica garantizada</p>
            </div>
        </div>
    </div>
</section>