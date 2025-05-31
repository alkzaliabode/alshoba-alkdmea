<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DailyOperationResource\Pages;
use App\Filament\Resources\DailyOperationResource\RelationManagers;
use App\Models\DailyOperation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DailyOperationResource extends Resource
{
    protected static ?string $model = DailyOperation::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';
    protected static ?string $navigationGroup = 'سجل العمل اليومي';
    protected static ?string $navigationLabel = 'الاعمال اليومية';

       
    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\DatePicker::make('date')->required()->label('التاريخ'),
            Forms\Components\Select::make('shift')
                ->options([
                    'صباحي' => 'صباحي',
                    'مسائي' => 'مسائي',
                    'ليلي' => 'ليلي',
                ])
                ->required()->label('الوجبة'),
            Forms\Components\TextInput::make('type')->required()->label('نوع المهمة'),
            Forms\Components\TextInput::make('location')->required()->label('الموقع'),
            Forms\Components\Select::make('status')
                ->options([
                    'مكتمل' => 'مكتمل',
                    'قيد التنفيذ' => 'قيد التنفيذ',
                    'ملغى' => 'ملغى',
                ])
                ->required()->label('الحالة'),
            Forms\Components\Textarea::make('notes')->label('ملاحظات'),
            Forms\Components\TextInput::make('responsible_persons')->label('المسؤولون')->helperText('أدخل أسماء مفصولة بفواصل'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('date')->label('التاريخ')->sortable(),
            Tables\Columns\TextColumn::make('shift')->label('الوجبة'),
            Tables\Columns\TextColumn::make('type')->label('نوع المهمة'),
            Tables\Columns\TextColumn::make('location')->label('الموقع'),
            Tables\Columns\TextColumn::make('status')->label('الحالة'),
            Tables\Columns\TextColumn::make('responsible_persons')->label('المنفذون')->limit(30),
        ])->defaultSort('date', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDailyOperations::route('/'),
            'create' => Pages\CreateDailyOperation::route('/create'),
            'edit' => Pages\EditDailyOperation::route('/{record}/edit'),
        ];
    }
}
