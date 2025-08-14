<div x-show="dialogInfo" class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div x-show="dialogInfo"
    x-transition:enter="ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 bg-zinc-500/75 transition-opacity" aria-hidden="true"></div>

    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div x-show="dialogInfo"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            @click.outside="dialogInfo = false"
            class="dialog-info relative transform overflow-hidden rounded-lg bg-white dark:bg-zinc-800 p-6 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-md">
                <div class="flex -mx-6 -mt-6 mb-6 px-4 py-2 bg-zinc-100 dark:bg-zinc-700 dark:text-white border-b border-zinc-200 dark:border-zinc-600">
                    <span class="font-semibold">{{ __('common.about') }} ELSA</span>
                    <button
                        type="button"
                        @click="dialogInfo = false"
                        class="px-3 py-2 -my-2 -mr-4 ml-auto transition ease-in-out duration-300 cursor-pointer hover:bg-red-600 hover:text-white"
                        title="{{ __('common.close') }}"
                    >
                        <span aria-hidden="true">@svg('mdi-close', 'size-5')</span>
                        <span class="sr-only">{{ __('common.close') }}</span>
                    </button>
                </div>
                <div>
                    <div class="text-center">
                        <h3 class="text-xl font-bold text-zinc-800 dark:text-white">ELSA <span class="font-normal ml-1"> 1.0.0-alpha</span></h3>
                        <div class="mt-2">
                            <p class="text-zinc-800 dark:text-white hyphens-none">Elektronisches System für Abstimmungen</p>
                        </div>
                        <div class="mt-6">
                            <p class="text-zinc-800 dark:text-white mb-2">&copy; 2024&ndash;{{ date('Y') }} Marc Schlagenhauf</p>
                        </div>
                        <div class="mt-8">
                            <div class="grid grid-cols-2 gap-3">
                                <a wire:navigate class="btn-neutral" href="{{ route('imprint') }}"><span class="mx-auto">{{ __('common.imprint') }}</span></a>
                                <a wire:navigate class="btn-neutral" href="{{ route('privacy') }}"><span class="mx-auto">{{ __('common.privacyPolicy') }}</span></a>
                                <a wire:navigate class="btn-neutral" href="{{ route('accessibility') }}"><span class="mx-auto">{{ __('common.accessibility') }}</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
