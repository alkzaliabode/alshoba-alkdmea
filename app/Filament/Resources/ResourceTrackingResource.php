<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ResourceTrackingResource\Pages;
use App\Filament\Resources\ResourceTrackingResource\RelationManagers;
use App\Models\ResourceTracking;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;

class ResourceTrackingResource extends Resource
{
    protected static ?string $model = ResourceTracking::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'التقارير اليومية';
    protected static ?string $navigationLabel = 'الموارد';

   public static function form(Form $form): Form
{
    return $form->schema([
        DatePicker::make('date')->required()->label('التاريخ'),

        Select::make('unit_type')
            ->label('نوع الوحدة')
            ->options([
                'cleaning' => 'وحدة النظافة العامة',
                'sanitation' => 'وحدة المنشآت الصحية',
            ])
            ->required()
            ->native(false),

        TextInput::make('employees_count')
            ->numeric()
            ->required()
            ->label('عدد الموظفين'),

        TextInput::make('hours_per_employee')
            ->numeric()
            ->required()
            ->label('ساعات عمل الموظف'),

        TextInput::make('total_working_hours')
            ->numeric()
            ->required()
            ->label('إجمالي الساعات'),
    ]);
}


    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('date')->label('التاريخ'),
            Tables\Columns\TextColumn::make('number_of_employees')->label('عدد الموظفين'),
            Tables\Columns\TextColumn::make('working_hours_per_employee')->label('ساعات/موظف'),
            Tables\Columns\TextColumn::make('total_working_hours')->label('إجمالي الساعات'),
        ])->defaultSort('date', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListResourceTrackings::route('/'),
            'create' => Pages\CreateResourceTracking::route('/create'),
            'edit' => Pages\EditResourceTracking::route('/{record}/edit'),
        ];
    }
}
