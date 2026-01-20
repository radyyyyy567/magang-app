<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfileMentorResource\Pages;
use App\Models\ProfileMentor;
use App\Models\User;
use BackedEnum;
use Filament\Forms\Components\DatePicker;
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

class ProfileMentorResource extends Resource
{
    protected static ?string $model = ProfileMentor::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserGroup;

    protected static ?string $navigationLabel = 'Profil Peserta Magang';

    protected static ?string $modelLabel = 'Profil Peserta Magang';

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
                
                TextInput::make('nomor_induk')
                    ->label('Nomor Induk')
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
                
                TextInput::make('instansi')
                    ->label('Instansi/Universitas')
                    ->required()
                    ->maxLength(255),
                
                DatePicker::make('awal_magang')
                    ->label('Tanggal Mulai Magang')
                    ->required()
                    ->native(false),
                
                DatePicker::make('akhir_magang')
                    ->label('Tanggal Selesai Magang')
                    ->required()
                    ->native(false)
                    ->after('awal_magang'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('foto')
                    ->label('Foto')
                    ->circular(),
                
                TextColumn::make('intern.name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('nomor_induk')
                    ->label('Nomor Induk')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('instansi')
                    ->label('Instansi')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('no_telp')
                    ->label('No. Telepon')
                    ->searchable(),
                
                TextColumn::make('awal_magang')
                    ->label('Mulai Magang')
                    ->date('d M Y')
                    ->sortable(),
                
                TextColumn::make('akhir_magang')
                    ->label('Selesai Magang')
                    ->date('d M Y')
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
            'index' => Pages\ListProfileMentors::route('/'),
            'create' => Pages\CreateProfileMentor::route('/create'),
            'edit' => Pages\EditProfileMentor::route('/{record}/edit'),
        ];
    }
}
