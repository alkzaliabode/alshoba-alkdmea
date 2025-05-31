<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PerformanceIndicatorResource\Pages;
use App\Filament\Resources\PerformanceIndicatorResource\RelationManagers;
use App\Models\PerformanceIndicator;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PerformanceIndicatorResource extends Resource
{
       protected static ?string $model = PerformanceIndicator::class;

    protected static ?string $navigationIcon = 'heroicon-o-adjustments-horizontal';
    protected static ?string $navigationGroup = 'تقييم الأداء';
    protected static ?string $navigationLabel = 'مؤشرات الاداء';


    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('employee_id')
                ->relationship('employee', 'name')
                ->required()->label('الموظف'),
            Forms\Components\TextInput::make('indicator_name')
                ->required()->label('اسم المؤشر'),
            Forms\Components\TextInput::make('score')
                ->numeric()->required()->label('النتيجة (من 100)'),
            Forms\Components\DatePicker::make('evaluated_at')
                ->required()->label('تاريخ التقييم'),
            Forms\Components\Textarea::make('notes')->label('ملاحظات'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('employee.name')->label('الموظف'),
            Tables\Columns\TextColumn::make('indicator_name')->label('المؤشر'),
            Tables\Columns\TextColumn::make('score')->label('النتيجة'),
            Tables\Columns\TextColumn::make('evaluated_at')->label('تاريخ التقييم'),
        ])->defaultSort('evaluated_at', 'desc');
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPerformanceIndicators::route('/'),
            'create' => Pages\CreatePerformanceIndicator::route('/create'),
            'edit' => Pages\EditPerformanceIndicator::route('/{record}/edit'),
        ];
    }
}
