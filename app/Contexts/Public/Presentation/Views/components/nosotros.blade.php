{{-- Nosotros: Legado y Rigor Inmobiliario --}}
<section id="nosotros" class="py-24 bg-white overflow-hidden">
    <div class="container mx-auto px-6 lg:pl-20">
        <div class="grid lg:grid-cols-2 gap-20 items-center">
            
            {{-- Columna Visual: Composición Doble --}}
            <div class="relative">
                <div class="relative z-10 w-4/5 aspect-square rounded-sm overflow-hidden shadow-2xl">
                    <img src="{{ asset('images/img_nosotros_2.jpg') }}"  
                         alt="Propiedades y Desarrollos Selectos" 
                         class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-1000">
                </div>
                
                {{-- Imagen Secundaria Flotante --}}
                <div class="absolute -bottom-12 -right-4 w-1/2 aspect-video bg-indigo-600 z-20 p-1 shadow-2xl overflow-hidden rounded-sm hidden md:block">
                    <img src="{{ asset('images/img_nosotros_1.jpg') }}"  
                         alt="Asesores en consultoría patrimonial" 
                         class="w-full h-full object-cover opacity-80 group-hover:opacity-100 transition-opacity">
                </div>

                {{-- Años de Experiencia Badge --}}
                <div class="absolute -top-8 -left-8 bg-[#0a0f1d] text-white p-8 z-30 shadow-2xl">
                    <p class="text-5xl font-black leading-none italic font-serif">15+</p>
                    <p class="text-[9px] font-black uppercase tracking-[0.3em] mt-2 text-indigo-400">Años de Excelencia</p>
                </div>
            </div>

            {{-- Columna de Texto --}}
            <div class="space-y-10">
                <div class="space-y-6">
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 bg-indigo-600 rounded-full"></div>
                        <h2 class="text-indigo-600 text-[10px] font-black uppercase tracking-[0.4em]">Nuestra Identidad</h2>
                    </div>
                    
                    <h3 class="text-5xl font-black text-slate-900 tracking-tighter leading-[1.1]">
                        Compromiso con la <br>
                        <span class="text-slate-400 font-light italic font-serif tracking-normal">solidez patrimonial.</span>
                    </h3>

                    <div class="space-y-4 text-slate-500 text-lg leading-relaxed font-light">
                        <p>
                            En nuestra firma de <strong class="text-slate-900 font-bold">Gestión Inmobiliaria</strong>, entendemos que detrás de cada propiedad hay un proyecto de vida o una decisión clave de negocio. No solo comercializamos espacios; generamos tranquilidad a través de un riguroso análisis financiero y comercial.
                        </p>
                        <p class="text-base italic border-l-2 border-slate-100 pl-6 py-2">
                            Trabajamos bajo los más estrictos marcos legales y notariales, fusionando herramientas de análisis de mercado de punta con la ética profesional de nuestros asesores certificados.
                        </p>
                    </div>
                </div>

                {{-- Grid de Confianza --}}
                <div class="grid grid-cols-2 gap-8 pt-6 border-t border-slate-100">
                    <div class="space-y-2">
                        <p class="text-xs font-black text-slate-900 uppercase tracking-widest">Certeza Legal</p>
                        <p class="text-[11px] leading-relaxed text-slate-500">Cumplimiento total con auditorías de títulos, regulaciones urbanas y viabilidad jurídica.</p>
                    </div>
                    <div class="space-y-2">
                        <p class="text-xs font-black text-slate-900 uppercase tracking-widest">Transparencia</p>
                        <p class="text-[11px] leading-relaxed text-slate-500">Protocolos rigurosos de negociación y resguardo ético de los acuerdos comerciales.</p>
                    </div>
                </div>

                {{-- Firma / Call to action --}}
                <div class="pt-4">
                    <a href="#contacto" class="inline-flex items-center gap-4 text-[10px] font-black uppercase tracking-[0.3em] text-indigo-600 hover:text-slate-900 transition-colors group">
                        Conoce a nuestro equipo de asesores
                        <svg class="w-4 h-4 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>