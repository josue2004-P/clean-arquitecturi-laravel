@props([
    'title',
    'desc' => null,
    'icon' => 'fa-shield-halved',
    'breadcrumb' => [] 
])

<div {{ $attributes->merge(['class' => 'mb-8 sm:mb-10 flex flex-col lg:flex-row lg:items-start lg:justify-between gap-6 font-sans']) }}>
    <div class="flex flex-col sm:flex-row items-start gap-4 sm:gap-5 text-left">
        <div class="h-12 w-12 flex-shrink-0 rounded-xl bg-indigo-50/50 dark:bg-indigo-500/5 flex items-center justify-center text-indigo-600 dark:text-indigo-400 border border-indigo-100/50 dark:border-indigo-500/10 shadow-sm transition-transform duration-200 hover:scale-105">
            <i class="fa-solid {{ $icon }} text-lg"></i>
        </div>
        
        <div class="space-y-1">
            <h1 class="text-xl font-bold text-gray-900 dark:text-white tracking-tight leading-tight transition-colors">
                {{ $title }}
            </h1>
            @if($desc)
                <p class="text-xs font-medium text-gray-500 dark:text-gray-400 max-w-xl transition-colors">
                    {{ $desc }}
                </p>
            @endif
        </div>
    </div>

    @if(!empty($breadcrumb))
        <nav class="flex flex-wrap items-center justify-start lg:justify-start gap-x-2 gap-y-2 text-sm font-bold border-t border-gray-100 pt-4 lg:border-none lg:pt-0 transition-colors">
            @foreach($breadcrumb as $item)
                <div class="flex items-center gap-2">
                    @if(!empty($item['url']))
                        <a href="{{ $item['url'] }}" class="inline-flex items-center justify-center px-3 py-1.5 rounded-lg bg-gray-50 dark:bg-gray-900 text-gray-500 dark:text-gray-400 border border-gray-100 dark:border-gray-800/60 hover:text-indigo-600 dark:hover:text-indigo-400 hover:border-indigo-100 dark:hover:border-indigo-900/30 hover:bg-indigo-50/30 dark:hover:bg-indigo-500/5 transition-all whitespace-nowrap shadow-xs">
                            {{ $item['label'] }}
                        </a>
                    @else
                        <span class="inline-flex items-center justify-center px-3 py-1.5 rounded-lg bg-gray-100/70 dark:bg-gray-800/50 text-gray-700 dark:text-gray-300 border border-transparent transition-colors whitespace-nowrap">
                            {{ $item['label'] }}
                        </span>
                    @endif
                    
                    @if(!$loop->last)
                        <i class="fa-solid fa-chevron-right text-[9px] text-gray-400 dark:text-gray-600 mx-0.5 opacity-60"></i>
                    @endif
                </div>
            @endforeach
        </nav>
    @endif
</div>