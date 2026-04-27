<?php if (isset($component)) { $__componentOriginala2edde5e1c82a5de5f92a34d70a8fe30 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala2edde5e1c82a5de5f92a34d70a8fe30 = $attributes; } ?>
<?php $component = App\View\Components\BackendLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\BackendLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> Dashboard <?php $__env->endSlot(); ?>

    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="stat-card">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-blue-900/30 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-serif text-brown-50 mb-1"><?php echo e($totalUsers); ?></p>
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
            <p class="text-3xl font-serif text-brown-50 mb-1"><?php echo e($totalAcara); ?></p>
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
            <p class="text-3xl font-serif text-brown-50 mb-1"><?php echo e($totalBooking); ?></p>
            <p class="text-brown-500 text-xs uppercase tracking-widest">Total Booking</p>
            <?php if($pendingBooking > 0): ?>
                <span class="inline-block mt-2 px-2 py-0.5 bg-yellow-900/30 border border-yellow-700/30 text-yellow-400 text-[10px] uppercase tracking-widest rounded-sm">
                    <?php echo e($pendingBooking); ?> Pending
                </span>
            <?php endif; ?>
        </div>

        <div class="stat-card">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-green-900/30 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <p class="text-2xl font-serif text-brown-50 mb-1">Rp <?php echo e(number_format($totalRevenue, 0, ',', '.')); ?></p>
            <p class="text-brown-500 text-xs uppercase tracking-widest">Total Revenue</p>
        </div>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <div class="mb-8 p-6 bg-dark-100 border border-brown-800/30 rounded-xl overflow-hidden"
         x-data='{
             period: "Harian",
             chartData: <?php echo json_encode(isset($chartData) ? $chartData : [], 15, 512) ?>,
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
                <p class="text-sm text-brown-400 mt-1">Lacak ringkasan pendapatan dari booking yang sudah selesai</p>
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

        <div class="h-80 w-full relative">
            <canvas id="revenueChart"></canvas>
        </div>
    </div>

    
    <div class="bg-dark-100 border border-brown-800/30 rounded-xl overflow-hidden">
        <div class="px-6 py-4 border-b border-brown-800/30 flex items-center justify-between">
            <h2 class="font-serif text-lg text-brown-100">Booking Terbaru</h2>
            <a href="<?php echo e(route('backend.booking.index')); ?>" class="text-gold-500 text-xs uppercase tracking-widest hover:text-gold-400 transition-colors">
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
                    <?php $__empty_1 = true; $__currentLoopData = $recentBookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-dark-200/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="text-sm text-brown-200"><?php echo e($booking->user->nama ?? $booking->nama_lengkap); ?></div>
                                <div class="text-xs text-brown-500"><?php echo e($booking->user->email ?? ''); ?></div>
                            </td>
                            <td class="px-6 py-4 text-sm text-brown-300"><?php echo e($booking->jenis_acara ?: '-'); ?></td>
                            <td class="px-6 py-4 text-sm text-brown-300"><?php echo e($booking->tanggal->format('d M Y')); ?></td>
                            <td class="px-6 py-4 text-sm text-gold-500 font-semibold"><?php echo e($booking->formatted_subtotal); ?></td>
                            <td class="px-6 py-4">
                                <?php
                                    $status = $booking->detailBooking->status ?? 'pending';
                                    $colors = [
                                        'pending' => 'bg-yellow-900/30 border-yellow-700/30 text-yellow-400',
                                        'di booking' => 'bg-blue-900/30 border-blue-700/30 text-blue-400',
                                        'selesai' => 'bg-green-900/30 border-green-700/30 text-green-400',
                                    ];
                                ?>
                                <span class="px-2 py-0.5 text-[10px] uppercase tracking-widest border rounded-sm <?php echo e($colors[$status]); ?>">
                                    <?php echo e($status); ?>

                                </span>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-brown-500">Belum ada booking.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala2edde5e1c82a5de5f92a34d70a8fe30)): ?>
<?php $attributes = $__attributesOriginala2edde5e1c82a5de5f92a34d70a8fe30; ?>
<?php unset($__attributesOriginala2edde5e1c82a5de5f92a34d70a8fe30); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala2edde5e1c82a5de5f92a34d70a8fe30)): ?>
<?php $component = $__componentOriginala2edde5e1c82a5de5f92a34d70a8fe30; ?>
<?php unset($__componentOriginala2edde5e1c82a5de5f92a34d70a8fe30); ?>
<?php endif; ?>
<?php /**PATH C:\0704\1304\wedding-organizer\resources\views/backend/dashboard.blade.php ENDPATH**/ ?>