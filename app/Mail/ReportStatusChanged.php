<?php

namespace App\Mail;

use App\Models\Report;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReportStatusChanged extends Mailable
{
    use Queueable, SerializesModels;

    public $report;

    // Terima data laporan dari Controller
    public function __construct(Report $report)
    {
        $this->report = $report;
    }

    public function build()
    {
        // Tentukan Subject Email sesuai status
        $statusLabel = ucfirst($this->report->status);
        
        return $this->subject("Update Status Laporan #{$this->report->ticket_number}: {$statusLabel}")
                    ->view('emails.report_status'); // Nama file view kita nanti
    }
}