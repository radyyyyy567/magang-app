<?php

namespace App\Filament\Resources\ProfileMentorResource\Pages;

use App\Filament\Resources\ProfileMentorResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProfileMentors extends ListRecords
{
    protected static string $resource = ProfileMentorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
