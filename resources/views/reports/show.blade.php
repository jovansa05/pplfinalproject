<x-app-layout>
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-3xl border border-gray-100">
                
                {{-- FOTO UTAMA (BESAR) --}}
                <div class="relative h-64 md:h-96 w-full bg-gray-200">
                    <img src="{{ asset('storage/' . $report->image) }}" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute bottom-6 left-6 text-white">
                        <span class="bg-indigo-600 px-3 py-1 rounded-lg text-xs font-bold shadow-lg mb-2 inline-block">
                            {{ $report->category->name }}
                        </span>
                        <h1 class="text-3xl font-extrabold shadow-sm">Laporan #{{ $report->ticket_number }}</h1>
                        <p class="opacity-90 text-sm mt-1">📅 {{ $report->created_at->translatedFormat('d F Y, H:i') }} WIB</p>
                    </div>
                </div>

                <div class="p-8 grid grid-cols-1 md:grid-cols-3 gap-8">
                    
                    {{-- KOLOM KIRI: INFO --}}
                    <div class="md:col-span-2 space-y-6">
                        
                        {{-- === KOTAK SPESIAL ADMIN (MUNCUL DISINI) === --}}
                        @if($report->status == 'selesai')
                            <div class="bg-green-50 border border-green-200 rounded-2xl p-6 animate-fade-in-down">
                                <h3 class="text-green-800 font-bold text-lg flex items-center gap-2 mb-3">
                                    🎉 Laporan Selesai!
                                </h3>
                                <div class="bg-white p-4 rounded-xl border border-green-100 text-green-900 italic shadow-sm mb-4">
                                    "{{ $report->admin_note ?? 'Tindak lanjut telah selesai.' }}"
                                </div>
                                
                                @if($report->completion_proof)
                                    <div>
                                        <p class="text-xs font-bold text-green-600 uppercase mb-2">Bukti Penyelesaian:</p>
                                        <a href="{{ asset('storage/' . $report->completion_proof) }}" target="_blank">
                                            <img src="{{ asset('storage/' . $report->completion_proof) }}" class="h-48 rounded-xl shadow-md border border-green-200 hover:scale-105 transition cursor-zoom-in">
                                        </a>
                                    </div>
                                @endif
                            </div>
                        @elseif($report->status == 'ditolak')
                            <div class="bg-red-50 border border-red-200 rounded-2xl p-6 animate-fade-in-down">
                                <h3 class="text-red-800 font-bold text-lg flex items-center gap-2 mb-3">
                                    ⛔ Laporan Ditolak
                                </h3>
                                <div class="bg-white p-4 rounded-xl border border-red-100 text-red-900 font-medium shadow-sm">
                                    "{{ $report->admin_note ?? 'Mohon maaf, data kurang lengkap.' }}"
                                </div>
                            </div>
                        @endif
                        {{-- =========================================== --}}

                        <div>
                            <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-2">Deskripsi</h3>
                            <p class="text-gray-800 text-lg leading-relaxed">{{ $report->description }}</p>
                        </div>

                        <div>
                            <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-2">Lokasi</h3>
                            <div class="bg-gray-50 p-4 rounded-xl border border-gray-200 flex justify-between items-center">
                                <span class="text-gray-700 font-medium">📍 {{ $report->location }}</span>
                                <a href="https://www.google.com/maps/search/?api=1&query=$${{ $report->latitude }},{{ $report->longitude }}" target="_blank" class="text-blue-600 font-bold text-sm hover:underline">
                                    Buka Peta ↗
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- KOLOM KANAN: STATUS --}}
                    <div>
                        <div class="bg-white border border-gray-100 shadow-xl rounded-2xl p-6 sticky top-6">
                            <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-4">Status Terkini</h3>
                            
                            @if($report->status == 'pending')
                                <div class="w-full py-3 bg-yellow-100 text-yellow-800 text-center font-bold rounded-xl text-lg">⏳ Menunggu</div>
                                <p class="text-xs text-center text-gray-400 mt-2">Menunggu verifikasi admin</p>
                            @elseif($report->status == 'proses')
                                <div class="w-full py-3 bg-blue-100 text-blue-800 text-center font-bold rounded-xl text-lg">⚙️ Diproses</div>
                                <p class="text-xs text-center text-gray-400 mt-2">Petugas sedang bekerja</p>
                            @elseif($report->status == 'selesai')
                                <div class="w-full py-3 bg-green-100 text-green-800 text-center font-bold rounded-xl text-lg">✅ Selesai</div>
                                <p class="text-xs text-center text-gray-400 mt-2">Kasus ditutup</p>
                            @else
                                <div class="w-full py-3 bg-red-100 text-red-800 text-center font-bold rounded-xl text-lg">❌ Ditolak</div>
                            @endif

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>