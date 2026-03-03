<?php

namespace App\Filament\Widgets;

use App\Models\Lowongan;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class QuotaStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        // Calculate total quota from all activities
        $totalQuota = Lowongan::sum('quota');
        
        // Calculate unfilled quota (from open activities)
        $unfilledQuota = Lowongan::where('status', 'open')->sum('quota');
        
        // Calculate filled quota (assuming closed activities are filled)
        $filledQuota = $totalQuota - $unfilledQuota;
        
        return [
            Stat::make('Total Kuota', $totalQuota)
                ->description('Total kuota dari semua kegiatan')
                ->descriptionIcon('heroicon-o-clipboard-document-list')
                ->color('primary'),
            
            Stat::make('Kuota Belum Terisi', $unfilledQuota)
                ->description('Kuota yang masih tersedia')
                ->descriptionIcon('heroicon-o-inbox')
                ->color('warning'),
            
            Stat::make('Kuota Terisi', $filledQuota)
                ->description('Kuota yang sudah terisi')
                ->descriptionIcon('heroicon-o-check-circle')
                ->color('success'),
        ];
    }
}
