<?php

namespace App\Filament\Resources\CandidateInterns\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CandidateInternForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload()
                    ->preload()
                    ->default(null),
                \Filament\Forms\Components\Select::make('lowongan_id')
                    ->relationship('lowongan', 'title')
                    ->searchable()
                    ->preload()
                    ->label('Position')
                    ->default(null),
                TextInput::make('name')
                    ->required(),
                TextInput::make('nik')
                    ->required()
                    ->unique(ignoreRecord: true),
                \Filament\Forms\Components\Textarea::make('description')
                    ->label('Description')
                    ->columnSpanFull(),
                \Filament\Forms\Components\FileUpload::make('transcript_path')
                    ->label('Transcript')
                    ->directory('candidate-interns/transcripts')
                    ->required()
                    ->openable()
                    ->downloadable(),
                \Filament\Forms\Components\FileUpload::make('cv_path')
                    ->label('CV')
                    ->directory('candidate-interns/cvs')
                    ->required()
                    ->openable()
                    ->downloadable(),
                \Filament\Forms\Components\FileUpload::make('photo_path')
                    ->label('Photo')
                    ->disk('public')
                    ->directory('candidate-interns/photos')
                    ->image()
                    ->avatar()
                    ->required()
                    ->openable(),
            ]);
    }
}
