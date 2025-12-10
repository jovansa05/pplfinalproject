<x-app-layout>
    <div class="min-h-screen bg-cover bg-center relative bg-fixed" 
         style="background-image: url('{{ asset('images/hero-bg.jpg') }}');">
        
        <div class="absolute inset-0 bg-white/90 z-0"></div>

        <div class="py-12 relative z-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                
                <div class="mb-8 text-center">
                    <h2 class="text-3xl font-extrabold text-green-800 tracking-tight">
                        Buat Laporan Baru 📢
                    </h2>
                    <p class="text-gray-500 mt-2">Sampaikan keluhanmu secara detail agar segera ditindaklanjuti.</p>
                </div>

                <form action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="latitude" id="latitude">
                    <input type="hidden" name="longitude" id="longitude">

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        
                        <div class="lg:col-span-2 space-y-8">
                            
                            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 hover:shadow-xl transition duration-300">
                                <div class="flex items-center gap-3 mb-4">
                                    <div class="w-10 h-10 bg-green-100 text-green-600 rounded-full flex items-center justify-center font-bold">1</div>
                                    <h3 class="text-xl font-bold text-gray-800">Pilih Kategori</h3>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
                                    <select id="category_id" name="category_id" class="block w-full border-none bg-transparent text-gray-900 focus:ring-0 text-lg font-medium cursor-pointer" required>
                                        <option value="">-- Apa masalah yang kamu temukan? --</option>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 hover:shadow-xl transition duration-300">
                                <div class="flex items-center gap-3 mb-4">
                                    <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center font-bold">2</div>
                                    <h3 class="text-xl font-bold text-gray-800">Lokasi Kejadian</h3>
                                </div>
                                
                                <button type="button" onclick="getLocation()" class="mb-4 flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-bold shadow-md w-fit text-sm">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    Ambil Lokasi Saya (GPS)
                                </button>
                                <p id="gps-status" class="text-xs text-gray-500 italic mb-2"></p>

                                <div id="map-preview" class="hidden h-64 rounded-xl overflow-hidden border-2 border-blue-100 mb-4 shadow-inner"></div>

                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-400">📍</span>
                                    </div>
                                    <input id="location" class="block w-full pl-10 border-gray-300 bg-gray-50 text-gray-900 rounded-lg focus:border-blue-500 focus:ring-blue-500 py-3" 
                                        type="text" name="location" required placeholder="Nama jalan, gedung, atau patokan..." />
                                </div>
                            </div>

                            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 hover:shadow-xl transition duration-300">
                                <div class="flex items-center gap-3 mb-4">
                                    <div class="w-10 h-10 bg-yellow-100 text-yellow-600 rounded-full flex items-center justify-center font-bold">3</div>
                                    <h3 class="text-xl font-bold text-gray-800">Ceritakan Detailnya</h3>
                                </div>
                                <textarea id="description" name="description" rows="5" 
                                    class="block w-full border-gray-300 bg-gray-50 text-gray-900 rounded-xl focus:border-yellow-500 focus:ring-yellow-500 py-3 px-4 shadow-inner" 
                                    required placeholder="Contoh: Ada tumpukan sampah di depan warung bu ijah yang baunya sangat menyengat..."></textarea>
                            </div>

                        </div>

                        <div class="lg:col-span-1">
                            <div class="sticky top-24 space-y-8">
                                
                                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 hover:shadow-xl transition duration-300">
                                    <div class="flex items-center gap-3 mb-4">
                                        <div class="w-10 h-10 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center font-bold">4</div>
                                        <h3 class="text-xl font-bold text-gray-800">Bukti Foto</h3>
                                    </div>
                                    
                                    <div class="mb-4 hidden rounded-xl overflow-hidden border-2 border-green-500 shadow-lg relative group" id="image-preview-container">
                                        <img id="image-preview" src="#" alt="Preview" class="w-full h-48 object-cover">
                                        <div class="absolute inset-0 bg-black/50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                                            <span class="text-white font-bold text-sm">Ganti Foto</span>
                                        </div>
                                    </div>

                                    <label for="image" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-xl cursor-pointer bg-gray-50 hover:bg-green-50 hover:border-green-400 transition group">
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <svg class="w-8 h-8 mb-2 text-gray-400 group-hover:text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            <p class="text-xs text-gray-500">Upload JPG/PNG (Max 5MB)</p>
                                        </div>
                                        <input id="image" name="image" type="file" accept="image/*" class="hidden" onchange="previewImage()" required />
                                    </label>
                                </div>

                                <button type="submit" class="w-full py-4 bg-green-600 text-white font-extrabold text-lg rounded-2xl shadow-xl hover:bg-green-700 hover:shadow-green-500/40 transition transform hover:-translate-y-1 flex justify-center items-center gap-2">
                                    <span>Kirim Laporan</span>
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path></svg>
                                </button>
                                
                                <p class="text-center text-gray-400 text-xs mt-4">Pastikan data yang Anda kirimkan benar dan dapat dipertanggungjawabkan.</p>

                            </div>
                        </div>

                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        function previewImage() {
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('#image-preview');
            const previewContainer = document.querySelector('#image-preview-container');

            if(image.files && image.files[0]){
                const oFReader = new FileReader();
                oFReader.readAsDataURL(image.files[0]);
                oFReader.onload = function(oFREvent) {
                    imgPreview.src = oFREvent.target.result;
                    previewContainer.classList.remove('hidden');
                }
            }
        }

        function getLocation() {
            const status = document.getElementById('gps-status');
            if (navigator.geolocation) {
                status.innerHTML = "⏳ Sedang mencari lokasi...";
                navigator.geolocation.getCurrentPosition(showPosition, showError);
            } else {
                status.innerHTML = "❌ Browser tidak support GPS.";
            }
        }

        function showPosition(position) {
            const lat = position.coords.latitude;
            const long = position.coords.longitude;
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = long;
            
            document.getElementById('gps-status').innerHTML = `✅ Akurasi GPS: ${lat.toFixed(4)}, ${long.toFixed(4)}`;
            document.getElementById('gps-status').className = "text-xs text-green-600 italic mb-2 font-bold";

            const locationInput = document.getElementById('location');
            if(locationInput.value === "") {
                locationInput.value = `Koordinat: ${lat.toFixed(5)}, ${long.toFixed(5)}`;
            }

            const mapContainer = document.getElementById('map-preview');
            // Maps Embed (Fix HTTPS)
            mapContainer.innerHTML = `<iframe width="100%" height="100%" frameborder="0" scrolling="no" src="https://maps.google.com/maps?q=${lat},${long}&z=15&output=embed"></iframe>`;
            mapContainer.classList.remove('hidden');
        }

        function showError(error) {
            document.getElementById('gps-status').innerHTML = "❌ Gagal mengambil lokasi.";
        }
    </script>
</x-app-layout>