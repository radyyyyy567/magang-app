<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

use BackedEnum;

class ManageAttendanceQR extends Page
{
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-qr-code';

    protected string $view = 'filament.pages.manage-attendance-qr';

    protected static ?string $navigationLabel = 'Attendance QR';

    protected static ?string $title = 'Attendance QR';
    
    protected static ?string $slug = 'attendance-qr';
}
