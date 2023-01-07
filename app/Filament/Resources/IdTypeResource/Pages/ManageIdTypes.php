<?php

namespace App\Filament\Resources\IdTypeResource\Pages;

use App\Filament\Resources\IdTypeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageIdTypes extends ManageRecords
{
    protected static string $resource = IdTypeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
