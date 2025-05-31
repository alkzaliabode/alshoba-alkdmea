<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UnitGoalResource\Pages;
use App\Models\UnitGoal;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UnitGoalResource extends Resource
{
    protected static ?string $model = UnitGoal::class;
    protected static ?string $navigationIcon = 'heroicon-o-flag';
    protected static ?string $modelLabel = 'هدف وحدة';
    protected static ?string $navigationGroup = 'إدارة الأهداف';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('المعلومات الأساسية')->schema([
                Select::make('department_goal_id')
                    ->relationship('departmentGoal', 'goal_text')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->label('هدف الشعبة'),

                TextInput::make('unit_name')
                    ->required()
                    ->maxLength(100)
                    ->label('اسم الوحدة'),
            ])->columns(2),

            Section::make('تفاصيل الهدف')->schema([
                Textarea::make('goal_text')
                    ->required()
                    ->columnSpanFull()
                    ->label('وصف الهدف'),

                TextInput::make('target_value')
                    ->numeric()
                    ->required()
                    ->label('القيمة المستهدفة'),

                Toggle::make('is_active')
                    ->label('مفعل')
                    ->default(true),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('departmentGoal.goal_text')
                    ->label('هدف الشعبة')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('unit_name')
                    ->label('الوحدة')
                    ->searchable(),

                TextColumn::make('target_value')
                    ->label('الهدف')
                    ->suffix('%')
                    ->sortable(),

                IconColumn::make('is_active')
                    ->label('الحالة')
                    ->boolean(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('unit_name')
                    ->label('تصفية حسب الوحدة')
                    ->options([
                        'النظافة' => 'وحدة النظافة',
                        'المرافق' => 'وحدة المرافق الصحية',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    // ... بقية الدوال


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUnitGoals::route('/'),
            'create' => Pages\CreateUnitGoal::route('/create'),
            'edit' => Pages\EditUnitGoal::route('/{record}/edit'),
        ];
    }
}
