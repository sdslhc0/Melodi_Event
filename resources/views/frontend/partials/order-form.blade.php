<section id="formulir-pemesanan" class="py-16 bg-dark">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="flex items-center gap-4 mb-3">
            <span class="w-16 h-px bg-[#4a4239]"></span>
            <span class="text-[#a89880] text-sm font-serif">Formulir Pemesanan</span>
        </div>
        <h2 class="text-4xl md:text-5xl lg:text-[2.8rem] font-serif text-[#f5f0e8] mb-4 leading-tight">Mulai Rencanakan Acara Idealmu</h2>
        <p class="text-[#a89880] text-sm mb-8 max-w-lg leading-relaxed">Isi formulir berikut dan tim kami akan menghubungimu<br class="hidden sm:block"> dalam 24 jam untuk konfirmasi dan diskusi lebih lanjut.</p>

        @if ($errors->any())
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    let errHtml = `<ul class="list-none space-y-2 text-sm text-[#f0e8d8] opacity-80 mt-2">
                        @foreach ($errors->all() as $error)
                            <li><span class="text-red-400 mr-2">♦</span> {{ $error }}</li>
                        @endforeach
                    </ul>`;
                    
                    Swal.fire({
                        icon: 'warning',
                        title: 'Mohon periksa kembali',
                        html: errHtml,
                        background: '#231d18',
                        color: '#f0e8d8',
                        confirmButtonColor: '#c9a84c',
                        confirmButtonText: 'MENGERTI',
                        customClass: {
                            popup: 'border border-[#c9a84c]/40 rounded-xl',
                            title: 'font-serif text-[#c9a84c] text-2xl tracking-wide',
                            confirmButton: 'font-bold tracking-[0.1em] text-[#1a140e] uppercase py-2.5 px-6 rounded-sm'
                        }
                    });
                });
            </script>
        @endif

        {{-- Alpine Component --}}
        <div x-data='{
            step: 1,
            jenisAcara: "",
            customJenisAcara: "",
            namaLengkap: "",
            noWhatsapp: "",
            tanggalAcara: "",
            jumlahTamu: "",
            acaraMulai: "",
            acaraSelesai: "",
            get biayaVenue() {
                if (this.idPaketBundling) return 0;
                if (!this.acaraMulai || !this.acaraSelesai) return 0;
                
                const [hM, mM] = this.acaraMulai.split(":").map(Number);
                const [hS, mS] = this.acaraSelesai.split(":").map(Number);
                const diffMinutes = (hS * 60 + mS) - (hM * 60 + mM);
                
                if (diffMinutes <= 0) return 0;
                
                const hours = diffMinutes / 60;
                const basePrice = 15000000;
                
                if (hours <= 6) {
                    return basePrice;
                } else {
                    const extraHours = Math.ceil(hours - 6);
                    return basePrice + (extraHours * 1000000);
                }
            },
            openDropdown: "",
            selectedLayanan: {},
            metodePembayaran: "",
            bank: "",
            catatan: "",
            layananData: @json($layananList),
            basePrices: @json($basePrices),
            idPaketBundling: "",
            hargaBundling: 0,
            bundlingsData: @json(isset($paketBundlings) ? $paketBundlings : []),
            isBundlingFromUrl: false,
            isLoggedIn: {{ Auth::check() ? 'true' : 'false' }},
            init() {
                // Set default start time to 08:00
                this.acaraMulai = "08:00";
                
                this.$watch("jumlahTamu", (val) => {
                    if (val > 1500) {
                        this.jumlahTamu = 1500;
                        this.showWarning("Maksimal jumlah tamu adalah 1500 orang.");
                    }
                });
                
                const params = new URLSearchParams(window.location.search);
                const bundlingId = params.get("paket_bundling");
                if (bundlingId) {
                    this.selectBundling(bundlingId);
                    this.isBundlingFromUrl = true;
                    // Clean URL without reloading
                    const url = new URL(window.location);
                    url.searchParams.delete("paket_bundling");
                    window.history.replaceState({}, "", url.pathname + url.hash);
                }
            },
            formatRupiah(num) {
                if (num === "-" || !num || num == 0) return "-";
                return "Rp " + Number(num).toLocaleString("id-ID");
            },
            setJenisAcara(tipe) {
                this.jenisAcara = tipe;
                this.selectedLayanan = {}; // Reset layanan jika jenis acara diganti
            },
            toggleDropdown(tipe) {
                this.openDropdown = this.openDropdown === tipe ? "" : tipe;
            },
            selectLayanan(tipe, pkg) {
                if (!this.selectedLayanan[tipe]) {
                    let defaultQty = 1;
                    if (tipe === "Buku Undangan" || tipe === "Catering") defaultQty = 0;
                    let newPkg = {...pkg, qty: defaultQty};
                    this.selectedLayanan = {...this.selectedLayanan, [tipe]: [newPkg]};
                    return;
                }
                
                let items = [...this.selectedLayanan[tipe]];
                const index = items.findIndex(item => item.id === pkg.id);
                
                if (index !== -1) {
                    items.splice(index, 1);
                    if (items.length === 0) {
                        let copy = {...this.selectedLayanan};
                        delete copy[tipe];
                        this.selectedLayanan = copy;
                    } else {
                        this.selectedLayanan = {...this.selectedLayanan, [tipe]: items};
                    }
                } else {
                    let defaultQty = 1;
                    if (tipe === "Buku Undangan" || tipe === "Catering") defaultQty = 0;
                    let newPkg = {...pkg, qty: defaultQty};
                    this.selectedLayanan = {...this.selectedLayanan, [tipe]: [...items, newPkg]};
                }
            },
            updateLayananQty(tipe, id, qty) {
                if (!this.selectedLayanan[tipe]) return;
                let items = [...this.selectedLayanan[tipe]];
                const index = items.findIndex(item => item.id === id);
                if (index !== -1) {
                    items[index].qty = Math.max(1, Number(qty) || 1);
                    this.selectedLayanan = {...this.selectedLayanan, [tipe]: items};
                }
            },
            get totalLayanan() {
                if (this.idPaketBundling) return 0;
                let t = 0;
                Object.values(this.selectedLayanan).forEach(items => {
                    items.forEach(l => t += (Number(l.harga) * (Number(l.qty) || 1)));
                });
                return t;
            },
            selectBundling(id) {
                this.idPaketBundling = id;
                const pkg = this.bundlingsData.find(b => b.id == id);
                this.hargaBundling = pkg ? Number(pkg.harga) : 0;
                if (id) {
                    this.selectedLayanan = {}; // Clear individual services if bundle chosen
                }
            },
            get grandTotal() {
                return Number(this.totalLayanan) + Number(this.biayaVenue) + Number(this.hargaBundling);
            },
            validateStep1() {
                if (this.jenisAcara === "Lainnya" && !this.customJenisAcara.trim()) return "Mohon tuliskan jenis acara Anda.";
                if (!this.jenisAcara) return "Mohon pilih jenis acara.";
                if (!this.namaLengkap.trim()) return "Mohon isi nama lengkap Anda.";
                if (!this.noWhatsapp.trim()) return "Mohon isi nomor WhatsApp yang dapat dihubungi.";
                if (!this.tanggalAcara) return "Mohon pilih tanggal rencana acara.";
                
                const today = new Date().toISOString().split("T")[0];
                if (this.tanggalAcara < today) return "Tanggal acara tidak boleh di masa lalu.";
                
                if (!this.jumlahTamu || this.jumlahTamu <= 0) return "Mohon isi jumlah tamu dengan benar.";
                if (this.jumlahTamu > 1500) return "Jumlah tamu maksimal 1500 orang.";
                if (!this.acaraMulai) return "Mohon isi jam mulai acara.";
                if (!this.acaraSelesai) return "Mohon isi jam selesai acara.";
                
                const [hM, mM] = this.acaraMulai.split(":").map(Number);
                const [hS, mS] = this.acaraSelesai.split(":").map(Number);
                if ((hS * 60 + mS) <= (hM * 60 + mM)) return "Jam selesai harus setelah jam mulai.";
                
                return true;
            },
            async checkDateAvailability() {
                if (!this.tanggalAcara) return;
                
                // Cek jika tanggal masa lalu
                const today = new Date().toISOString().split("T")[0];
                if (this.tanggalAcara < today) return; 

                try {
                    const response = await fetch(`/booking/check-date?tanggal=${this.tanggalAcara}`);
                    const data = await response.json();
                    if (data.booked) {
                        this.tanggalAcara = ""; // Kosongkan input
                        this.showWarning("Maaf, tanggal ini sudah di-booking oleh pelanggan lain. Silakan pilih tanggal yang berbeda untuk acara Anda.");
                    }
                } catch (e) {
                    console.error("Gagal memeriksa ketersediaan tanggal:", e);
                }
            },
            canStep3() {
                return this.metodePembayaran && this.bank;
            },
            doSubmit() {
                if (!this.canStep3()) return;
                this.step = 4;
            },
            showWarning(msg) {
                Swal.fire({
                    icon: "warning",
                    title: "Perhatian",
                    text: msg,
                    background: "#231d18",
                    color: "#f0e8d8",
                    confirmButtonColor: "#c9a84c",
                    confirmButtonText: "MENGERTI",
                    customClass: {
                        popup: "border border-[#c9a84c]/30 rounded-xl",
                        title: "font-serif text-[#c9a84c] text-2xl tracking-wide",
                        confirmButton: "font-bold tracking-[0.1em] text-[#1a140e] rounded-sm px-6 py-2.5 uppercase text-sm"
                    }
                });
            }
        }'>

            {{-- Form Structure --}}
            <form method="POST" action="{{ route('booking.storeOrder') }}" x-ref="orderForm" class="w-full">
                @csrf
                <input type="hidden" name="jenis_acara" :value="jenisAcara === 'Lainnya' ? customJenisAcara : jenisAcara">
                <input type="hidden" name="metode_pembayaran" x-model="metodePembayaran">
                <input type="hidden" name="bank" x-model="bank">
                <input type="hidden" name="id_paket_bundling" x-model="idPaketBundling">
                <template x-for="tipe in Object.keys(selectedLayanan)" :key="'h-'+tipe">
                    <template x-for="item in selectedLayanan[tipe]" :key="'h-item-'+item.id">
                        <div>
                            <input type="hidden" name="layanan[]" :value="item.id">
                            <input type="hidden" :name="'layanan_qty['+item.id+']'" :value="item.qty">
                        </div>
                    </template>
                </template>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 xl:gap-16 max-w-6xl mx-auto">

                    {{-- ====== LEFT COLUMN: Form Steps (2/3 width) ====== --}}
                    <div class="lg:col-span-2 relative">

                        {{-- Step Indicators (Left aligned to form) --}}
                        <div class="flex items-center justify-between mb-12 max-w-sm relative px-2">
                            {{-- Connecting Line --}}
                            <div class="absolute top-4 left-6 right-6 h-[1px]">
                                <div class="absolute inset-0 bg-[#4a4239]"></div>
                                <div class="absolute top-0 left-0 h-full bg-[#c9a84c] transition-all duration-500"
                                     :style="'width: ' + ((step - 1) * 100 / 3) + '%'"></div>
                            </div>

                            @foreach(['ACARA', 'LAYANAN', 'PEMBAYARAN', 'KONFIRMASI'] as $i => $label)
                                <div class="relative z-10 flex flex-col items-center w-8">
                                    <div :class="step === {{ $i + 1 }} ? 'border-[#c9a84c] text-[#c9a84c] scale-110 bg-dark' : (step > {{ $i + 1 }} ? 'border-[#c9a84c] bg-[#c9a84c] text-[#1a140e]' : 'border-[#6b5e4f] text-[#a89880] bg-[#231d18]')"
                                         class="w-8 h-8 rounded-full border-2 flex items-center justify-center transition-all duration-300 shadow-md">
                                        <span class="text-[12px] font-sans font-bold leading-none translate-y-[1px]">{{ $i + 1 }}</span>
                                    </div>
                                    <span :class="step >= {{ $i + 1 }} ? 'text-[#c9a84c]' : 'text-[#a89880]'"
                                          class="absolute left-1/2 -translate-x-1/2 text-[9px] font-serif tracking-[0.2em] font-bold uppercase whitespace-nowrap" style="top: 48px;">{{ $label }}</span>
                                </div>
                            @endforeach
                        </div>

                        {{-- Forms --}}
                        <div class="pr-0 xl:pr-6">
                            @include('frontend.partials.order-step1')
                            @include('frontend.partials.order-step2')
                            @include('frontend.partials.order-step3')
                            @include('frontend.partials.order-step4')
                        </div>
                    </div>

                    {{-- ====== RIGHT COLUMN: Summary (1/3 width) ====== --}}
                    <div class="lg:col-span-1">
                        @include('frontend.partials.order-summary')
                    </div>

                </div>
            </form>
        </div>
    </div>
</section>
</section>
