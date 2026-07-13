{{-- CONTACTO: ESTACIÓN DE CONSULTA INMOBILIARIA --}}
<section id="contacto" class="py-24 bg-[#0a0f1d] relative overflow-hidden">
    
    {{-- Elementos de fondo abstractos --}}
    <div class="absolute top-0 right-0 w-1/2 h-full bg-indigo-950/20 -skew-x-12 translate-x-32"></div>
    <div class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-indigo-500 to-transparent opacity-30"></div>

    <div class="container mx-auto px-6 lg:pl-20 relative z-10">
        <div class="grid lg:grid-cols-12 gap-16 items-start">
            
            {{-- Columna de Información --}}
            <div class="lg:col-span-5 space-y-12">
                <div class="space-y-6">
                    <div class="flex items-center gap-3">
                        <div class="w-1 h-6 bg-indigo-500"></div>
                        <h2 class="text-indigo-400 text-[10px] font-black uppercase tracking-[0.4em]">Canales de Enlace</h2>
                    </div>
                    <h3 class="text-5xl font-black text-white tracking-tighter leading-none">
                        ¿Iniciamos tu <br>
                        <span class="text-slate-500 font-light italic font-serif tracking-normal">cotización?</span>
                    </h3>
                    <p class="text-slate-400 text-lg font-light leading-relaxed">
                        Nuestro equipo de asesores está listo para guiarte en la selección de tu propiedad y la gestión de tu inversión.
                    </p>
                </div>

                {{-- Datos de Contacto Directo con FontAwesome --}}
                <div class="space-y-8">
                    {{-- Teléfono --}}
                    <div class="flex items-start gap-6 group">
                        <div class="w-12 h-12 rounded-sm bg-white/5 border border-white/10 flex items-center justify-center text-indigo-400 group-hover:bg-indigo-600 group-hover:text-white transition-all duration-500">
                            <i class="fas fa-phone-alt text-lg"></i>
                        </div>
                        <div class="text-left">
                            <p class="text-[10px] font-black uppercase tracking-widest text-slate-500">Línea Directa</p>
                            <p class="text-xl font-bold text-white mt-1 underline decoration-indigo-500/30 underline-offset-8">+52 (352) 123 4567</p>
                        </div>
                    </div>

                    {{-- WhatsApp --}}
                    <div class="flex items-start gap-6 group">
                        <div class="w-12 h-12 rounded-sm bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-emerald-400 group-hover:bg-emerald-500 group-hover:text-white transition-all duration-500">
                            <i class="fab fa-whatsapp text-2xl"></i>
                        </div>
                        <div class="text-left">
                            <p class="text-[10px] font-black uppercase tracking-widest text-slate-500">Asesoría Inmobiliaria</p>
                            <a href="https://wa.me/523521234567" target="_blank" class="text-xl font-bold text-white mt-1 hover:text-emerald-400 transition-colors">WhatsApp Business</a>
                        </div>
                    </div>

                    {{-- Ubicación --}}
                    <div class="flex items-start gap-6 group">
                        <div class="w-12 h-12 rounded-sm bg-white/5 border border-white/10 flex items-center justify-center text-indigo-400 group-hover:bg-indigo-600 group-hover:text-white transition-all duration-500">
                            <i class="fas fa-map-marker-alt text-lg"></i>
                        </div>
                        <div class="text-left">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Columna del Formulario --}}
            <div class="lg:col-span-7">
                <div x-data="{ nombre: '', email: '', mensaje: '', enviado: false, loading: false }" 
                     class="relative bg-white p-10 lg:p-16 rounded-sm shadow-2xl overflow-hidden">
                    
                    {{-- Decoración técnica en el form --}}
                    <div class="absolute top-0 right-0 p-4 font-mono text-[8px] text-slate-200 uppercase tracking-widest select-none">
                        Ref: FORM_GESTION_INMOBILIARIA
                    </div>

                    <form x-show="!enviado" @submit.prevent="loading = true; setTimeout(() => { enviado = true; loading = false; }, 1500)" class="space-y-8">
                        <div class="grid md:grid-cols-2 gap-8">
                            <div class="relative">
                                <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 block text-left">Nombre Completo</label>
                                <input type="text" x-model="nombre" required 
                                       class="w-full bg-slate-50 border-0 border-b-2 border-slate-200 focus:border-indigo-600 focus:ring-0 transition-all py-3 px-0 text-slate-900 placeholder-slate-300"
                                       placeholder="Ej. Carlos Mendoza">
                            </div>
                            <div class="relative">
                                <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 block text-left">Correo Electrónico</label>
                                <input type="email" x-model="email" required 
                                       class="w-full bg-slate-50 border-0 border-b-2 border-slate-200 focus:border-indigo-600 focus:ring-0 transition-all py-3 px-0 text-slate-900 placeholder-slate-300"
                                       placeholder="carlos@ejemplo.com">
                            </div>
                        </div>

                        <div class="relative">
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 block text-left">Detalles del Requerimiento</label>
                            <textarea x-model="mensaje" rows="4" required 
                                      class="w-full bg-slate-50 border-0 border-b-2 border-slate-200 focus:border-indigo-600 focus:ring-0 transition-all py-3 px-0 text-slate-900 placeholder-slate-300 resize-none"
                                      placeholder="Describa brevemente el tipo de propiedad, presupuesto o servicio que solicita..."></textarea>
                        </div>

                        <button type="submit" 
                                :disabled="loading"
                                class="w-full py-5 bg-[#0a0f1d] text-white text-[10px] font-black uppercase tracking-[0.3em] flex items-center justify-center gap-4 group transition-all hover:bg-indigo-600 disabled:opacity-50">
                            <span x-text="loading ? 'Procesando Solicitud...' : 'Solicitar Información Comercial'"></span>
                            <i x-show="!loading" class="fas fa-paper-plane group-hover:translate-x-2 transition-transform"></i>
                            <i x-show="loading" class="fas fa-circle-notch animate-spin"></i>
                        </button>
                    </form>

                    {{-- Estado de éxito --}}
                    <div x-show="enviado" x-transition:enter="transition ease-out duration-500" class="text-center py-20 space-y-6">
                        <div class="w-20 h-20 bg-emerald-50 text-emerald-500 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-check text-3xl"></i>
                        </div>
                        <h4 class="text-2xl font-black text-slate-900 tracking-tight">Solicitud Registrada</h4>
                        <p class="text-slate-500 max-w-xs mx-auto text-sm">Tus credenciales y datos de cotización han sido recibidos. Un asesor comercial se pondrá en contacto contigo a la brevedad.</p>
                        <button @click="enviado = false; nombre=''; email=''; mensaje='';" class="text-[10px] font-black uppercase tracking-widest text-indigo-600 hover:underline">
                            <i class="fas fa-redo mr-2"></i> Enviar otra consulta
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>