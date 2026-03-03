<?php

namespace App\Filament\Resources\CandidateInterns\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CandidateInternsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('lowongan.title')
                    ->label('Divisi')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('nik')
                    ->searchable(),
                TextColumn::make('description')
                    ->limit(50)
                    ->toggleable(isToggledHiddenByDefault: true),
                \Filament\Tables\Columns\ImageColumn::make('photo_path')
                    ->label('Photo')
                    ->circular(),
                TextColumn::make('transcript_path')
                    ->label('Transcript')
                    ->formatStateUsing(fn () => 'View Transcript')
                    ->url(fn ($record) => asset('storage/' . $record->transcript_path))
                    ->openUrlInNewTab()
                    ->icon('heroicon-o-document-text'),
                TextColumn::make('cv_path')
                    ->label('CV')
                    ->formatStateUsing(fn () => 'View CV')
                    ->url(fn ($record) => asset('storage/' . $record->cv_path))
                    ->openUrlInNewTab()
                    ->icon('heroicon-o-document'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Tanggal Daftar')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
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
}
