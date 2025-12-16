<x-app-layout>
    <div class="relative pb-32 pt-16 bg-cover bg-center" 
         style="background-image: url('{{ asset('images/auth-bg.jpg') }}');">
        
        <div class="absolute inset-0 bg-gradient-to-r from-indigo-900/90 to-purple-800/80"></div>

        <div class="relative max-w-7xl mx-auto sm:px-6 lg:px-8 z-10">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center text-white px-4">
                
                <div class="flex items-center gap-4">
                    <div class="p-1 bg-white/20 rounded-full backdrop-blur-md">
                        <img class="h-16 w-16 rounded-full border-2 border-white shadow-md object-cover" 
                             src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random&color=fff" 
                             alt="Admin Avatar">
                    </div>
                    <div>
                        <h2 class="text-3xl font-extrabold tracking-tight text-white drop-shadow-md">
                            Dashboard Admin
                        </h2>
                        <p class="text-indigo-100 text-lg font-medium opacity-90">
                            Selamat datang, {{ explode(' ', Auth::user()->name)[0] }}!
                        </p>
                    </div>
                </div>

                <div class="mt-6 md:mt-0 bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl px-5 py-3 text-right shadow-lg">
                    <p class="text-xs text-indigo-200 uppercase tracking-widest font-bold">Hari ini</p>
                    <p class="text-xl font-bold text-white">{{ now()->translatedFormat('l, d F Y') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 -mt-24 px-4 pb-12 relative z-20">
        
        <h3 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
            Statistik Overview
        </h3>

        <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-10">
            <div class="bg-white rounded-2xl p-5 shadow-xl border-b-4 border-indigo-200 hover:-translate-y-1 transition duration-300">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Total User</p>
                        <p class="text-3xl font-extrabold text-indigo-600 mt-1">{{ $totalUsers }}</p>
                    </div>
                    <div class="p-2 bg-indigo-50 rounded-lg text-2xl">👥</div>
                </div>
            </div>
            <div class="bg-white rounded-2xl p-5 shadow-xl border-b-4 border-gray-200 hover:-translate-y-1 transition duration-300">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Total Laporan</p>
                        <p class="text-3xl font-extrabold text-gray-800 mt-1">{{ $totalReports }}</p>
                    </div>
                    <div class="p-2 bg-gray-50 rounded-lg text-2xl">📝</div>
                </div>
            </div>
            <div class="bg-white rounded-2xl p-5 shadow-xl border-b-4 border-yellow-200 hover:-translate-y-1 transition duration-300">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Menunggu</p>
                        <p class="text-3xl font-extrabold text-yellow-500 mt-1">{{ $pendingReports }}</p>
                    </div>
                    <div class="p-2 bg-yellow-50 rounded-lg text-2xl">⏳</div>
                </div>
            </div>
            <div class="bg-white rounded-2xl p-5 shadow-xl border-b-4 border-blue-200 hover:-translate-y-1 transition duration-300">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Diproses</p>
                        <p class="text-3xl font-extrabold text-blue-500 mt-1">{{ $processReports }}</p>
                    </div>
                    <div class="p-2 bg-blue-50 rounded-lg text-2xl">⚙️</div>
                </div>
            </div>
            <div class="bg-white rounded-2xl p-5 shadow-xl border-b-4 border-green-200 hover:-translate-y-1 transition duration-300">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Selesai</p>
                        <p class="text-3xl font-extrabold text-green-500 mt-1">{{ $completedReports }}</p>
                    </div>
                    <div class="p-2 bg-green-50 rounded-lg text-2xl">✅</div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100">
                <h3 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                    📋 Laporan Terbaru
                </h3>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Pelapor</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Judul</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($recentReports as $report)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm font-medium text-gray-600">#{{ $report->id }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <img class="h-8 w-8 rounded-full" 
                                         src="https://ui-avatars.com/api/?name={{ urlencode($report->user->name ?? 'User') }}&background=random&size=32" 
                                         alt="">
                                    <span class="text-sm font-medium text-gray-900">{{ $report->user->name ?? 'User' }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm text-gray-900">{{ Str::limit($report->title ?? $report->description, 40) }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($report->status == 'pending')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-700">
                                        Menunggu
                                    </span>
                                @elseif($report->status == 'proses')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-700">
                                        Diproses
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700">
                                        Selesai
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm text-gray-500">{{ $report->created_at->format('d M Y') }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="text-gray-400">
                                    <p class="text-4xl mb-2">📭</p>
                                    <p class="font-medium">Belum ada laporan</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-16 text-center border-t border-gray-100 pt-8">
            <p class="text-sm text-gray-400">
                &copy; {{ date('Y') }} KotaKita Surabaya - Admin Panel
            </p>
        </div>

    </div>
</x-app-layout>
