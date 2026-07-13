{{-- HERO SECTION: INMOBILIARIA SELECTA --}}
<section 
    x-data="{ 
        tab: 'propiedades',
        loaded: false 
    }" 
    x-init="setTimeout(() => loaded = true, 100)"
    class="relative min-h-[90vh] flex items-center bg-white overflow-hidden pt-32 pb-16"
>
    {{-- Regla técnica lateral --}}
    <div class="absolute left-0 top-0 h-full w-12 border-r border-slate-100 hidden lg:flex flex-col justify-between py-20 items-center text-[10px] font-mono text-slate-300 select-none">
        <span class="rotate-90">SEC_01</span>
        <div class="flex flex-col gap-4">
            <span>10%</span><span>20%</span><span>30%</span><span>40%</span><span>50%</span>
        </div>
        <span class="rotate-90">REF_2026</span>
    </div>

    <div class="container mx-auto px-6 lg:pl-24 relative z-10">
        <div class="grid lg:grid-cols-2 gap-20 items-center">
            
            {{-- Bloque de Texto --}}
            <div class="space-y-12">
                <div x-show="loaded" 
                     x-transition:enter="transition ease-out duration-1000"
                     x-transition:enter-start="opacity-0 -translate-x-12"
                     class="space-y-6">
                    
                    <div class="flex items-center gap-4">
                        <span class="h-[1px] w-12 bg-indigo-600"></span>
                        <h2 class="text-indigo-600 text-[10px] font-black uppercase tracking-[0.4em]">
                            Gestión Inmobiliaria
                        </h2>
                    </div>

                    <h1 class="text-6xl lg:text-8xl font-black text-slate-900 leading-[0.9] tracking-tighter">
                        Espacios <br>
                        <span class="text-slate-400 font-light italic font-serif tracking-normal">con valor.</span>
                    </h1>
                    
                    <p class="text-slate-500 text-lg max-w-md leading-relaxed font-light">
                        Encuentra propiedades exclusivas seleccionadas bajo rigurosos estándares de plusvalía y diseño arquitectónico.
                    </p>
                </div>

                {{-- Selector de Pilares con Alpine.js --}}
                <div x-show="loaded" x-transition:enter="transition duration-1000 delay-300" class="space-y-8">
                    <div class="flex gap-10 border-b border-slate-100 pb-0">
                        @foreach(['propiedades' => 'Propiedades', 'inversion' => 'Inversión', 'asesores' => 'Asesores'] as $id => $label)
                            <button @click="tab = '{{ $id }}'" 
                                    :class="tab === '{{ $id }}' ? 'text-slate-900 border-b-2 border-indigo-600' : 'text-slate-300 border-b-2 border-transparent hover:text-slate-500'" 
                                    class="pb-4 text-[10px] font-black uppercase tracking-[0.2em] transition-all focus:outline-none relative">
                                {{ $label }}
                                <span x-show="tab === '{{ $id }}'" class="absolute -top-4 left-0 text-[8px] font-mono text-indigo-400">0{{ $loop->iteration }}</span>
                            </button>
                        @endforeach
                    </div>

                    <div class="h-20 max-w-md">
                        <div x-show="tab === 'propiedades'" x-transition:enter="transition opacity duration-500" class="text-slate-500 text-sm leading-relaxed">
                            <i class="fas fa-building text-indigo-600 mr-2"></i>
                            <strong class="text-slate-900 font-bold">Catálogo Selecto:</strong> Amplia gama de residencias y locales comerciales con certeza jurídica legal.
                        </div>
                        <div x-show="tab === 'inversion'" x-transition:enter="transition opacity duration-500" class="text-slate-500 text-sm leading-relaxed text-left">
                            <i class="fas fa-chart-line text-indigo-600 mr-2 text-left"></i>
                            <strong class="text-slate-900 font-bold">Alta Plusvalía:</strong> Proyecciones de mercado estructuradas para garantizar el retorno de tu inversión.
                        </div>
                        <div x-show="tab === 'asesores'" x-transition:enter="transition opacity duration-500" class="text-slate-500 text-sm leading-relaxed text-left">
                            <i class="fas fa-user-tie text-indigo-600 mr-2 text-left"></i>
                            <strong class="text-slate-900 font-bold">Expertos Certificados:</strong> Personal calificado enfocado en la negociación estratégica y tus necesidades.
                        </div>
                    </div>
                </div>

                {{-- Acciones --}}
                <div x-show="loaded" x-transition:enter="transition duration-1000 delay-500" class="flex flex-wrap gap-6 pt-4">
                    <a href="{{ url('/propiedades') }}" class="group relative px-10 py-5 bg-slate-900 text-white transition-all duration-300 hover:bg-indigo-700">
                        <div class="relative z-10 flex items-center gap-4 text-[10px] font-black uppercase tracking-[0.3em]">
                            Ver Propiedades
                            <i class="fas fa-chevron-right group-hover:translate-x-2 transition-transform"></i>
                        </div>
                    </a>
                    
                    <a href="{{ route('login') }}" class="px-10 py-5 border border-slate-200 text-slate-900 text-[10px] font-black uppercase tracking-[0.3em] hover:bg-slate-50 transition-all flex items-center gap-3">
                        <i class="fas fa-key text-indigo-600"></i>
                        Portal de Clientes
                    </a>
                </div>
            </div>

            {{-- Bloque Visual --}}
            <div class="relative mt-20 lg:mt-0" x-show="loaded" x-transition:enter="transition duration-1000 delay-500 opacity-0 scale-95">
                
                {{-- Contenedor de Imagen Principal --}}
                <div class="relative z-10 w-full aspect-[4/5] lg:aspect-square overflow-hidden rounded-sm shadow-2xl">
                    <img src="{{ asset('images/img_hero.jpg') }}" 
                         class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-1000 scale-105 hover:scale-100" 
                         alt="Arquitectura y Propiedades">
                    
                    {{-- Grid técnico (Overlay) --}}
                    <div class="absolute inset-0 pointer-events-none opacity-20" style="background-image: linear-gradient(#fff 1px, transparent 1px), linear-gradient(90deg, #fff 1px, transparent 1px); background-size: 40px 40px;"></div>
                </div>

                {{-- Card de Garantía/Rendimiento --}}
                <div class="absolute -bottom-10 left-6 right-6 sm:left-auto sm:right-auto sm:-bottom-10 sm:-left-10 bg-white p-6 sm:p-8 shadow-2xl border-l-4 border-indigo-600 z-20 max-w-[280px] sm:max-w-[260px] mx-auto sm:mx-0">
                    <div class="space-y-4 sm:space-y-6">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-slate-50 flex items-center justify-center text-indigo-600">
                                <i class="fas fa-shield-alt text-lg sm:text-xl"></i>
                            </div>
                            <div class="text-left">
                                <p class="text-[8px] font-black uppercase text-slate-400 tracking-widest">Garantía</p>
                                <p class="text-[10px] font-bold text-emerald-500 uppercase">Certeza Jurídica</p>
                            </div>
                        </div>
                        
                        <div class="border-t border-slate-100 pt-4 sm:pt-6 flex justify-between items-end">
                            <div class="text-left">
                                <p class="text-3xl sm:text-4xl font-black text-slate-900 leading-none">100%</p>
                                <p class="text-[9px] font-bold text-slate-400 uppercase tracking-[0.2em] mt-2">Seguridad</p>
                            </div>
                            <i class="fas fa-home text-slate-100 text-3xl sm:text-4xl hidden xs:block"></i>
                        </div>
                    </div>
                </div>

                {{-- Decoración de fondo --}}
                <div class="absolute -top-6 -right-6 sm:-top-12 sm:-right-12 w-32 h-32 sm:w-48 sm:h-48 bg-indigo-50/50 rounded-full blur-3xl -z-10"></div>
            </div>
        </div>
    </div>
</section>