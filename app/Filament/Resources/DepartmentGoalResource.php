<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DepartmentGoalResource\Pages;
use App\Models\DepartmentGoal;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables;

class DepartmentGoalResource extends Resource
{
    protected static ?string $model = DepartmentGoal::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('main_goal_id')
                ->relationship('mainGoal', 'goal_text')
                ->required()
                ->label('الهدف الرئيسي المرتبط'),

            Textarea::make('goal_text')
                ->required()
                ->label('هدف الشعبة'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('mainGoal.goal_text')
                    ->label('الهدف الرئيسي'),
                TextColumn::make('goal_text')
                    ->label('هدف الشعبة')
                    ->wrap(),
                TextColumn::make('created_at')
                    ->date()
                    ->label('تاريخ الإنشاء'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDepartmentGoals::route('/'),
            'create' => Pages\CreateDepartmentGoal::route('/create'),
            'edit' => Pages\EditDepartmentGoal::route('/{record}/edit'),
        ];
    }
}
