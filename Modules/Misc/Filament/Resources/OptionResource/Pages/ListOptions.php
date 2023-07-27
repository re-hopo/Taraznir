<?php

namespace Modules\Misc\Filament\Resources\OptionResource\Pages;

use Modules\Misc\Filament\Resources\OptionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOptions extends ListRecords
{
    protected static string $resource = OptionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
