<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EfficiencyMetricResource\Pages;
use App\Filament\Resources\EfficiencyMetricResource\RelationManagers;
use App\Models\EfficiencyMetric;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EfficiencyMetricResource extends Resource
{
    protected static ?string $model = EfficiencyMetric::class;

    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-bar';
    protected static ?string $navigationGroup = 'مؤشرات الأداء';
    protected static ?string $navigationLabel = 'مقياس الكفاءة';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('week')
                ->required()->label('الأسبوع'),
            Forms\Components\TextInput::make('used_resources')
                ->numeric()->required()->label('الموارد المستخدمة'),
            Forms\Components\TextInput::make('achieved_results')
                ->numeric()->required()->label('الإنجاز'),
            Forms\Components\TextInput::make('efficiency_percentage')
                ->numeric()->required()->label('الكفاءة (%)'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('week')->label('الأسبوع'),
            Tables\Columns\TextColumn::make('used_resources')->label('الموارد'),
            Tables\Columns\TextColumn::make('achieved_results')->label('الإنجاز'),
            Tables\Columns\TextColumn::make('efficiency_percentage')->label('الكفاءة')->suffix('%'),
        ])->defaultSort('week', 'asc');
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEfficiencyMetrics::route('/'),
            'create' => Pages\CreateEfficiencyMetric::route('/create'),
            'edit' => Pages\EditEfficiencyMetric::route('/{record}/edit'),
        ];
    }
}
