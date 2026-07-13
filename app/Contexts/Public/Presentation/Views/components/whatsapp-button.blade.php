{{-- WhatsApp Floating Button: Estética Inmobiliaria --}}
<div x-data="{ showMessage: false }" 
     x-init="setTimeout(() => showMessage = true, 2000)"
     class="fixed bottom-8 right-8 z-[100] flex flex-col items-end gap-4">
    
    {{-- Tooltip / Mensaje de sugerencia --}}
    <div x-show="showMessage" 
         x-transition:enter="transition ease-out duration-500"
         x-transition:enter-start="opacity-0 translate-y-4"
         x-transition:leave="transition ease-in duration-300"
         class="bg-white px-5 py-3 shadow-[0_20px_50px_rgba(0,0,0,0.1)] border border-slate-100 rounded-sm relative max-w-[200px]">
        
        <button @click="showMessage = false" class="absolute -top-2 -right-2 bg-slate-900 text-white rounded-full w-5 h-5 text-[8px] flex items-center justify-center hover:bg-indigo-600 transition-colors">
            <i class="fas fa-times"></i>
        </button>
        
        <div class="flex items-center gap-3 mb-1">
            <i class="fas fa-comment-dots text-indigo-600 text-xs"></i>
            <p class="text-[10px] font-black text-slate-900 uppercase tracking-widest leading-none">Asesoría Directa</p>
        </div>
        <p class="text-[9px] text-slate-400 uppercase tracking-tighter font-medium leading-tight">Consulta disponibilidad y agenda citas en tiempo real</p>
    </div>

    {{-- Botón con Icono FontAwesome --}}
    <a href="https://wa.me/523521234567?text={{ urlencode('Hola, me gustaría solicitar información sobre las propiedades disponibles y opciones de inversión.') }}" 
       target="_blank"
       class="relative group bg-[#25D366] w-16 h-16 rounded-full shadow-[0_10px_30px_rgba(37,211,102,0.4)] transition-all duration-300 hover:scale-110 active:scale-95 flex items-center justify-center">
        
        {{-- Efecto de pulso concéntrico --}}
        <span class="absolute inset-0 rounded-full bg-[#25D366] animate-ping opacity-25"></span>
        
        {{-- Icono FA --}}
        <i class="fab fa-whatsapp text-white text-3xl relative z-10"></i>
    </a>
</div>