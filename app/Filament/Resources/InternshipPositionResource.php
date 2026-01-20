<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InternshipPositionResource\Pages;
use App\Models\InternshipPosition;
use App\Models\User;
use BackedEnum;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class InternshipPositionResource extends Resource
{
    protected static ?string $model = InternshipPosition::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClock;

    protected static ?string $navigationLabel = 'Presensi';

    protected static ?string $modelLabel = 'Presensi';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Select::make('intern_id')
                    ->label('Peserta Magang')
                    ->options(User::where('role', 'intern')->pluck('name', 'id'))
                    ->required()
                    ->searchable()
                    ->preload(),
                
                DateTimePicker::make('date')
                    ->label('Tanggal')
                    ->required()
                    ->native(false),
                
                DateTimePicker::make('check_in_time')
                    ->label('Waktu Masuk')
                    ->required()
                    ->native(false),
                
                DateTimePicker::make('check_out_time')
                    ->label('Waktu Keluar')
                    ->native(false)
                    ->after('check_in_time'),
                
                Select::make('status')
                    ->label('Status')
                    ->options([
                        'present' => 'Hadir',
                        'late' => 'Terlambat',
                        'absent' => 'Tidak Hadir',
                        'excused' => 'Izin',
                    ])
                    ->required()
                    ->default('present'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('intern.name')
                    ->label('Nama Peserta')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('date')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),
                
                TextColumn::make('check_in_time')
                    ->label('Waktu Masuk')
                    ->dateTime('H:i')
                    ->sortable(),
                
                TextColumn::make('check_out_time')
                    ->label('Waktu Keluar')
                    ->dateTime('H:i')
                    ->sortable(),
                
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'present' => 'success',
                        'late' => 'warning',
                        'absent' => 'danger',
                        'excused' => 'info',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'present' => 'Hadir',
                        'late' => 'Terlambat',
                        'absent' => 'Tidak Hadir',
                        'excused' => 'Izin',
                        default => $state,
                    }),
                
                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('intern_id')
                    ->label('Peserta Magang')
                    ->relationship('intern', 'name'),
                
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'present' => 'Hadir',
                        'late' => 'Terlambat',
                        'absent' => 'Tidak Hadir',
                        'excused' => 'Izin',
                    ]),
                
                Tables\Filters\Filter::make('date')
                    ->form([
                        \Filament\Forms\Components\DatePicker::make('from')
                            ->label('Dari Tanggal'),
                        \Filament\Forms\Components\DatePicker::make('until')
                            ->label('Sampai Tanggal'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['from'], fn ($q) => $q->whereDate('date', '>=', $data['from']))
                            ->when($data['until'], fn ($q) => $q->whereDate('date', '<=', $data['until']));
                    }),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('date', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInternshipPositions::route('/'),
            'create' => Pages\CreateInternshipPosition::route('/create'),
            'edit' => Pages\EditInternshipPosition::route('/{record}/edit'),
        ];
    }
}
