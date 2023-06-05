<x-filament::page class="filament-resources-edit-record-page">
    @capture($form)
        <x-filament::form wire:submit.prevent="save">

            <div class="grid grid-cols-1 gap-4 place-items-end">
                <x-filament::form.actions :actions="$this->getCachedFormActions()" :full-width="$this->hasFullWidthFormActions()"/>
            </div>

            {{ $this->form }}
            
        </x-filament::form>
    @endcapture

    {{ $form() }}

</x-filament::page>