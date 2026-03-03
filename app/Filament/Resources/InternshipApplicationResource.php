<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InternshipApplicationResource\Pages;
use App\Models\InternshipApplication;
use App\Models\User;
use BackedEnum;
use Filament\Forms\Components\DateTimePicker;
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

class InternshipApplicationResource extends Resource
{
    protected static ?string $model = InternshipApplication::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static ?string $navigationLabel = 'Laporan Kegiatan';

    protected static ?string $modelLabel = 'Laporan Kegiatan';

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
{
    $query = parent::getEloquentQuery();

    $user = auth()->user();

    if ($user->role === 'intern') {
        $query->where('intern_id', $user->id);
    }

    if ($user->role === 'mentor') {
        $query->where('mentor_id', $user->id);
    }

    return $query;
}

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Select::make('mentor_id')
                    ->label('Pembimbing')
                    ->options(User::where('role', 'mentor')->pluck('name', 'id'))
                    ->required()
                    ->searchable()
                    ->preload(),
                
                Select::make('intern_id')
                    ->label('Peserta Magang')
                    ->options(User::where('role', 'intern')->pluck('name', 'id'))
                    ->required()
                    ->searchable()
                    ->preload(),
                
                TextInput::make('title')
                    ->label('Judul Laporan')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
                
                Textarea::make('description')
                    ->label('Deskripsi Kegiatan')
                    ->required()
                    ->rows(5)
                    ->columnSpanFull(),
                
                DateTimePicker::make('activity_date')
                    ->label('Tanggal Kegiatan')
                    ->required()
                    ->native(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('intern.name')
                    ->label('Peserta Magang')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('mentor.name')
                    ->label('Pembimbing')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->limit(50),
                
                TextColumn::make('activity_date')
                    ->label('Tanggal Kegiatan')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
                
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
                
                Tables\Filters\SelectFilter::make('mentor_id')
                    ->label('Pembimbing')
                    ->relationship('mentor', 'name'),
                
                Tables\Filters\Filter::make('activity_date')
                    ->form([
                        \Filament\Forms\Components\DatePicker::make('from')
                            ->label('Dari Tanggal'),
                        \Filament\Forms\Components\DatePicker::make('until')
                            ->label('Sampai Tanggal'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['from'], fn ($q) => $q->whereDate('activity_date', '>=', $data['from']))
                            ->when($data['until'], fn ($q) => $q->whereDate('activity_date', '<=', $data['until']));
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
            ->defaultSort('activity_date', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInternshipApplications::route('/'),
            'create' => Pages\CreateInternshipApplication::route('/create'),
            'edit' => Pages\EditInternshipApplication::route('/{record}/edit'),
        ];
    }
}
