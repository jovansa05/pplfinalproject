<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Laporan') }}
        </h2>
    </x-slot>

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
                            </tr>
                        </thead>

                        <tbody class="space-y-4">
                            @foreach($reports as $report)
                                <tr class="bg-white rounded-2xl shadow-sm hover:shadow-xl hover:scale-[1.01] transition-all duration-300 border border-gray-100 group">
                                    
                                    <td class="px-6 py-5 rounded-l-2xl">
                                        <div class="flex flex-col gap-2">
                                            <span class="font-mono text-xs font-bold text-blue-600 bg-blue-50 px-2 py-1 rounded-md w-fit border border-blue-100">
                                                #{{ $report->ticket_number }}
                                            </span>
                                            <span class="font-bold text-gray-800 text-lg group-hover:text-green-600 transition">
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
                                        <div class="w-16 h-16 rounded-xl overflow-hidden border-2 border-white shadow-md relative group/img cursor-pointer">
                                            <a href="{{ asset('storage/' . $report->image) }}" target="_blank">
                                                <img src="{{ asset('storage/' . $report->image) }}" 
                                                     class="w-full h-full object-cover group-hover/img:scale-125 transition duration-500"
                                                     onerror="this.src='https://via.placeholder.com/150?text=No+Img'">
                                                <div class="absolute inset-0 bg-black/20 group-hover/img:bg-transparent transition"></div>
                                            </a>
                                        </div>
                                    </td>

                                    <td class="px-6 py-5 max-w-xs">
                                        <div class="flex flex-col gap-1">
                                            <div class="flex items-center gap-1 text-gray-800 font-medium truncate" title="{{ $report->location }}">
                                                <svg class="w-4 h-4 text-red-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                                {{ Str::limit($report->location, 30) }}
                                            </div>
                                            <a href="https://www.google.com/maps/search/?api=1&query={{ $report->latitude }},{{ $report->longitude }}" target="_blank" class="text-xs text-blue-500 hover:text-blue-700 font-bold pl-5 hover:underline">
                                                Lihat di Peta &rarr;
                                            </a>
                                        </div>
                                    </td>

                                    <td class="px-6 py-5 rounded-r-2xl text-center">
                                        @if($report->status == 'pending')
                                            <div class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-yellow-50 border border-yellow-200 text-yellow-700 text-xs font-bold tracking-wide shadow-sm">
                                                <span class="w-2 h-2 rounded-full bg-yellow-400 animate-pulse"></span>
                                                MENUNGGU
                                            </div>
                                        @elseif($report->status == 'proses')
                                            <div class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-blue-50 border border-blue-200 text-blue-700 text-xs font-bold tracking-wide shadow-sm">
                                                <svg class="w-3 h-3 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                                DIPROSES
                                            </div>
                                        @elseif($report->status == 'selesai')
                                            <div class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-green-50 border border-green-200 text-green-700 text-xs font-bold tracking-wide shadow-sm">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                SELESAI
                                            </div>
                                        @else
                                            <div class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-red-50 border border-red-200 text-red-700 text-xs font-bold tracking-wide shadow-sm">
                                                DITOLAK
                                            </div>
                                        @endif
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