<?php

namespace App\Filament\Resources\ScheduleAttendanceResource\Pages;

use App\Filament\Resources\ScheduleAttendanceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListScheduleAttendances extends ListRecords
{
    protected static string $resource = ScheduleAttendanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
