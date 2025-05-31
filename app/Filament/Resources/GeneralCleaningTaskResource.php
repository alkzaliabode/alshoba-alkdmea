<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GeneralCleaningTaskResource\Pages;
use App\Models\GeneralCleaningTask;
use App\Models\Employee;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\MultiSelect;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use AlperenErsoy\FilamentExport\Actions\FilamentExportHeaderAction;

class GeneralCleaningTaskResource extends Resource
{
    protected static ?string $model = GeneralCleaningTask::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog';
    protected static ?string $navigationGroup = 'وحدة النظافة العامة';
    protected static ?string $navigationLabel = 'مهام النظافة العامة';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                DatePicker::make('date')->required()->label('التاريخ'),

                Select::make('shift')
                    ->options([
                        'صباحي' => 'صباحي',
                        'مسائي' => 'مسائي',
                        'ليلي' => 'ليلي',
                    ])
                    ->required()->label('الوجبة'),

                Select::make('task_type')
                    ->options([
                        'تفريغ حاويات' => 'تفريغ حاويات',
                        'كبس حاويات' => 'كبس حاويات',
                        'فرش سجاد' => 'فرش سجاد',
                        'رفع سجاد' => 'رفع سجاد',
                        'ملء ترامز' => 'ملء ترامز',
                        'رفع ترامز' => 'رفع ترامز',
                        'تنظيف قاعة' => 'تنظيف قاعة',
                        'تنظيف ساحة' => 'تنظيف ساحة',
                        'أخرى' => 'أخرى',
                    ])
                    ->required()->label('نوع المهمة')->reactive(),

                TextInput::make('location')->required()->label('الموقع'),

                TextInput::make('quantity')
                    ->numeric()
                    ->visible(fn ($get) => in_array($get('task_type'), ['تفريغ حاويات', 'كبس حاويات', 'فرش سجاد', 'رفع سجاد', 'ملء ترامز', 'رفع ترامز']))
                    ->required(fn ($get) => in_array($get('task_type'), ['تفريغ حاويات', 'كبس حاويات', 'فرش سجاد', 'رفع سجاد', 'ملء ترامز', 'رفع ترامز']))
                    ->label('الكمية'),

                Select::make('status')->options([
                    'مكتمل' => 'مكتمل',
                    'قيد التنفيذ' => 'قيد التنفيذ',
                    'ملغى' => 'ملغى',
                ])->required()->label('الحالة'),

                Textarea::make('notes')->label('ملاحظات'),

                MultiSelect::make('employees')
                    ->label('المنفذون')
                    ->options(\App\Models\Employee::pluck('name', 'id'))

                    ->required()
                    ->searchable()
                    ->preload(),
          
                
             ]);
    }

  public static function table(Table $table): Table
{
    return $table->columns([
        Tables\Columns\TextColumn::make('date')->label('التاريخ'),
        Tables\Columns\TextColumn::make('shift')->label('الوجبة'),
        Tables\Columns\TextColumn::make('task_type')->label('المهمة'),
        Tables\Columns\TextColumn::make('location')->label('الموقع'),
        Tables\Columns\TextColumn::make('quantity')->label('الكمية')->sortable()->toggleable(),
        Tables\Columns\TextColumn::make('status')->label('الحالة'),
        Tables\Columns\TextColumn::make('employees.name')
            ->label('المنفذون')
            ->listWithLineBreaks()
            ->limitList(3),
    ])
    ->defaultSort('date', 'desc')
    ->bulkActions([
        FilamentExportBulkAction::make('export'),
    ])
    ->headerActions([
        FilamentExportHeaderAction::make('export'),
    ]);
}

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGeneralCleaningTasks::route('/'),
            'create' => Pages\CreateGeneralCleaningTask::route('/create'),
            'edit' => Pages\EditGeneralCleaningTask::route('/{record}/edit'),
        ];
    }
}
