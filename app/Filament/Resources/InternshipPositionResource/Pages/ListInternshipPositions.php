<?php

namespace App\Filament\Resources\InternshipPositionResource\Pages;

use App\Filament\Resources\InternshipPositionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInternshipPositions extends ListRecords
{
    protected static string $resource = InternshipPositionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
