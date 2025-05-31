<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeResource\Pages;
use App\Models\Employee;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use AlperenErsoy\FilamentExport\Actions\FilamentExportHeaderAction;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationGroup = 'الموظفون';
    protected static ?string $navigationLabel = 'المنتسبين';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')
                ->required()
                ->label('الاسم'),

            TextInput::make('email')
                ->email()
                ->unique(ignoreRecord: true)
                ->required()
                ->label('البريد الإلكتروني'),

            TextInput::make('password')
                ->password()
                ->label('كلمة المرور')
                ->dehydrateStateUsing(fn($state) => filled($state) ? Hash::make($state) : null)
                ->required(fn(string $context) => $context === 'create')
                ->maxLength(255),

            TextInput::make('job_title')
                ->label('المسمى الوظيفي'),

            Select::make('department')
                ->options([
                    'نظافة' => 'نظافة',
                    'صيانة' => 'صيانة',
                    'منشآت صحية' => 'منشآت صحية',
                    'كاتب ذاتية' => 'كاتب ذاتية',
                    'المركز الصحي' => 'المركز الصحي',
                    'مسؤول وجبة' => 'مسؤول وجبة',
                    'مسؤول وحدة' => 'مسؤول وحدة',
                ])
                ->label('الوحدة'),

            Select::make('shift')
                ->options([
                    'صباحي' => 'صباحي',
                    'مسائي' => 'مسائي',
                    'ليلي' => 'ليلي',
                ])
                ->label('الوجبة'),

            TextInput::make('phone')
                ->label('رقم الهاتف'),

            Select::make('status')
                ->options([
                    'فعال' => 'فعال',
                    'موقوف' => 'موقوف',
                    'منقول' => 'منقول',
                ])
                ->default('فعال')
                ->label('الحالة'),

            Select::make('role')
                ->label('الدور')
                ->options(fn () => Role::where('guard_name', 'employee')->pluck('name', 'name')->toArray())
                ->required()
                ->dehydrated(false) // لا يُحفظ مباشرة
                ->afterStateHydrated(function ($state, $component, $record) {
                    if ($record && $record->roles()->exists()) {
                        $component->state($record->roles->first()->name);
                    }
                }),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
                Tables\Columns\TextColumn::make('name')->label('الاسم'),
                Tables\Columns\TextColumn::make('email')->label('البريد الإلكتروني'),
                Tables\Columns\TextColumn::make('job_title')->label('المسمى'),
                Tables\Columns\TextColumn::make('department')->label('الوحدة'),
                Tables\Columns\TextColumn::make('shift')->label('الوجبة'),
                Tables\Columns\TextColumn::make('phone')->label('الهاتف'),
                Tables\Columns\TextColumn::make('status')->label('الحالة'),
            ])
            ->defaultSort('name')
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
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}