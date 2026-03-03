<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LowonganResource\Pages;
use App\Models\Lowongan;
use App\Models\Division;
use App\Models\User;
use BackedEnum;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LowonganResource extends Resource
{
    protected static ?string $model = Lowongan::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBriefcase; // Changed icon to briefcase for clarity

    protected static ?string $navigationLabel = 'Lowongan';

    protected static ?string $modelLabel = 'Lowongan';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Select::make('division_id')
                    ->label('Divisi')
                    ->relationship('division', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),
                
                Select::make('mentor_id')
                    ->label('Pembimbing')
                    ->options(User::where('role', 'mentor')->pluck('name', 'id'))
                    ->required()
                    ->searchable()
                    ->preload(),
                
                TextInput::make('title')
                    ->label('Judul')
                    ->required()
                    ->maxLength(225),
                
                Textarea::make('description')
                    ->label('Deskripsi')
                    ->required()
                    ->columnSpanFull(),
                
                TextInput::make('quota')
                    ->label('Kuota')
                    ->required()
                    ->numeric()
                    ->minValue(1),
                
                \Filament\Forms\Components\Repeater::make('monthly_data')
                    ->label('Target Perbulan')
                    ->schema([
                        Select::make('month')
                            ->label('Bulan')
                            ->options([
                                'Januari' => 'Januari',
                                'Februari' => 'Februari',
                                'Maret' => 'Maret',
                                'April' => 'April',
                                'Mei' => 'Mei',
                                'Juni' => 'Juni',
                                'Juli' => 'Juli',
                                'Agustus' => 'Agustus',
                                'September' => 'September',
                                'Oktober' => 'Oktober',
                                'November' => 'November',
                                'Desember' => 'Desember',
                            ])
                            ->required(),
                        TextInput::make('target')
                            ->label('Target Qouta')
                            ->numeric()
                            ->required(),
                    ])
                    ->columnSpanFull(),

                Select::make('status')
                    ->label('Status')
                    ->options([
                        'open' => 'Buka',
                        'closed' => 'Tutup',
                    ])
                    ->required()
                    ->default('open'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('division.name')
                    ->label('Divisi')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('mentor.name')
                    ->label('Pembimbing')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('quota')
                    ->label('Kuota')
                    ->sortable(),
                
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'open' => 'success',
                        'closed' => 'danger',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'open' => 'Buka',
                        'closed' => 'Tutup',
                    }),
                
                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('division_id')
                    ->label('Divisi')
                    ->relationship('division', 'name'),
                
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'open' => 'Buka',
                        'closed' => 'Tutup',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLowongans::route('/'),
            'create' => Pages\CreateLowongan::route('/create'),
            'edit' => Pages\EditLowongan::route('/{record}/edit'),
        ];
    }
}
