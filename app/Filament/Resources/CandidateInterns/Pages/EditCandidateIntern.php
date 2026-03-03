<?php

namespace App\Filament\Resources\CandidateInterns\Pages;

use App\Filament\Resources\CandidateInterns\CandidateInternResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCandidateIntern extends EditRecord
{
    protected static string $resource = CandidateInternResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
