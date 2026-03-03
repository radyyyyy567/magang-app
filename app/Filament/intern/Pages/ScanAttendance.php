<?php

namespace App\Filament\intern\Pages;

use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use App\Models\DailyAttendance;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use BackedEnum;

class ScanAttendance extends Page
{
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-qr-code';

    protected string $view = 'filament.intern.pages.scan-attendance';

    protected static ?string $navigationLabel = 'Scan Absensi';
    
    protected static ?string $title = 'Scan Absensi';

    public function handleScan($code)
    {
        // Secret Key (Should be in .env but hardcoded for demo)
        $secret = 'MAGANG_SECRET_KEY_2024';
        
        // Validate Time-based Token (Period 5 seconds)
        // We check current slot, and previous/next slot to account for clock skew.
        $isValid = false;
        $timestamp = time();
        $slot = floor($timestamp / 5);
        
        // Check window of +/- 1 slot (5 seconds)
        for ($i = -1; $i <= 1; $i++) {
            $checkSlot = $slot + $i;
            $expectedHash = hash('sha256', $secret . $checkSlot);
            // We assume the QR contains the hash
            if ($code === $expectedHash) {
                $isValid = true;
                break;
            }
        }

        if (!$isValid) {
            Notification::make()->title('QR Code Invalid or Expired')->danger()->send();
            return;
        }

        try {
            // Check if user already checked in today
            $user = Auth::user();
            $today = Carbon::today();
            
            $attendance = DailyAttendance::firstOrCreate(
                [
                    'user_id' => $user->id,
                    'date' => $today,
                ],
                [
                    'status' => 'present'
                ]
            );

            if (!$attendance->check_in) {
                $attendance->update(['check_in' => Carbon::now()->toTimeString()]);
                Notification::make()->title('Check-in Berhasil: ' . Carbon::now()->format('H:i'))->success()->send();
            } elseif (!$attendance->check_out) {
                // Prevent check-out immediately after check-in (e.g. double scan)
                if ($attendance->updated_at->diffInSeconds(Carbon::now()) > 60) {
                     $attendance->update(['check_out' => Carbon::now()->toTimeString()]);
                     Notification::make()->title('Check-out Berhasil: ' . Carbon::now()->format('H:i'))->success()->send();
                } else {
                     Notification::make()->title('Anda sudah Check-in. Tunggu sebentar untuk Check-out.')->warning()->send();
                }
            } else {
                Notification::make()->title('Anda sudah selesai absensi hari ini')->info()->send();
            }

        } catch (\Exception $e) {
            Notification::make()->title('Error: ' . $e->getMessage())->danger()->send();
        }
    }
}
