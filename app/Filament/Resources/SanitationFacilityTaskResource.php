<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SanitationFacilityTaskResource\Pages;
use App\Models\SanitationFacilityTask;
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
use Illuminate\Database\Eloquent\SoftDeletingScope;
use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use AlperenErsoy\FilamentExport\Actions\FilamentExportHeaderAction;

class SanitationFacilityTaskResource extends Resource
{
    protected static ?string $model = SanitationFacilityTask::class;

    protected static ?string $navigationGroup = 'وحدة المنشآت الصحية';
    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';
    protected static ?string $navigationLabel = 'مهام المنشات الصحية';

    public static function form(Form $form): Form
    {
        return $form->schema([
            DatePicker::make('date')->required()->label('التاريخ'),

            Select::make('shift')
                ->options([
                    'صباحي' => 'صباحي',
                    'مسائي' => 'مسائي',
                    'ليلي' => 'ليلي',
                ])
                ->required()
                ->label('الوجبة'),

            TextInput::make('task_type')->required()->label('نوع المهمة'),
            TextInput::make('facility_name')->required()->label('اسم المرفق الصحي'),
            TextInput::make('details')->required()->label('تفاصيل المهمة'),

            Select::make('status')
                ->options([
                    'مكتمل' => 'مكتمل',
                    'قيد التنفيذ' => 'قيد التنفيذ',
                    'ملغى' => 'ملغى',
                ])
                ->required()
                ->label('الحالة'),

            Textarea::make('notes')->label('ملاحظات'),

            // ✅ حقل جديد لربط الموظفين عبر العلاقة Many-to-Many
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
            Tables\Columns\TextColumn::make('task_type')->label('نوع المهمة'),
            Tables\Columns\TextColumn::make('facility_name')->label('المرفق الصحي'),
            Tables\Columns\TextColumn::make('details')->label('تفاصيل'),
            Tables\Columns\TextColumn::make('status')->label('الحالة'),

            // ✅ عرض أسماء الموظفين المنفذين
            Tables\Columns\TextColumn::make('employees.name')
                ->label('المنفذون')
                ->limitList(3)
                ->separator(', ')
                ->tooltip(function ($record) {
                    return $record->employees->pluck('name')->join(', ');
                }),
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
            'index' => Pages\ListSanitationFacilityTasks::route('/'),
            'create' => Pages\CreateSanitationFacilityTask::route('/create'),
            'edit' => Pages\EditSanitationFacilityTask::route('/{record}/edit'),
        ];
    }
}
