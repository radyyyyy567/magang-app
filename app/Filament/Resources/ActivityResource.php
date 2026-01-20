<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActivityResource\Pages;
use App\Models\Activity;
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

class ActivityResource extends Resource
{
    protected static ?string $model = Activity::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCalendar;

    protected static ?string $navigationLabel = 'Kegiatan';

    protected static ?string $modelLabel = 'Kegiatan';

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
            'index' => Pages\ListActivities::route('/'),
            'create' => Pages\CreateActivity::route('/create'),
            'edit' => Pages\EditActivity::route('/{record}/edit'),
        ];
    }
}
