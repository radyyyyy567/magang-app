<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DailyAttendanceResource\Pages;
use App\Models\DailyAttendance;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\BulkActionGroup;
use BackedEnum;
use Filament\Schemas\Schema;

class DailyAttendanceResource extends Resource
{
    protected static ?string $model = DailyAttendance::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-clipboard-document-list';
    
    protected static ?string $navigationLabel = 'Data Presensi Harian';
    
    protected static ?string $modelLabel = 'Presensi Harian';

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        if (Auth::user() && Auth::user()->role === 'intern') {
            return $query->where('user_id', Auth::id());
        }

        return $query;
    }

    public static function canCreate(): bool
    {
        return Auth::user() && Auth::user()->role !== 'intern';
    }

    public static function canEdit($record): bool
    {
        return Auth::user() && Auth::user()->role !== 'intern';
    }

    public static function canDelete($record): bool
    {
        return Auth::user() && Auth::user()->role !== 'intern';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Forms\Components\DatePicker::make('date')
                    ->required(),
                Forms\Components\TimePicker::make('check_in'),
                Forms\Components\TimePicker::make('check_out'),
                Forms\Components\Select::make('status')
                    ->options([
                        'present' => 'Present',
                        'late' => 'Late',
                        'absent' => 'Absent',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Nama Intern')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('check_in')
                    ->time(),
                Tables\Columns\TextColumn::make('check_out')
                    ->time(),
                Tables\Columns\TextColumn::make('status')
                    ->badge(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status'),
            ])
            ->actions([
                EditAction::make()
                    ->hidden(fn () => Auth::user()->role === 'intern'),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ])
                ->hidden(fn () => Auth::user()->role === 'intern'),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDailyAttendances::route('/'),
            'create' => Pages\CreateDailyAttendance::route('/create'),
            'edit' => Pages\EditDailyAttendance::route('/{record}/edit'),
        ];
    }
}
