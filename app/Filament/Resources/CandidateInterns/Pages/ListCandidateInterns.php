<?php

namespace App\Filament\Resources\CandidateInterns\Pages;

use App\Filament\Resources\CandidateInterns\CandidateInternResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCandidateInterns extends ListRecords
{
    protected static string $resource = CandidateInternResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
