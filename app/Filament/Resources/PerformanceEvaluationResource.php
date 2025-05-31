<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PerformanceEvaluationResource\Pages;
use App\Models\PerformanceEvaluation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;


class PerformanceEvaluationResource extends Resource
{
protected static ?string $model = PerformanceEvaluation::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';
    protected static ?string $navigationGroup = 'تقييم الأداء';
    protected static ?string $navigationLabel = ' تقييمات الاداء';


    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('employee_id')
                ->relationship('employee', 'name')
                ->required()->label('الموظف'),
            DatePicker::make('evaluation_date')->required()->label('تاريخ التقييم'),
            TextInput::make('tasks_completed')->numeric()->required()->label('المهام المنجزة'),
            TextInput::make('goals_assigned')->numeric()->required()->label('المهام المطلوبة'),
            TextInput::make('efficiency')->numeric()->required()->label('الكفاءة (%)'),
            TextInput::make('effectiveness')->numeric()->required()->label('الفعالية (%)'),
            Textarea::make('notes')->label('ملاحظات'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('employee.name')->label('الموظف'),
            Tables\Columns\TextColumn::make('evaluation_date')->label('تاريخ التقييم'),
            Tables\Columns\TextColumn::make('tasks_completed')->label('منجز'),
            Tables\Columns\TextColumn::make('goals_assigned')->label('مطلوب'),
            Tables\Columns\TextColumn::make('efficiency')->label('الكفاءة')->suffix('%'),
            Tables\Columns\TextColumn::make('effectiveness')->label('الفعالية')->suffix('%'),
        ])->defaultSort('evaluation_date', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPerformanceEvaluations::route('/'),
            'create' => Pages\CreatePerformanceEvaluation::route('/create'),
            'edit' => Pages\EditPerformanceEvaluation::route('/{record}/edit'),
        ];
    }
}
