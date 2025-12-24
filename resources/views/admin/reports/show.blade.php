<x-app-layout>
    <div class="relative pb-32 pt-16 bg-cover bg-center" 
         style="background-image: url('{{ asset('images/auth-bg.jpg') }}');">
        
        <div class="absolute inset-0 bg-gradient-to-r from-indigo-900/90 to-purple-800/80"></div>

        <div class="relative max-w-7xl mx-auto sm:px-6 lg:px-8 z-10">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center text-white px-4">
                <div>
                    <h2 class="text-3xl font-extrabold tracking-tight text-white drop-shadow-md">
                        Detail Laporan
                    </h2>
                    <p class="text-indigo-100 text-lg font-medium opacity-90">
                        #{{ $report->ticket_number }}
                    </p>
                </div>

                <a href="{{ route('admin.reports.index') }}" class="mt-4 md:mt-0 inline-flex items-center gap-2 px-4 py-2 bg-white/10 backdrop-blur-md border border-white/20 rounded-xl text-white hover:bg-white/20 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Daftar
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 -mt-24 px-4 pb-12 relative z-20">
        
        {{-- Success Message --}}
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            {{-- Main Content --}}
            <div class="lg:col-span-2 space-y-6">
                
                {{-- Report Info --}}
                <div class="bg-white rounded-2xl shadow-xl p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                        📋 Informasi Laporan
                    </h3>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wider font-bold">No. Tiket</p>
                            <p class="text-lg font-mono font-bold text-indigo-600">#{{ $report->ticket_number }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wider font-bold">Kategori</p>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-purple-100 text-purple-700 mt-1">
                                {{ $report->category->name ?? 'Lainnya' }}
                            </span>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wider font-bold">Tanggal Laporan</p>
                            <p class="text-gray-800 font-medium">{{ $report->created_at->format('d F Y, H:i') }} WIB</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase tracking-wider font-bold">Status Saat Ini</p>
                            @if($report->status == 'pending')
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-sm font-bold bg-yellow-100 text-yellow-700 mt-1">
                                    <span class="w-2 h-2 rounded-full bg-yellow-400 animate-pulse"></span>
                                    Menunggu
                                </span>
                            @elseif($report->status == 'proses')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-blue-100 text-blue-700 mt-1">
                                    Diproses
                                </span>
                            @elseif($report->status == 'selesai')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-green-100 text-green-700 mt-1">
                                    Selesai
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-red-100 text-red-700 mt-1">
                                    Ditolak
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Description --}}
                <div class="bg-white rounded-2xl shadow-xl p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                        📝 Deskripsi Laporan
                    </h3>
                    <p class="text-gray-700 leading-relaxed">{{ $report->description }}</p>
                </div>

                {{-- Location --}}
                <div class="bg-white rounded-2xl shadow-xl p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                        📍 Lokasi
                    </h3>
                    <p class="text-gray-700 mb-3">{{ $report->location }}</p>
                    <a href="https://www.google.com/maps/search/?api=1&query={{ $report->latitude }},{{ $report->longitude }}" 
                       target="_blank" 
                       class="inline-flex items-center gap-2 px-4 py-2 bg-blue-50 text-blue-600 font-bold rounded-xl hover:bg-blue-100 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Lihat di Google Maps
                    </a>
                </div>

                {{-- Photo Evidence --}}
                <div class="bg-white rounded-2xl shadow-xl p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                        📷 Bukti Foto
                    </h3>
                    <a href="{{ asset('storage/' . $report->image) }}" target="_blank">
                        <img src="{{ asset('storage/' . $report->image) }}" 
                             alt="Bukti Laporan" 
                             class="w-full max-w-md rounded-xl shadow-md hover:shadow-xl transition cursor-pointer"
                             onerror="this.src='https://via.placeholder.com/400x300?text=Foto+Tidak+Tersedia'">
                    </a>
                </div>

            </div>

            {{-- Sidebar --}}
            <div class="space-y-6">
                
                {{-- Reporter Info --}}
                <div class="bg-white rounded-2xl shadow-xl p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                        👤 Informasi Pelapor
                    </h3>
                    <div class="flex items-center gap-4 mb-4">
                        <img class="h-16 w-16 rounded-full shadow-md" 
                             src="https://ui-avatars.com/api/?name={{ urlencode($report->user->name ?? 'User') }}&background=random&size=64" 
                             alt="">
                        <div>
                            <p class="font-bold text-gray-800">{{ $report->user->name ?? 'User' }}</p>
                            <p class="text-sm text-gray-500">{{ $report->user->email ?? '' }}</p>
                        </div>
                    </div>
                </div>

                {{-- Update Status --}}
                <div class="bg-white rounded-2xl shadow-xl p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                        ⚙️ Ubah Status
                    </h3>
                    <form action="{{ route('admin.reports.updateStatus', $report->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            
                            <label class="block text-xs font-bold text-indigo-200 uppercase mb-2">Pilih Status Baru</label>
                            <select name="status" id="statusSelect" onchange="toggleInputs()" class="w-full px-4 py-3 border-none rounded-xl text-gray-800 focus:ring-4 focus:ring-indigo-400 mb-4 font-bold cursor-pointer">
                                <option value="pending" {{ $report->status == 'pending' ? 'selected' : '' }}>Menunggu</option>
                                <option value="proses" {{ $report->status == 'proses' ? 'selected' : '' }}>Diproses</option>
                                <option value="selesai" {{ $report->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="ditolak" {{ $report->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>

                            {{-- Input Tambahan (Hidden by Default) --}}
                            <div id="additionalInput" class="hidden space-y-3 mb-4 bg-indigo-800 p-3 rounded-lg border border-indigo-500">
                                
                                {{-- Label Dinamis --}}
                                <label id="noteLabel" class="block text-xs font-bold text-white uppercase">Catatan Admin</label>
                                <textarea name="admin_note" id="adminNote" rows="3" class="w-full rounded-lg border-gray-300 text-gray-900 text-sm p-2" placeholder="Tulis alasan atau tanggapan..."></textarea>

                                {{-- Upload Bukti (Khusus Selesai) --}}
                                <div id="proofInput" class="hidden">
                                    <label class="block text-xs font-bold text-white uppercase mb-1">Upload Bukti Penyelesaian (Foto)</label>
                                    <input type="file" name="completion_proof" class="block w-full text-sm text-indigo-100 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                                </div>
                            </div>

                            <button type="submit" class="w-full px-4 py-3 bg-white text-indigo-700 font-bold rounded-xl hover:bg-gray-50 transition shadow-lg transform hover:-translate-y-0.5">
                                Update Status 📧
                            </button>
                        </form>

                        {{-- Script Sederhana untuk Show/Hide --}}
                        <script>
                            function toggleInputs() {
                                const status = document.getElementById('statusSelect').value;
                                const container = document.getElementById('additionalInput');
                                const proofDiv = document.getElementById('proofInput');
                                const noteLabel = document.getElementById('noteLabel');
                                const noteInput = document.getElementById('adminNote');

                                // Reset
                                container.classList.add('hidden');
                                proofDiv.classList.add('hidden');
                                noteInput.removeAttribute('required');

                                if (status === 'ditolak') {
                                    container.classList.remove('hidden');
                                    noteLabel.innerText = "Alasan Penolakan (Wajib)";
                                    noteInput.setAttribute('required', 'required'); // Wajib isi
                                } 
                                else if (status === 'selesai') {
                                    container.classList.remove('hidden');
                                    proofDiv.classList.remove('hidden');
                                    noteLabel.innerText = "Tanggapan Penyelesaian";
                                    // noteInput.setAttribute('required', 'required'); // Opsional, tergantung maumu
                                }
                            }
                        </script>
                </div>

            </div>
        </div>

    </div>
</x-app-layout>
