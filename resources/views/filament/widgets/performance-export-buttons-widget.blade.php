<x-filament::card>
    <h2 class="text-lg font-bold mb-2">📤 تصدير تقرير الأداء الأسبوعي</h2>
    <div class="flex gap-4">
        <x-filament::button wire:click="exportExcel" color="success" icon="heroicon-o-document-arrow-down">
            تحميل Excel
        </x-filament::button>
        <x-filament::button wire:click="exportPdf" color="danger" icon="heroicon-o-printer">
            تحميل PDF
        </x-filament::button>
    </div>
</x-filament::card>
