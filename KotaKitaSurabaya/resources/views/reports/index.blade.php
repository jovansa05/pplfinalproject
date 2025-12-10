<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
                <div>
                    <h3 class="text-2xl font-bold text-gray-800">Pantau Status Laporanmu 🧐</h3>
                    <p class="text-gray-500">Lihat perkembangan laporan lingkungan yang sudah kamu kirim.</p>
                </div>
                <a href="{{ route('reports.create') }}" class="px-6 py-3 bg-green-600 text-white font-bold rounded-xl shadow-lg hover:bg-green-700 transition transform hover:-translate-y-1 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Buat Laporan Baru
                </a>
            </div>

            @if($reports->isEmpty())
                <div class="bg-white rounded-2xl p-10 text-center shadow-sm border border-gray-100">
                    <div class="text-6xl mb-4">📭</div>
                    <h4 class="text-xl font-bold text-gray-600">Belum ada laporan</h4>
                    <p class="text-gray-400 mt-2">Yuk bantu laporin masalah di sekitarmu!</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    
                    @foreach($reports as $report)
                        <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition duration-300 border border-gray-100 overflow-hidden group flex flex-col h-full">
                            
                            <div class="relative h-48 overflow-hidden bg-gray-100">
                                <img src="{{ asset('storage/' . $report->image) }}" 
                                     alt="Bukti Laporan"
                                     class="w-full h-full object-cover group-hover:scale-110 transition duration-500"
                                     onerror="this.src='https://via.placeholder.com/400x200?text=Foto+Tidak+Ditemukan'">
                                
                                <div class="absolute top-3 right-3">
                                    @if($report->status == 'pending')
                                        <span class="px-3 py-1 bg-yellow-400 text-yellow-900 text-xs font-bold rounded-full shadow-sm uppercase tracking-wider">⏳ Menunggu</span>
                                    @elseif($report->status == 'proses')
                                        <span class="px-3 py-1 bg-blue-500 text-white text-xs font-bold rounded-full shadow-sm uppercase tracking-wider">⚙️ Diproses</span>
                                    @elseif($report->status == 'selesai')
                                        <span class="px-3 py-1 bg-green-500 text-white text-xs font-bold rounded-full shadow-sm uppercase tracking-wider">✅ Selesai</span>
                                    @endif
                                </div>
                            </div>

                            <div class="p-6 flex flex-col flex-1">
                                <div class="flex justify-between items-start mb-4">
                                    <span class="text-xs font-mono font-bold text-green-600 bg-green-50 px-2 py-1 rounded select-all mt-1">
                                        #{{ $report->ticket_number }}
                                    </span>
                                    
                                    <div class="flex flex-col text-right">
                                        <span class="text-xs font-bold text-gray-700">
                                            {{ $report->created_at->format('d M Y') }}
                                        </span>
                                        <span class="text-[10px] text-gray-400">
                                            {{ $report->created_at->format('H:i') }} WIB
                                        </span>
                                    </div>
                                </div>

                                <div class="mb-2">
                                    <span class="text-xs font-bold text-gray-500 uppercase tracking-wide">
                                        {{ $report->category->name ?? 'Umum' }}
                                    </span>
                                </div>

                                <h4 class="text-lg font-bold text-gray-800 mb-2 line-clamp-2">
                                    {{ $report->description }}
                                </h4>
                                
                                <div class="flex items-start gap-2 text-sm text-gray-500 mb-4 bg-gray-50 p-2 rounded-lg mt-auto">
                                    <svg class="w-4 h-4 text-red-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    <span class="line-clamp-1 text-xs font-medium">
                                        {{ $report->location }}
                                    </span>
                                </div>

                                <div class="pt-4 border-t border-gray-100">
                                    <a href="https://www.google.com/maps/search/?api=1&query={{ $report->latitude }},{{ $report->longitude }}" target="_blank" class="text-sm font-bold text-blue-600 hover:text-blue-800 flex items-center gap-1 hover:underline">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                        Lihat Lokasi di Peta
                                    </a>
                                </div>
                            </div>

                        </div>
                    @endforeach

                </div>
            @endif

        </div>
    </div>
</x-app-layout>