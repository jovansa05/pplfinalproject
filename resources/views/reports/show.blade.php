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

                            {{-- === FORM RATING / FEEDBACK === --}}
                            @if($userRating)
                                {{-- Tampilkan Rating yang Sudah Diberikan --}}
                                <div class="bg-yellow-50 border border-yellow-200 rounded-2xl p-6">
                                    <h3 class="text-yellow-800 font-bold text-lg flex items-center gap-2 mb-4">
                                        ⭐ Rating & Feedback Anda
                                    </h3>
                                    <div class="bg-white p-5 rounded-xl border border-yellow-100 shadow-sm">
                                        <div class="flex items-center gap-2 mb-3">
                                            <span class="text-2xl font-bold text-yellow-600">{{ $userRating->rating }}</span>
                                            <div class="flex">
                                                @for($i = 1; $i <= 5; $i++)
                                                    @if($i <= $userRating->rating)
                                                        <svg class="w-6 h-6 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                                        </svg>
                                                    @else
                                                        <svg class="w-6 h-6 text-gray-300 fill-current" viewBox="0 0 20 20">
                                                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                                        </svg>
                                                    @endif
                                                @endfor
                                            </div>
                                        </div>
                                        @if($userRating->comment)
                                            <p class="text-gray-700 italic">"{{ $userRating->comment }}"</p>
                                        @endif
                                        <p class="text-xs text-gray-500 mt-3">Diberikan pada {{ $userRating->created_at->translatedFormat('d F Y, H:i') }} WIB</p>
                                    </div>
                                </div>
                            @else
                                {{-- Form Rating Baru --}}
                                <div class="bg-blue-50 border border-blue-200 rounded-2xl p-6">
                                    <h3 class="text-blue-800 font-bold text-lg flex items-center gap-2 mb-4">
                                        💬 Berikan Rating & Feedback
                                    </h3>
                                    <p class="text-sm text-blue-700 mb-4">Bagaimana pengalaman Anda? Berikan penilaian dan masukan untuk laporan ini.</p>
                                    
                                    <form action="{{ route('reports.rating', $report) }}" method="POST" class="bg-white p-5 rounded-xl border border-blue-100 shadow-sm">
                                        @csrf
                                        
                                        {{-- Success/Error Messages --}}
                                        @if(session('success'))
                                            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-4">
                                                {{ session('success') }}
                                            </div>
                                        @endif
                                        
                                        @if(session('error'))
                                            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-4">
                                                {{ session('error') }}
                                            </div>
                                        @endif

                                        {{-- Rating Stars --}}
                                        <div class="mb-4">
                                            <label class="block text-sm font-bold text-gray-700 mb-2">Rating <span class="text-red-500">*</span></label>
                                            <div class="flex items-center gap-2" id="ratingContainer">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <button type="button" 
                                                            class="star-btn w-10 h-10 text-3xl transition-all hover:scale-110 focus:outline-none" 
                                                            data-rating="{{ $i }}">
                                                        <svg class="w-full h-full text-gray-300 fill-current" viewBox="0 0 20 20">
                                                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                                        </svg>
                                                    </button>
                                                @endfor
                                            </div>
                                            <input type="hidden" name="rating" id="ratingInput" value="" required>
                                            @error('rating')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        {{-- Comment --}}
                                        <div class="mb-4">
                                            <label for="comment" class="block text-sm font-bold text-gray-700 mb-2">Komentar / Feedback (Opsional)</label>
                                            <textarea name="comment" 
                                                    id="comment" 
                                                    rows="4" 
                                                    class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"
                                                    placeholder="Bagikan pengalaman atau masukan Anda...">{{ old('comment') }}</textarea>
                                            @error('comment')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        {{-- Submit Button --}}
                                        <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 px-4 rounded-xl hover:bg-blue-700 transition shadow-lg shadow-blue-200">
                                            Kirim Rating & Feedback
                                        </button>
                                    </form>
                                </div>
                            @endif
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

    @push('scripts')
    <script>
        // Interactive Star Rating
        document.addEventListener('DOMContentLoaded', function() {
            const starButtons = document.querySelectorAll('.star-btn');
            const ratingInput = document.getElementById('ratingInput');
            let selectedRating = 0;

            starButtons.forEach((btn, index) => {
                const rating = index + 1;
                
                btn.addEventListener('click', function() {
                    selectedRating = rating;
                    ratingInput.value = rating;
                    updateStars(rating);
                });

                btn.addEventListener('mouseenter', function() {
                    if (selectedRating === 0) {
                        updateStars(rating);
                    }
                });
            });

            const container = document.getElementById('ratingContainer');
            if (container) {
                container.addEventListener('mouseleave', function() {
                    updateStars(selectedRating);
                });
            }

            function updateStars(rating) {
                starButtons.forEach((btn, index) => {
                    const starSvg = btn.querySelector('svg');
                    if (index < rating) {
                        starSvg.classList.remove('text-gray-300');
                        starSvg.classList.add('text-yellow-400');
                    } else {
                        starSvg.classList.remove('text-yellow-400');
                        starSvg.classList.add('text-gray-300');
                    }
                });
            }
        });
    </script>
    @endpush
</x-app-layout>