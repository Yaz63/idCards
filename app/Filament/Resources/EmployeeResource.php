<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeResource\Pages;
use App\Filament\Resources\EmployeeResource\RelationManagers;
use App\Models\Employee;
use App\Models\Job;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\Action;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;
    protected static ?string $navigationIcon = 'heroicon-o-collection';

    // protected static ?string $navigationGroup = 'الاعدادات';
    protected static ?string $pluralModelLabel = 'الموظفين';
    protected static ?string $modelLabel = 'الموظف';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('الاسم')
                    ->required()
                    ->maxLength(191),
                Forms\Components\TextInput::make('phone')
                    ->label('الرقم')
                    ->tel()
                    ->maxLength(191),
                Forms\Components\TextInput::make('email')
                    ->label('الايميل')
                    ->email()
                    ->maxLength(191),
                Forms\Components\textInput::make('job_no')
                    ->label('رقم الوظيفة')
                    ->label('Job No')
                    ->numeric(),
                Forms\Components\FileUpload::make('image')
                    ->label('الصورة')
                    ->image()
                    //->imageCropAspectRatio('16:9')
                    ->imageResizeTargetWidth('220')
                    ->imageResizeTargetHeight('220')
                    ->directory('employees'),
                Forms\Components\Select::make('status')
                    ->label('الحالة')
                    ->options([0 => 'Unconfirmed', 1 => 'Confirmed'])
                    ->default(0),
                Forms\Components\Select::make('job_id')
                    ->label('عنوان الوظيفة')
                    ->required()
                    ->options(Job::all()->pluck('title', 'id'))
                    ->searchable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('الاسم'),
                Tables\Columns\TextColumn::make('phone')->label('رقم الهاتف'),
                Tables\Columns\TextColumn::make('email')->label('الايميل'),
                Tables\Columns\TextColumn::make('job.title')->label('المسمى الوظيفي'),
                Tables\Columns\TextColumn::make('job_no')->label('رقم الوظيفة'),
                Tables\Columns\ImageColumn::make('image')->size(60)->label('الصورة'),
                Tables\Columns\IconColumn::make('stauts')
                    ->boolean()->label('الحالة')
                    ->getStateUsing(fn ($record) => $record->status == 1 ? true : false)
                    ,
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('print')
                ->url(fn (Employee $record): string => route('print_id', $record))
                ->openUrlInNewTab()
                ->label('')
                ->tooltip('طباعة')
                ->icon('heroicon-o-printer')
                ->color('secondary'),
                Tables\Actions\EditAction::make()->label('')->tooltip('تعديل'),
                Tables\Actions\DeleteAction::make()->label('')->tooltip('حذف'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageEmployees::route('/'),
        ];
    }
}
