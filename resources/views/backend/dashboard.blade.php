<x-backend-layout>
    <x-slot:header>Dashboard</x-slot:header>
    <x-slot:headerActions>
        <button x-data @click="$dispatch('open-modal', 'export-modal')" 
                class="flex items-center gap-2 px-4 py-2 bg-dark-200 border border-brown-700/50 hover:bg-gold-500 hover:text-dark-900 hover:border-gold-500 text-brown-300 text-xs font-medium uppercase tracking-widest rounded-full transition-all duration-500 shadow-sm hover:shadow-gold-500/20 group mr-4">
            <svg class="w-4 h-4 transition-transform duration-300 group-hover:-translate-y-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            Export Laporan
        </button>
    </x-slot:headerActions>

    {{-- Statistics Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="stat-card">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-blue-900/30 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-serif text-brown-50 mb-1">{{ $totalUsers }}</p>
            <p class="text-brown-500 text-xs uppercase tracking-widest">Total Users</p>
        </div>

        <div class="stat-card">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-gold-900/30 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-gold-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-serif text-brown-50 mb-1">{{ $totalAcara }}</p>
            <p class="text-brown-500 text-xs uppercase tracking-widest">Total Acara</p>
        </div>

        <div class="stat-card">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-purple-900/30 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-serif text-brown-50 mb-1">{{ $totalBooking }}</p>
            <p class="text-brown-500 text-xs uppercase tracking-widest">Total Booking</p>
            @if($pendingBooking > 0)
                <span class="inline-block mt-2 px-2 py-0.5 bg-yellow-900/30 border border-yellow-700/30 text-yellow-400 text-[10px] uppercase tracking-widest rounded-sm">
                    {{ $pendingBooking }} Pending
                </span>
            @endif
        </div>

        <div class="stat-card">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-green-900/30 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <p class="text-2xl font-serif text-brown-50 mb-1">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
            <p class="text-brown-500 text-xs uppercase tracking-widest">Total Revenue</p>
        </div>
    </div>

    {{-- Analytics & Charts --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        
        {{-- LINE CHART: Penjualan --}}
        <div class="lg:col-span-2 p-6 bg-dark-100 border border-brown-800/30 rounded-xl overflow-hidden flex flex-col"
             x-data='{
             period: "Harian",
             chartData: @json(isset($chartData) ? $chartData : []),
             chartInstance: null,
             initChart() {
                 if (this.chartInstance) {
                     this.chartInstance.destroy();
                 }
                 const ctx = document.getElementById("revenueChart").getContext("2d");
                 const data = this.chartData[this.period];

                 // Gradient for the line
                 let gradient = ctx.createLinearGradient(0, 0, 0, 400);
                 gradient.addColorStop(0, "rgba(201, 168, 76, 0.5)"); // Gold color area
                 gradient.addColorStop(1, "rgba(201, 168, 76, 0.0)");

                 this.chartInstance = new Chart(ctx, {
                     type: "line",
                     data: {
                         labels: data.labels,
                         datasets: [{
                             label: "Pendapatan (Rp)",
                             data: data.values,
                             borderColor: "#c9a84c", // Gold color
                             backgroundColor: gradient,
                             borderWidth: 3,
                             pointBackgroundColor: "#1a1715",
                             pointBorderColor: "#e4c278",
                             pointHoverBackgroundColor: "#e4c278",
                             pointHoverBorderColor: "#ffffff",
                             pointRadius: 4,
                             pointHoverRadius: 6,
                             fill: true,
                             tension: 0.4 // Smooth curves
                         }]
                     },
                     options: {
                         responsive: true,
                         maintainAspectRatio: false,
                         animation: {
                             duration: 2000,
                             easing: "easeOutQuart"
                         },
                         plugins: {
                             legend: { display: false },
                             tooltip: {
                                 backgroundColor: "#2e261f",
                                 titleColor: "#c9a84c",
                                 bodyColor: "#f5f0e8",
                                 borderColor: "#4a4239",
                                 borderWidth: 1,
                                 padding: 10,
                                 callbacks: {
                                     label: function(context) {
                                         let label = context.dataset.label || "";
                                         if (label) {
                                             label += ": ";
                                         }
                                         if (context.parsed.y !== null) {
                                             label += "Rp " + context.parsed.y.toLocaleString("id-ID");
                                         }
                                         return label;
                                     }
                                 }
                             }
                         },
                         scales: {
                             x: {
                                 grid: { color: "rgba(74, 66, 57, 0.2)", drawBorder: false },
                                 ticks: { color: "#a89880", font: { family: "Inter" } }
                             },
                             y: {
                                 grid: { color: "rgba(74, 66, 57, 0.2)", drawBorder: false },
                                 ticks: {
                                     color: "#a89880",
                                     font: { family: "Inter" },
                                     callback: function(value, index, values) {
                                         if (value >= 1000000) {
                                             return "Rp " + (value / 1000000) + "M";
                                         }
                                         return "Rp " + value.toLocaleString("id-ID");
                                     }
                                 },
                                 beginAtZero: true
                             }
                         }
                     }
                 });
             },
             updateChart(newPeriod) {
                 this.period = newPeriod;
                 this.initChart();
             }
         }'
         x-init="initChart()">
        
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-6 gap-4">
            <div>
                <h2 class="font-serif text-xl text-brown-50">Analitik Penjualan</h2>
                <p class="text-sm text-brown-400 mt-1">Lacak pendapatan booking selesai</p>
            </div>
            
            <div class="flex bg-dark p-1 rounded-lg border border-brown-800/30">
                <template x-for="opt in [\'Harian\', \'Mingguan\', \'Bulanan\']" :key="opt">
                    <button type="button" @click="updateChart(opt)"
                            :class="period === opt ? 'bg-gold-500 text-dark-900 font-bold shadow-md' : 'text-brown-300 hover:text-brown-100'"
                            class="px-4 py-1.5 text-xs uppercase tracking-wider rounded-md transition-all duration-300"
                            x-text="opt">
                    </button>
                </template>
            </div>
        </div>

        <div class="h-80 w-full relative flex-1">
            <canvas id="revenueChart"></canvas>
        </div>
    </div>

    {{-- PIE CHART: Status Distribusi --}}
    <div class="lg:col-span-1 p-6 bg-dark-100 border border-brown-800/30 rounded-xl overflow-hidden flex flex-col"
         x-data='{
             pieData: @json(isset($pieData) ? $pieData : []),
             pieChart: null,
             initPieChart() {
                 const ctx = document.getElementById("statusPieChart").getContext("2d");
                 this.pieChart = new Chart(ctx, {
                     type: "doughnut",
                     data: {
                         labels: this.pieData.labels,
                         datasets: [{
                             data: this.pieData.values,
                             backgroundColor: this.pieData.colors,
                             borderWidth: 0,
                             hoverOffset: 10
                         }]
                     },
                     options: {
                         responsive: true,
                         maintainAspectRatio: false,
                         cutout: "75%",
                         animation: {
                             animateScale: true,
                             animateRotate: true,
                             duration: 2000,
                             easing: "easeOutQuart"
                         },
                         plugins: {
                             legend: { display: false },
                             tooltip: {
                                 backgroundColor: "#2e261f",
                                 titleColor: "#c9a84c",
                                 bodyColor: "#f5f0e8",
                                 padding: 12,
                                 callbacks: {
                                     label: function(context) {
                                         let label = context.label || "";
                                         if (label) {
                                             label += ": ";
                                         }
                                         if (context.parsed !== null) {
                                             label += context.parsed + " Booking";
                                         }
                                         return label;
                                     }
                                 }
                             }
                         }
                     }
                 });
             }
         }'
         x-init="initPieChart()">
        
        <div class="mb-6 text-center">
            <h2 class="font-serif text-xl text-brown-50">Distribusi Status</h2>
            <p class="text-[11px] uppercase tracking-widest text-brown-400 mt-1">Status seluruh booking</p>
        </div>

        <div class="h-48 w-full relative mb-6">
            <canvas id="statusPieChart"></canvas>
            {{-- Centered Total Text inside Doughnut --}}
            <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                <span class="text-3xl font-serif text-gold-400 font-normal drop-shadow-md" x-text="pieData.values.reduce((a, b) => a + b, 0)"></span>
                <span class="text-[9px] uppercase tracking-[0.2em] text-brown-500 font-bold mt-1">Total Order</span>
            </div>
        </div>

        {{-- Custom Legend --}}
        <div class="grid grid-cols-2 gap-3 mt-auto relative z-10">
            <template x-for="(label, index) in pieData.labels" :key="index">
                <div class="flex items-center gap-3 p-2.5 rounded-xl bg-dark/40 border border-brown-800/30 shadow-inner">
                    <div class="w-2.5 h-2.5 rounded-full" :style="'background-color: ' + pieData.colors[index] + '; box-shadow: 0 0 8px ' + pieData.colors[index] + '80'"></div>
                    <div class="flex-1 flex justify-between items-center">
                        <div class="text-[9px] text-brown-300 uppercase tracking-widest font-bold" x-text="label"></div>
                        <div class="text-sm text-gold-100 font-mono font-bold" x-text="pieData.values[index]"></div>
                    </div>
                </div>
            </template>
        </div>
    </div>
</div>

    {{-- Recent Bookings --}}
    <div class="bg-dark-100 border border-brown-800/30 rounded-xl overflow-hidden">
        <div class="px-6 py-4 border-b border-brown-800/30 flex items-center justify-between">
            <h2 class="font-serif text-lg text-brown-100">Booking Terbaru</h2>
            <a href="{{ route('backend.booking.index') }}" class="text-gold-500 text-xs uppercase tracking-widest hover:text-gold-400 transition-colors">
                Lihat Semua →
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-brown-800/20">
                        <th class="px-6 py-3 text-left text-xs font-medium text-brown-500 uppercase tracking-wider">User</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-brown-500 uppercase tracking-wider">Jenis Acara</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-brown-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-brown-500 uppercase tracking-wider">Subtotal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-brown-500 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-brown-800/20">
                    @forelse($recentBookings as $booking)
                        <tr class="hover:bg-dark-200/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="text-sm text-brown-200">{{ $booking->user->nama ?? $booking->nama_lengkap }}</div>
                                <div class="text-xs text-brown-500">{{ $booking->user->email ?? '' }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm text-brown-300">{{ $booking->jenis_acara ?: '-' }}</td>
                            <td class="px-6 py-4 text-sm text-brown-300">{{ $booking->tanggal->format('d M Y') }}</td>
                            <td class="px-6 py-4 text-sm text-gold-500 font-semibold">{{ $booking->formatted_subtotal }}</td>
                            <td class="px-6 py-4">
                                @php
                                    $status = $booking->detailBooking->status ?? 'pending';
                                    $colors = [
                                        'pending' => 'bg-yellow-900/30 border-yellow-700/30 text-yellow-400',
                                        'di booking' => 'bg-blue-900/30 border-blue-700/30 text-blue-400',
                                        'selesai' => 'bg-green-900/30 border-green-700/30 text-green-400',
                                    ];
                                @endphp
                                <span class="px-2 py-0.5 text-[10px] uppercase tracking-widest border rounded-sm {{ $colors[$status] }}">
                                    {{ $status }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-brown-500">Belum ada booking.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Export Modal --}}
    <x-modal name="export-modal" maxWidth="md" focusable>
        <form method="POST" action="{{ route('backend.export') }}" class="p-6 bg-dark-100">
            @csrf
            
            <h2 class="text-lg font-serif text-gold-400 mb-4 border-b border-brown-800/30 pb-2">
                Export Laporan Booking
            </h2>
            
            <p class="text-sm text-brown-400 mb-6">Pilih rentang tanggal dan format file untuk mengekspor data laporan booking Anda.</p>

            <div class="space-y-4">
                <div>
                    <label for="start_date" class="block text-xs font-medium text-brown-300 uppercase tracking-wider mb-1">Tanggal Mulai</label>
                    <input type="date" id="start_date" name="start_date" required
                           class="w-full bg-dark-200 border-brown-700/50 text-brown-100 rounded-lg focus:ring-gold-500 focus:border-gold-500 shadow-sm sm:text-sm">
                </div>

                <div>
                    <label for="end_date" class="block text-xs font-medium text-brown-300 uppercase tracking-wider mb-1">Tanggal Akhir</label>
                    <input type="date" id="end_date" name="end_date" required
                           class="w-full bg-dark-200 border-brown-700/50 text-brown-100 rounded-lg focus:ring-gold-500 focus:border-gold-500 shadow-sm sm:text-sm">
                </div>

                <div x-data="{ format: 'pdf' }">
                    <label class="block text-xs font-medium text-brown-300 uppercase tracking-wider mb-2">Format File</label>
                    <div class="grid grid-cols-2 gap-4">
                        <label @click="format = 'pdf'" 
                               :class="format === 'pdf' ? 'border-gold-500 shadow-[0_0_10px_rgba(201,168,76,0.3)] bg-dark-300' : 'border-brown-800/50 bg-dark-200 opacity-70 hover:bg-dark-300'"
                               class="cursor-pointer flex flex-col items-center justify-center rounded-lg border-2 p-3 transition-all duration-300 relative">
                            <input type="radio" name="format" value="pdf" class="sr-only" x-model="format">
                            <svg class="w-6 h-6 text-red-500 mb-1 drop-shadow-md" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14H9v-2H7v-2h2V9h2v7zm4 0h-2V9h2c1.1 0 2 .9 2 2v2c0 1.1-.9 2-2 2zm-2-2h2v-2h-2v2z"/></svg>
                            <span class="text-sm font-medium transition-colors" :class="format === 'pdf' ? 'text-gold-400' : 'text-brown-100'">PDF</span>
                            
                            {{-- Check Icon when selected --}}
                            <div x-show="format === 'pdf'" class="absolute top-2 right-2 text-gold-500">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            </div>
                        </label>
                        
                        <label @click="format = 'excel'" 
                               :class="format === 'excel' ? 'border-gold-500 shadow-[0_0_10px_rgba(201,168,76,0.3)] bg-dark-300' : 'border-brown-800/50 bg-dark-200 opacity-70 hover:bg-dark-300'"
                               class="cursor-pointer flex flex-col items-center justify-center rounded-lg border-2 p-3 transition-all duration-300 relative">
                            <input type="radio" name="format" value="excel" class="sr-only" x-model="format">
                            <svg class="w-6 h-6 text-green-500 mb-1 drop-shadow-md" fill="currentColor" viewBox="0 0 24 24"><path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/></svg>
                            <span class="text-sm font-medium transition-colors" :class="format === 'excel' ? 'text-gold-400' : 'text-brown-100'">Excel / CSV</span>

                            {{-- Check Icon when selected --}}
                            <div x-show="format === 'excel'" class="absolute top-2 right-2 text-gold-500">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            <div class="mt-8 flex justify-end gap-3">
                <button type="button" x-on:click="$dispatch('close')" class="px-4 py-2 text-sm text-brown-400 hover:text-brown-100 transition-colors">
                    Batal
                </button>
                <button type="submit" class="btn-gold px-6 py-2 text-sm">
                    Export Sekarang
                </button>
            </div>
        </form>
    </x-modal>
</x-backend-layout>
