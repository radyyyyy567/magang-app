<?php

namespace App\Filament\Resources\ProfileMentorResource\Pages;

use App\Filament\Resources\ProfileMentorResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProfileMentor extends EditRecord
{
    protected static string $resource = ProfileMentorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
