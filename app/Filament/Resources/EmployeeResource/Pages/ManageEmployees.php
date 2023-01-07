<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use App\Filament\Resources\EmployeeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;
use Filament\Tables\Actions\BulkAction;
use Filament\Forms;
use Filament\Resources\Form;
use App\Models\Employee;

class ManageEmployees extends ManageRecords
{
    protected static string $resource = EmployeeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\CreateAction::make('notify')
            ->url(fn (): string => route('notify'))->label('اشعار الموظفين')->tooltip('ااشعار الموظفين')
        ];
    }

}
