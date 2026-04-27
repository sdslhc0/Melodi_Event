{{-- Ringkasan Pesanan Sidebar --}}
<div class="sticky top-[20vh] lg:mt-[120px] max-w-[340px] ml-auto w-full flex flex-col justify-center transition-all duration-500 hover:-translate-y-1 hover:shadow-2xl">
    <div class="border border-[#4a4239] bg-[#231d18] p-5 rounded-none shadow-lg relative overflow-hidden group">
        {{-- Shine effect overlay --}}
        <div class="absolute inset-0 bg-gradient-to-tr from-transparent via-[#c9a84c]/5 to-transparent translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-[1.5s] ease-in-out"></div>
        {{-- Header --}}
        <div class="flex items-center gap-3 mb-4 border-b border-[#4a4239] pb-3">
            <svg class="w-5 h-5 text-[#f0e8d8]" fill="currentColor" viewBox="0 0 24 24">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zm-1 1.5L18.5 9H13V3.5zM6 20V4h5v7h7v9H6zm2-8h8v2H8v-2zm0 4h8v2H8v-2z"/>
            </svg>
            <h3 class="text-[#f0e8d8] font-serif text-[14px] tracking-wide">Ringkasan Pesanan</h3>
        </div>

        {{-- Summary List --}}
        <div class="space-y-0 mb-10">
            @php
                $rows = [
                    ['label' => 'Jenis Acara', 'value' => "jenisAcara === 'Lainnya' ? (customJenisAcara || 'Lainnya') : (jenisAcara || '-')", 'isRaw' => true],
                    ['label' => 'Tanggal', 'value' => "tanggalAcara ? tanggalAcara.split('-').reverse().join('-') : '-'", 'isRaw' => true],
                    ['label' => 'Jumlah Tamu', 'value' => "jumlahTamu ? jumlahTamu + ' Orang' : '-'", 'isRaw' => true],
                    ['label' => 'Waktu Mulai', 'value' => "acaraMulai || '-'", 'isRaw' => true],
                    ['label' => 'Waktu Selesai', 'value' => "acaraSelesai || '-'", 'isRaw' => true],
                    ['label' => 'Pembayaran', 'value' => "metodePembayaran === 'full_payment' ? 'Full Payment' : metodePembayaran === 'dp_30' ? 'DP (30%)' : '-'", 'isRaw' => true],
                ];
            @endphp

            @foreach($rows as $row)
            <div class="flex justify-between items-end py-3 border-b border-[#4a4239]/50">
                <span class="text-[#cbbfa6] text-[13px] font-serif font-medium">{{ $row['label'] }}</span>
                <span class="text-[#ffffff] text-[13px] font-serif font-semibold text-right" 
                      x-text="{{ isset($row['isRaw']) ? $row['value'] : ($row['value'] . " || '-'") }}"></span>
            </div>
            @endforeach

            {{-- BUNDLING --}}
            <template x-if="idPaketBundling">
                <div class="flex justify-between items-end py-3 border-b border-[#4a4239]/50">
                    <span class="text-[#cbbfa6] text-[13px] font-serif font-medium" x-text="bundlingsData.find(b => b.id == idPaketBundling)?.nama?.substring(0,25) + (bundlingsData.find(b => b.id == idPaketBundling)?.nama?.length > 25 ? '...' : '')"></span>
                    <span class="text-[#ffffff] text-[13px] font-serif font-semibold text-right" x-text="formatRupiah(hargaBundling)"></span>
                </div>
            </template>

            {{-- VENUE FEE --}}
            <template x-if="biayaVenue > 0">
                <div class="flex justify-between items-end py-3 border-b border-[#4a4239]/50">
                    <span class="text-[#cbbfa6] text-[13px] font-serif font-medium">Sewa Gedung (Venue)</span>
                    <span class="text-[#ffffff] text-[13px] font-serif font-semibold text-right" x-text="formatRupiah(biayaVenue)"></span>
                </div>
            </template>

            {{-- DYNAMIC SERVICES --}}
            <template x-for="tipe in Object.keys(selectedLayanan)" :key="'sum-'+tipe">
                <template x-for="item in selectedLayanan[tipe]" :key="'sum-item-'+item.id">
                    <div class="flex justify-between items-end py-3 border-b border-[#4a4239]/50">
                        <div class="flex flex-col">
                            <span class="text-[#cbbfa6] text-[13px] font-serif font-medium" x-text="'[' + tipe + '] ' + item.nama?.substring(0,15) + (item.nama?.length > 15 ? '...' : '')"></span>
                            <span x-show="tipe === 'Buku Undangan' || tipe === 'Catering'" class="text-[10px] text-[#a89880] mt-1" x-text="item.qty + (tipe === 'Catering' ? ' paks x ' : ' pcs x ') + formatRupiah(item.harga)"></span>
                        </div>
                        <span class="text-[#ffffff] text-[13px] font-serif font-semibold text-right" x-text="formatRupiah(item.harga * (Number(item.qty) || 1))"></span>
                    </div>
                </template>
            </template>
        </div>

        {{-- Final TOTAL --}}
        <div class="flex justify-between items-center px-1" x-show="metodePembayaran !== 'dp_30'">
            <span class="text-[#ffffff] font-serif tracking-[0.1em] text-[15px] font-bold uppercase">TOTAL</span>
            <span class="text-[#ffffff] text-lg font-serif font-bold tracking-wide" x-text="grandTotal > 0 ? formatRupiah(grandTotal) : '-'"></span>
        </div>

        {{-- DP 30% Breakdown --}}
        <template x-if="metodePembayaran === 'dp_30' && grandTotal > 0">
            <div class="space-y-3 px-1 pt-4 mt-2">
                <div class="flex justify-between items-center">
                    <span class="text-[#cbbfa6] text-[13px] font-serif font-medium">Total Keseluruhan</span>
                    <span class="text-[#ffffff] text-[13px] font-serif font-semibold text-right" x-text="formatRupiah(grandTotal)"></span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-[#ffffff] font-serif tracking-[0.1em] text-[15px] font-bold uppercase">DP (30%)</span>
                    <span class="text-[#c9a84c] text-lg font-serif font-bold tracking-wide" x-text="formatRupiah(grandTotal * 0.3)"></span>
                </div>
                <div class="flex justify-between items-center pt-2 border-t border-[#4a4239]/30">
                    <span class="text-[#e23636] text-[12px] font-serif italic">Kekurangan Pembayaran</span>
                    <span class="text-[#f0e8d8] text-[13px] font-serif font-semibold" x-text="formatRupiah(grandTotal * 0.7)"></span>
                </div>
            </div>
        </template>
    </div>
</div>
