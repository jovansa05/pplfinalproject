<x-app-layout>
    <div class="relative pb-32 pt-16 bg-cover bg-center" 
         style="background-image: url('{{ asset('images/auth-bg.jpg') }}');">
        
        <div class="absolute inset-0 bg-gradient-to-r from-indigo-900/90 to-purple-800/80"></div>

        <div class="relative max-w-7xl mx-auto sm:px-6 lg:px-8 z-10">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center text-white px-4">
                <div>
                    <h2 class="text-3xl font-extrabold tracking-tight text-white drop-shadow-md">
                        Daftar Laporan
                    </h2>
                    <p class="text-indigo-100 text-lg font-medium opacity-90">
                        Kelola semua laporan dari masyarakat
                    </p>
                </div>

                <a href="{{ route('admin.dashboard') }}" class="mt-4 md:mt-0 inline-flex items-center gap-2 px-4 py-2 bg-white/10 backdrop-blur-md border border-white/20 rounded-xl text-white hover:bg-white/20 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 -mt-24 px-4 pb-12 relative z-20">
        
        {{-- Filter Section --}}
        <div class="bg-white rounded-2xl shadow-xl p-6 mb-6">
            <form action="{{ route('admin.reports.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                {{-- Search --}}
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Cari</label>
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="No. Tiket, lokasi, deskripsi..." 
                           class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                </div>

                {{-- Category Filter --}}
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Kategori</label>
                    <select name="category" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Status Filter --}}
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Status</label>
                    <select name="status" class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                        <option value="proses" {{ request('status') == 'proses' ? 'selected' : '' }}>Diproses</option>
                        <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>

                {{-- Buttons --}}
                <div class="flex items-end gap-2">
                    <button type="submit" class="flex-1 px-4 py-2 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 transition">
                        Filter
                    </button>
                    <a href="{{ route('admin.reports.index') }}" class="px-4 py-2 bg-gray-100 text-gray-600 font-bold rounded-xl hover:bg-gray-200 transition">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6">
                {{ session('success') }}
            </div>
        @endif

        {{-- Reports Table --}}
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                    📋 Semua Laporan
                </h3>
                <span class="text-sm text-gray-500">Total: {{ $reports->total() }} laporan</span>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Tiket</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Pelapor</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Kategori</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Lokasi</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($reports as $report)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="font-mono text-sm font-bold text-indigo-600 bg-indigo-50 px-2 py-1 rounded-md">
                                    #{{ $report->ticket_number }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <img class="h-8 w-8 rounded-full" 
                                         src="https://ui-avatars.com/api/?name={{ urlencode($report->user->name ?? 'User') }}&background=random&size=32" 
                                         alt="">
                                    <div>
                                        <span class="text-sm font-medium text-gray-900">{{ $report->user->name ?? 'User' }}</span>
                                        <p class="text-xs text-gray-500">{{ $report->user->email ?? '' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-purple-100 text-purple-700">
                                    {{ $report->category->name ?? 'Lainnya' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm text-gray-900">{{ Str::limit($report->location, 30) }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($report->status == 'pending')
                                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-700">
                                        <span class="w-2 h-2 rounded-full bg-yellow-400 animate-pulse"></span>
                                        Menunggu
                                    </span>
                                @elseif($report->status == 'proses')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-700">
                                        Diproses
                                    </span>
                                @elseif($report->status == 'selesai')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700">
                                        Selesai
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700">
                                        Ditolak
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm text-gray-500">{{ $report->created_at->format('d M Y') }}</span>
                                <p class="text-xs text-gray-400">{{ $report->created_at->format('H:i') }} WIB</p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.reports.show', $report) }}" 
                                       class="inline-flex items-center px-3 py-1.5 bg-indigo-50 text-indigo-600 font-bold text-xs rounded-lg hover:bg-indigo-100 transition">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        Detail
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="text-gray-400">
                                    <p class="text-4xl mb-2">📭</p>
                                    <p class="font-medium">Tidak ada laporan ditemukan</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($reports->hasPages())
                <div class="px-6 py-4 border-t border-gray-100">
                    {{ $reports->links() }}
                </div>
            @endif
        </div>

    </div>
</x-app-layout>
