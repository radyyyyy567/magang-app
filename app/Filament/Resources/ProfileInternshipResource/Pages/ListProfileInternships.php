<?php

namespace App\Filament\Resources\ProfileInternshipResource\Pages;

use App\Filament\Resources\ProfileInternshipResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProfileInternships extends ListRecords
{
    protected static string $resource = ProfileInternshipResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
