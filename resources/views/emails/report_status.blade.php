<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f3f4f6; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .header { background-color: #047857; padding: 20px; text-align: center; color: white; }
        .content { padding: 30px; color: #374151; line-height: 1.6; }
        .status-box { text-align: center; margin: 20px 0; padding: 15px; border-radius: 8px; font-weight: bold; font-size: 18px; }
        .status-selesai { background-color: #d1fae5; color: #065f46; border: 1px solid #34d399; }
        .status-ditolak { background-color: #fee2e2; color: #991b1b; border: 1px solid #f87171; }
        .status-proses { background-color: #dbeafe; color: #1e40af; border: 1px solid #60a5fa; }
        .btn { display: inline-block; background-color: #047857; color: #ffffff; padding: 12px 24px; text-decoration: none; border-radius: 6px; font-weight: bold; margin-top: 20px; }
        .footer { background-color: #f9fafb; padding: 15px; text-align: center; font-size: 12px; color: #9ca3af; }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <h1>KotaKita Surabaya</h1>
        </div>

        <div class="content">
            <p>Halo, <strong>{{ $report->user->name }}</strong>! 👋</p>
            
            <p>Kami ingin memberitahukan update terbaru mengenai laporan Anda dengan nomor tiket: <strong>#{{ $report->ticket_number }}</strong>.</p>

            <div class="status-box status-{{ $report->status }}">
                Status Laporan: {{ strtoupper($report->status) }}
            </div>

            <p>
                @if($report->status == 'selesai')
                    Terima kasih telah berkontribusi! Laporan Anda telah ditindaklanjuti dan diselesaikan oleh petugas kami. ✅
                @elseif($report->status == 'ditolak')
                    Mohon maaf, laporan Anda tidak dapat kami lanjutkan. Hal ini mungkin karena data kurang jelas atau lokasi tidak ditemukan. 🙏
                @elseif($report->status == 'proses')
                    Laporan Anda sedang dalam penanganan petugas dinas terkait. Mohon tunggu update selanjutnya. ⚙️
                @endif
            </p>

            <div style="text-align: center;">
                <a href="{{ route('reports.index') }}" style="background-color: #4CAF50; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block;">
                    Lihat Riwayat Laporan
                </a>
            </div>
        </div>

        <div class="footer">
            &copy; {{ date('Y') }} KotaKita Surabaya.<br>
            Jangan balas email ini (Auto-generated).
        </div>
    </div>

</body>
</html>