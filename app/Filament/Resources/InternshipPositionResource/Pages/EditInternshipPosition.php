<?php

namespace App\Filament\Resources\InternshipPositionResource\Pages;

use App\Filament\Resources\InternshipPositionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInternshipPosition extends EditRecord
{
    protected static string $resource = InternshipPositionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
