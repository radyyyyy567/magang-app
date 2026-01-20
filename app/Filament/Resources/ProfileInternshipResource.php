<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfileInternshipResource\Pages;
use App\Models\ProfileInternship;
use App\Models\User;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
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
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProfileInternshipResource extends Resource
{
    protected static ?string $model = ProfileInternship::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedIdentification;

    protected static ?string $navigationLabel = 'Profil Pembimbing';

    protected static ?string $modelLabel = 'Profil Pembimbing';

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
                
                TextInput::make('nomor_induk')
                    ->label('Nomor Induk Pegawai')
                    ->required()
                    ->numeric()
                    ->unique(ignoreRecord: true),
                
                FileUpload::make('foto')
                    ->label('Foto')
                    ->image()
                    ->directory('profile-photos')
                    ->default('default.jpg'),
                
                TextInput::make('no_telp')
                    ->label('Nomor Telepon')
                    ->tel()
                    ->required(),
                
                Textarea::make('alamat')
                    ->label('Alamat')
                    ->required()
                    ->columnSpanFull(),
                
                TextInput::make('jabatan')
                    ->label('Jabatan')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('foto')
                    ->label('Foto')
                    ->circular(),
                
                TextColumn::make('mentor.name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('nomor_induk')
                    ->label('NIP')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('jabatan')
                    ->label('Jabatan')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('no_telp')
                    ->label('No. Telepon')
                    ->searchable(),
                
                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('mentor_id')
                    ->label('Pembimbing')
                    ->relationship('mentor', 'name'),
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
            'index' => Pages\ListProfileInternships::route('/'),
            'create' => Pages\CreateProfileInternship::route('/create'),
            'edit' => Pages\EditProfileInternship::route('/{record}/edit'),
        ];
    }
}
