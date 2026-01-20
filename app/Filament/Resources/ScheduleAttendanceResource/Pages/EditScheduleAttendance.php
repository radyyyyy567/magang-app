<?php

namespace App\Filament\Resources\ScheduleAttendanceResource\Pages;

use App\Filament\Resources\ScheduleAttendanceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditScheduleAttendance extends EditRecord
{
    protected static string $resource = ScheduleAttendanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
