<?php

namespace App\Filament\Resources\Shop\CustomerResource\Pages;

use Filament\Pages\Actions;
use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\Shop\CustomerResource;

class ListCustomers extends ListRecords
{
    protected static string $resource = CustomerResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Action::make('submit')
                ->label(__('Save'))
                ->action(fn () =>  $this->submit())
                ->keyBindings(['command+s', 'ctrl+s'])
                ->disabled(fn () => false),
        ];
    }

    public function submit(): void
    {
        dd('test');
    }
}
