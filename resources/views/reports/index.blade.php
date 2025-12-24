<x-app-layout>
    <div class="py-12 bg-gray-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="flex flex-col md:flex-row justify-between items-center mb-8 px-2">
                <div>
                    <h3 class="text-3xl font-extrabold text-gray-800 tracking-tight">
                        Riwayat Laporan 📜
                    </h3>
                    <p class="text-gray-500 mt-1 text-base">
                        Pantau terus progres laporanmu di sini.
                    </p>
                </div>
                <a href="{{ route('reports.create') }}" class="group px-6 py-3 bg-green-600 text-white font-bold rounded-2xl shadow-lg shadow-green-200 hover:bg-green-700 hover:shadow-green-300 transition-all transform hover:-translate-y-1 flex items-center gap-2">
                    <svg class="w-5 h-5 group-hover:rotate-90 transition duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Buat Laporan Baru
                </a>
            </div>

            @if($reports->isEmpty())
                <div class="bg-white rounded-3xl p-12 text-center shadow-sm border border-dashed border-gray-300">
                    <div class="text-6xl mb-4 animate-bounce">📦</div>
                    <h4 class="text-2xl font-bold text-gray-700">Belum ada laporan, nih!</h4>
                    <p class="text-gray-400 mt-2">Yuk jadilah pahlawan lingkungan pertama hari ini.</p>
                </div>
            @else
                
                <div class="overflow-x-auto px-2 pb-10">
                    <table class="w-full text-sm text-left text-gray-500 border-separate border-spacing-y-4">
                        
                        <thead class="text-xs text-gray-400 uppercase tracking-wider">
                            <tr>
                                <th scope="col" class="px-6 py-2 font-bold">Tiket & Kategori</th>
                                <th scope="col" class="px-6 py-2 font-bold">Waktu Laporan</th>
                                <th scope="col" class="px-6 py-2 font-bold">Bukti Foto</th>
                                <th scope="col" class="px-6 py-2 font-bold">Lokasi</th>
                                <th scope="col" class="px-6 py-2 font-bold text-center">Status</th>
                                <th scope="col" class="px-6 py-2 font-bold text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="space-y-4">
                            @foreach($reports as $report)
                                <tr class="bg-white rounded-2xl shadow-sm hover:shadow-md transition-all duration-300 border border-gray-100">

                                    <td class="px-6 py-5 rounded-l-2xl">
                                        <div class="flex flex-col gap-2">
                                            {{-- Tiket Jadi Link --}}
                                            <a href="{{ route('reports.show', $report->id) }}" class="font-mono text-xs font-bold text-blue-600 bg-blue-50 px-2 py-1 rounded-md w-fit border border-blue-100 hover:bg-blue-100 transition">
                                                #{{ $report->ticket_number }}
                                            </a>
                                            <span class="font-bold text-gray-800 text-lg">
                                                {{ $report->category->name ?? 'Lainnya' }}
                                            </span>
                                        </div>
                                    </td>

                                    <td class="px-6 py-5">
                                        <div class="flex items-center gap-2 text-gray-600">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            <span class="font-bold">{{ $report->created_at->format('d M Y') }}</span>
                                        </div>
                                        <div class="text-xs text-gray-400 mt-1 pl-6">
                                            {{ $report->created_at->format('H:i') }} WIB
                                        </div>
                                    </td>

                                    <td class="px-6 py-5">
                                        <div class="w-16 h-16 rounded-xl overflow-hidden border-2 border-white shadow-md relative">
                                            <img src="{{ asset('storage/' . $report->image) }}" 
                                                 class="w-full h-full object-cover"
                                                 onerror="this.src='https://via.placeholder.com/150?text=No+Img'">
                                        </div>
                                    </td>

                                    <td class="px-6 py-5 max-w-xs">
                                        <div class="flex flex-col gap-1">
                                            <div class="flex items-center gap-1 text-gray-800 font-medium truncate">
                                                <svg class="w-4 h-4 text-red-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                                {{ Str::limit($report->location, 25) }}
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-5 text-center">
                                        @if($report->status == 'pending')
                                            <div class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-yellow-50 border border-yellow-200 text-yellow-700 text-xs font-bold tracking-wide">
                                                <span class="w-2 h-2 rounded-full bg-yellow-400 animate-pulse"></span>
                                                MENUNGGU
                                            </div>
                                        @elseif($report->status == 'proses')
                                            <div class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-blue-50 border border-blue-200 text-blue-700 text-xs font-bold tracking-wide">
                                                ⚙️ DIPROSES
                                            </div>
                                        @elseif($report->status == 'selesai')
                                            <div class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-green-50 border border-green-200 text-green-700 text-xs font-bold tracking-wide">
                                                ✅ SELESAI
                                            </div>
                                        @else
                                            <div class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-red-50 border border-red-200 text-red-700 text-xs font-bold tracking-wide">
                                                ❌ DITOLAK
                                            </div>
                                        @endif
                                    </td>

                                    {{-- TOMBOL AKSI (BARU) --}}
                                    <td class="px-6 py-5 rounded-r-2xl text-center">
                                        <a href="{{ route('reports.show', $report->id) }}" class="inline-block bg-indigo-600 text-white px-4 py-2 rounded-xl text-xs font-bold hover:bg-indigo-700 transition shadow-lg shadow-indigo-200">
                                            Lihat Detail
                                        </a>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            @endif
        </div>
    </div>
</x-app-layout>