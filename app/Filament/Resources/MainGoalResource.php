<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MainGoalResource\Pages;
use App\Models\MainGoal;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class MainGoalResource extends Resource
{
    protected static ?string $model = MainGoal::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Textarea::make('goal_text')
                ->required()
                ->label('الهدف الرئيسي'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('goal_text')
                    ->label('الهدف الرئيسي')
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
            'index' => Pages\ListMainGoals::route('/'),
            'create' => Pages\CreateMainGoal::route('/create'),
            'edit' => Pages\EditMainGoal::route('/{record}/edit'),
        ];
    }
}
