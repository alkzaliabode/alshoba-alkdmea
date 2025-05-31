<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActualResultResource\Pages;
use App\Models\ActualResult;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;

class ActualResultResource extends Resource
{
    protected static ?string $model = ActualResult::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static ?string $navigationGroup = 'التقارير اليومية';
    protected static ?string $navigationLabel = 'النتائج';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('unit_type')
                ->label('نوع الوحدة')
                ->options([
                    'cleaning' => 'وحدة النظافة العامة',
                    'sanitation' => 'وحدة المنشآت الصحية',
                ])
                ->required()
                ->reactive(),

            Select::make('unit_goal_id')
                ->label('الهدف المرتبط')
                ->relationship('goal', 'goal_text') // العلاقة مع جدول الأهداف
                ->searchable()
                ->preload()
                ->required()
                ->visible(fn (callable $get) => filled($get('unit_type'))),

            DatePicker::make('date')
                ->required()
                ->label('تاريخ النتيجة'),

            TextInput::make('completed_tasks')
                ->numeric()
                ->required()
                ->label('عدد المهام المكتملة'),

            TextInput::make('in_progress_tasks')
                ->numeric()
                ->required()
                ->label('قيد التنفيذ'),

            TextInput::make('cancelled_tasks')
                ->numeric()
                ->required()
                ->label('ملغى'),

            TextInput::make('completion_percentage')
                ->numeric()
                ->required()
                ->label('نسبة الإنجاز'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('goal.goal_text')->label('نص الهدف'),
            TextColumn::make('date')->label('تاريخ النتيجة'),
            TextColumn::make('completed_tasks')->label('مكتمل'),
            TextColumn::make('in_progress_tasks')->label('قيد التنفيذ'),
            TextColumn::make('cancelled_tasks')->label('ملغى'),
            TextColumn::make('completion_percentage')->label('نسبة الإنجاز')->suffix('%'),
            TextColumn::make('unit_type')
                ->label('نوع الوحدة')
                ->formatStateUsing(fn ($state) => $state === 'cleaning' ? 'نظافة' : 'منشآت'),
        ])
        ->defaultSort('date', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListActualResults::route('/'),
            'create' => Pages\CreateActualResult::route('/create'),
            'edit' => Pages\EditActualResult::route('/{record}/edit'),
        ];
    }
}
