<?php

namespace Modules\News\app\Filament\Resources\NewsResource\Pages;

use Modules\News\app\Filament\Resources\NewsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNews extends EditRecord
{
    protected static string $resource = NewsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
