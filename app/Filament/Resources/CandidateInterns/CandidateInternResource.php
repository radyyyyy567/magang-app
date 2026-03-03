<?php

namespace App\Filament\Resources\CandidateInterns;

use App\Filament\Resources\CandidateInterns\Pages\CreateCandidateIntern;
use App\Filament\Resources\CandidateInterns\Pages\EditCandidateIntern;
use App\Filament\Resources\CandidateInterns\Pages\ListCandidateInterns;
use App\Filament\Resources\CandidateInterns\Schemas\CandidateInternForm;
use App\Filament\Resources\CandidateInterns\Tables\CandidateInternsTable;
use App\Models\CandidateIntern;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CandidateInternResource extends Resource
{
    protected static ?string $model = CandidateIntern::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static \UnitEnum|string|null $navigationGroup = 'Career';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return CandidateInternForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CandidateInternsTable::configure($table);
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
            'index' => ListCandidateInterns::route('/'),
            'create' => CreateCandidateIntern::route('/create'),
            'edit' => EditCandidateIntern::route('/{record}/edit'),
        ];
    }
}
