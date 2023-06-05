<?php

namespace App\Filament\Pages;

use App\Models\Settings;
use Filament\Pages\Page;
use Filament\Pages\Actions\Action;
use Illuminate\Support\HtmlString;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Wizard;
use Filament\Support\Exceptions\Halt;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Wizard\Step;
use Filament\Pages\Concerns\HasFormActions;
use Filament\Forms\Components\TextInput\Mask;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Support\Concerns\EvaluatesClosures;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Filament\Support\Actions\Concerns\InteractsWithRecord;
use Filament\Pages\Contracts\HasFormActions as HasFormActionsContract;

class SettingsPage extends Page implements HasForms, HasFormActionsContract
{

    use InteractsWithForms;
    use HasFormActions;
    use InteractsWithRecord;
    use EvaluatesClosures;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.settings-page';

    protected function getFormSchema(): array
    {
        return [
            Wizard::make([
                Step::make(__('labels.company'))
                    ->id(1)
                    ->schema([
                        Card::make([
                            Group::make([
                                Group::make([])->columnSpan(1),
                                FileUpload::make('logo')
                                    ->disableLabel()
                                    ->disk('logos')
                                    ->visibility('public')
                                    ->image()
                                    ->imagePreviewHeight('300')
                                    ->imageResizeMode('contain')
                                    ->imageResizeTargetWidth('464')
                                    ->imageResizeTargetHeight('261')
                                    ->panelAspectRatio('16:9')
                                    ->loadingIndicatorPosition('right')
                                    ->uploadButtonPosition('right')
                                    ->removeUploadedFileButtonPosition('right')
                                    ->uploadProgressIndicatorPosition('right')
                                    ->panelLayout('circle')
                                    ->columnSpan(9),
                            ])->columns(12),

                            Fieldset::make(__('labels.company'))
                                ->schema([
                                    TextInput::make('name')
                                        ->label(__('labels.company_name'))
                                        ->required()
                                        ->columnSpanFull(),
                                    TextInput::make('slogan')
                                        ->label(__('labels.slogan'))
                                        ->columnSpanFull(),
                                    TextInput::make('nif')
                                        ->label(__('labels.nif'))
                                        ->required(),
                                ])->columnSpan(1)
                        ])->columns(2),
                    ]),
                Step::make(__('labels.company'))
                    ->id(1.2)
                    ->schema([
                        Card::make([
                            Select::make('testSelect')
                                ->options([
                                    1 => 'uno',
                                    2 => 'dos',
                                    3 => 'tres',
                                ])->preload()
                                ->searchable(),
                        ])->columns(2),
                    ]),
                Step::make(__('labels.taxes'))
                    ->id(3)
                    ->schema([
                        Repeater::make('taxNumbers')
                            ->label(__('Tax numbers'))
                            ->disableItemDeletion()
                            ->schema([
                                Hidden::make('country_code')
                                    ->default('DO'),
                                TextInput::make('length')
                                    ->label(__('labels.length'))
                                    ->default(8)
                                    ->numeric()
                                    ->disabled(),
                                TextInput::make('prefix')
                                    ->label(__('labels.prefix'))
                                    ->default('B01')
                                    ->disabled(),
                                TextInput::make('from')
                                    ->label(__('labels.from'))
                                    ->numeric()
                                    ->required()
                                    ->default(1),
                                TextInput::make('to')
                                    ->label(__('labels.to'))
                                    ->numeric()
                                    ->required()
                                    ->default(100),
                                DatePicker::make('expiration_date')
                                    ->label(__('labels.expiration_date'))
                                    ->required()
                                    ->closeOnDateSelection(),
                            ]),
                    ]),
                Step::make(__('labels.plans'))
                    ->id(4)
                    ->schema([]),
            ])
                ->submitAction(new HtmlString('
                    <x-filament::button type="submit" form="finishSetup" class="w-full my-8">
                        @lang("Finish setup")
                    </x-filament::button>
                ')),
        ];
    }


    /**
     * @return void
     */
    public function mount(): void
    {
        $this->record = Settings::first();

        $this->fillForm();
    }

    /**
     * @return array
     */
    protected function getFormActions(): array
    {
        return [];
    }

    /**
     * @return string|null
     */
    protected function getRedirectUrl(): ?string
    {
        return static::getUrl();
    }

    public function getRecord(): Model
    {
        return $this->record;
    }

    /**
     * @return void
     */
    public function finishSetup(): void
    {

        try {
            $data = $this->form->getState();

            $this->record = Settings::find($this->record->id);

            $this->record->update($data);

            $this->fillForm();
        } catch (Halt $exception) {
            return;
        }

        Notification::make()
            ->success()
            ->body(__('messages.settings_updated_succesfully'))
            ->send();
    }

    /**
     * @return void
     */
    protected function fillForm(): void
    {
        $data = $this->getRecord()->attributesToArray();

        $data = $this->mutateFormDataBeforeFill($data);

        $this->form->fill($data);
    }

    /**
     * @param array $data
     * 
     * @return array
     */
    protected function mutateFormDataBeforeFill(array $data): array
    {
        return $data;
    }
}
