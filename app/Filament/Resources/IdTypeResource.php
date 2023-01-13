<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IdTypeResource\Pages;
use App\Filament\Resources\IdTypeResource\RelationManagers;
use App\Models\IdType;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class IdTypeResource extends Resource
{
    protected static ?string $model = IdType::class;
    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $pluralModelLabel = 'انواع الوثائق';
    protected static ?string $modelLabel = 'نوع البطاقة';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                ->label('الاسم')
                    ->required()
                    ->maxLength(191),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('الاسم'),
            ])
            ->filters([
                //
            ])
            ->actions([
             
                Tables\Actions\EditAction::make()->label('')->tooltip('تعديل'),
                Tables\Actions\DeleteAction::make()->label('')->tooltip('حذف'),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageIdTypes::route('/'),
        ];
    }
}
