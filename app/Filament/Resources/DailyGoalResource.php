<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DailyGoalResource\Pages;
use App\Filament\Resources\DailyGoalResource\RelationManagers;
use App\Models\DailyGoal;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DailyGoalResource extends Resource
{
    protected static ?string $model = DailyGoal::class;

protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';
    protected static ?string $navigationGroup = 'التقارير اليومية';
protected static ?string $navigationLabel = 'الأهداف';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\DatePicker::make('date')->required(),
            Forms\Components\TextInput::make('cleaning_department_goal')
                ->numeric()->required()->label('هدف  النظافة العامة'),
            Forms\Components\TextInput::make('maintenance_department_goal')
                ->numeric()->required()->label('هدف المنشات الصحية'),
            Forms\Components\TextInput::make('total_goal')
                ->numeric()->required()->label('الهدف الكلي'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('date')->label('التاريخ'),
            Tables\Columns\TextColumn::make('cleaning_department_goal')->label('النظافة العامة'),
            Tables\Columns\TextColumn::make('maintenance_department_goal')->label('المنشات الصحية'),
            Tables\Columns\TextColumn::make('total_goal')->label('الإجمالي'),
        ])->defaultSort('date', 'desc');
    }



    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDailyGoals::route('/'),
            'create' => Pages\CreateDailyGoal::route('/create'),
            'edit' => Pages\EditDailyGoal::route('/{record}/edit'),
        ];
    }
}
