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
                                <tr class="report-row bg-white rounded-2xl shadow-sm hover:shadow-xl hover:scale-[1.01] transition-all duration-300 border border-gray-100 group cursor-pointer"
                                    data-ticket="{{ $report->ticket_number }}"
                                    data-category="{{ $report->category->name ?? 'Lainnya' }}"  
                                    data-date="{{ $report->created_at->format('d M Y H:i') }} WIB"
                                    data-status="{{ $report->status }}"
                                    data-location="{{ $report->location }}"
                                    data-latitude="{{ $report->latitude }}"
                                    data-longitude="{{ $report->longitude }}"
                                    data-description="{{ $report->description }}"
                                    data-image="{{ asset('storage/' . $report->image) }}">

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
            <div id="reportModal"
                class="fixed inset-0 hidden bg-black/50 z-50 items-center justify-center">
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelector('tbody').addEventListener('click', function (e) {
                const row = e.target.closest('.report-row');
                if (!row) return;
                openReportModal(row);
            });
        });

        
        function openReportModal(row) {
            const modal = document.getElementById('reportModal');

            const statusMap = {
                pending: {
                    text: 'MENUNGGU',
                    class: 'bg-yellow-50 text-yellow-700 border-yellow-200'
                },
                proses: {
                    text: 'DIPROSES',
                    class: 'bg-blue-50 text-blue-700 border-blue-200'
                },
                selesai: {
                    text: 'SELESAI',
                    class: 'bg-green-50 text-green-700 border-green-200'
                }
            };

            const status = statusMap[row.dataset.status] ?? {
                text: row.dataset.status.toUpperCase(),
                class: 'bg-gray-100 text-gray-700 border-gray-300'
            };

            modal.innerHTML = `
            <div class="absolute inset-0" onclick="closeReportModal()"></div>

                <div onclick="event.stopPropagation()"
                    class="bg-white rounded-3xl max-w-xl w-full mx-4 shadow-2xl relative z-10 animate-scaleIn overflow-hidden">

                <!-- HEADER -->
                <div class="p-5 border-b flex justify-between items-center bg-gray-50">
                    <div class="flex items-center gap-3">
                        <img src="/images/logo_surabaya.png"
                            class="w-15 h-14 object-contain">
                        <div>
                            <p class="text-sm font-bold text-green-700">KotaKita Surabaya</p>
                            <span class="text-xs text-gray-500">Laporan Anda</span>
                        </div>
                    </div>

                    <button onclick="closeReportModal()"
                            class="text-gray-400 hover:text-red-500 text-2xl">&times;</button>
                </div>

                <!-- META -->
                <div class="px-6 pt-4 flex items-center justify-between">

                   
                    <div class="flex items-center gap-3">
                        <span class="font-mono text-xs font-bold text-blue-600 bg-blue-50 px-2 py-1 rounded border">
                            #${row.dataset.ticket}
                        </span>

                    </div>

                    <span class="inline-flex px-3 py-1 rounded-full text-xs font-bold border ${row.dataset.date}">
                      ${row.dataset.date}
                    </span>

                </div>


                <!-- IMAGE -->
                <div class="relative mt-4">
                    <img src="${row.dataset.image}" class="w-full h-60 object-cover">
                    <div class="absolute bottom-3 left-3 bg-white/90 px-3 py-1 rounded-full text-xs font-bold shadow">
                        ${row.dataset.category}
                    </div>
                </div>

                <!-- CONTENT -->
                <div class="p-6 space-y-4">

                    <!-- DESKRIPSI -->
                    <div>
                        <h3 class="text-sm font-bold text-gray-500 uppercase mb-1">Deskripsi</h3>
                        <p class="text-gray-700">${row.dataset.description}</p>
                    </div>

                    <!-- LOKASI -->
                    <div>
                        <h3 class="text-sm font-bold text-gray-500 uppercase mb-1">Lokasi</h3>
                        <p class="text-gray-700 flex gap-2">📍 ${row.dataset.location}</p>
                    </div>

                    <!-- STATUS + MAPS (SEJAJAR, MAPS KIRI - STATUS KANAN) -->
                    <div class="flex items-center justify-between pt-2">

                       
                        <a href="https://www.google.com/maps/search/?api=1&query=${row.dataset.latitude},${row.dataset.longitude}"
                        target="_blank"
                        class="inline-flex items-center gap-2 text-sm font-bold text-blue-600 hover:underline">
                            🗺️ Lihat di Google Maps
                        </a>
                        
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold border ${status.class}">
                            <span class="w-2 h-2 rounded-full bg-current animate-pulse"></span>
                            ${status.text}
                        </div>

                    </div>
                </div>
            </div>
            `;

            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeReportModal() {
            const modal = document.getElementById('reportModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
        </script>


</x-app-layout>