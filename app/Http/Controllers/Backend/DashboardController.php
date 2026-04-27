<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Acara;
use App\Models\Booking;
use App\Models\Kategori;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::where('role', '0')->count();
        $totalKategori = Kategori::count();
        $totalAcara = Acara::count();
        $totalBooking = Booking::count();
        $pendingBooking = Booking::whereHas('detailBooking', function ($q) {
            $q->where('status', 'pending');
        })->count();
        $totalRevenue = Booking::whereHas('detailBooking', function ($q) {
            $q->where('status', 'selesai');
        })->sum('subtotal');

        // Revenue Analytics (Harian, Mingguan, Bulanan)
        $now = \Carbon\Carbon::now();
        
        $dailyBookings = Booking::whereHas('detailBooking', fn($q) => $q->where('status', 'selesai'))
            ->whereDate('tanggal', '>=', $now->copy()->subDays(6))
            ->get()->groupBy(fn($b) => \Carbon\Carbon::parse($b->tanggal)->format('Y-m-d'));
            
        $dailyData = [
            'labels' => [],
            'values' => []
        ];
        for ($i = 6; $i >= 0; $i--) {
            $date = $now->copy()->subDays($i)->format('Y-m-d');
            $dailyData['labels'][] = $date;
            $dailyData['values'][] = isset($dailyBookings[$date]) ? $dailyBookings[$date]->sum('subtotal') : 0;
        }

        $weeklyBookings = Booking::whereHas('detailBooking', fn($q) => $q->where('status', 'selesai'))
            ->whereBetween('tanggal', [$now->copy()->subWeeks(4), $now])
            ->get()->groupBy(fn($b) => \Carbon\Carbon::parse($b->tanggal)->startOfWeek()->format('Y-m-d'));
            
        $weeklyData = [
            'labels' => [],
            'values' => []
        ];
        for ($i = 3; $i >= 0; $i--) {
            $date = $now->copy()->subWeeks($i)->startOfWeek()->format('Y-m-d');
            $weeklyData['labels'][] = "Week " . $now->copy()->subWeeks($i)->weekOfYear;
            $weeklyData['values'][] = isset($weeklyBookings[$date]) ? $weeklyBookings[$date]->sum('subtotal') : 0;
        }

        $monthlyBookings = Booking::whereHas('detailBooking', fn($q) => $q->where('status', 'selesai'))
            ->whereDate('tanggal', '>=', $now->copy()->subMonths(5))
            ->get()->groupBy(fn($b) => \Carbon\Carbon::parse($b->tanggal)->format('Y-m'));
            
        $monthlyData = [
            'labels' => [],
            'values' => []
        ];
        for ($i = 5; $i >= 0; $i--) {
            $date = $now->copy()->subMonths($i)->format('Y-m');
            $monthlyData['labels'][] = $now->copy()->subMonths($i)->format('M Y');
            $monthlyData['values'][] = isset($monthlyBookings[$date]) ? $monthlyBookings[$date]->sum('subtotal') : 0;
        }

        $chartData = [
            'Harian' => $dailyData,
            'Mingguan' => $weeklyData,
            'Bulanan' => $monthlyData,
        ];

        $recentBookings = Booking::with(['user', 'acara', 'detailBooking'])
            ->latest()
            ->take(5)
            ->get();

        // Pie Chart Data (Status Booking)
        $statusCounts = \App\Models\DetailBooking::select('status', \DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')->toArray();
        
        $pieData = [
            'labels' => ['Pending', 'Di Booking', 'Selesai', 'Batal'],
            'values' => [
                $statusCounts['pending'] ?? 0,
                $statusCounts['di booking'] ?? 0,
                $statusCounts['selesai'] ?? 0,
                $statusCounts['batal'] ?? 0,
            ],
            'colors' => ['#eab308', '#3b82f6', '#22c55e', '#ef4444'] // yellow, blue, green, red
        ];

        return view('backend.dashboard', compact(
            'totalUsers', 'totalKategori', 'totalAcara',
            'totalBooking', 'pendingBooking', 'totalRevenue',
            'recentBookings', 'chartData', 'pieData'
        ));
    }
}
