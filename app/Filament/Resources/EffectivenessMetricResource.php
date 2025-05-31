<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EffectivenessMetricResource\Pages;
use App\Filament\Resources\EffectivenessMetricResource\RelationManagers;
use App\Models\EffectivenessMetric;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EffectivenessMetricResource extends Resource
{
    protected static ?string $model = EffectivenessMetric::class;

    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-line';
    protected static ?string $navigationGroup = 'مؤشرات الأداء';
    protected static ?string $navigationLabel = 'مقياس الفعالية';


    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('week')
                ->required()->label('الأسبوع'),
            Forms\Components\TextInput::make('planned_goals')
                ->numeric()->required()->label('الأهداف المخططة'),
            Forms\Components\TextInput::make('achieved_results')
                ->numeric()->required()->label('الإنجاز الفعلي'),
            Forms\Components\TextInput::make('effectiveness_percentage')
                ->numeric()->required()->label('الفعالية (%)'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('week')->label('الأسبوع'),
            Tables\Columns\TextColumn::make('planned_goals')->label('الأهداف'),
            Tables\Columns\TextColumn::make('achieved_results')->label('الإنجاز'),
            Tables\Columns\TextColumn::make('effectiveness_percentage')->label('الفعالية')->suffix('%'),
        ])->defaultSort('week', 'asc');
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEffectivenessMetrics::route('/'),
            'create' => Pages\CreateEffectivenessMetric::route('/create'),
            'edit' => Pages\EditEffectivenessMetric::route('/{record}/edit'),
        ];
    }
}
