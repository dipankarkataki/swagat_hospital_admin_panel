<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Models\AppointmentBooking;

class RemoveExpiredOpdBooking extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'removeExpiredOpdBooking:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will remove all expired offline opd bookings.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        info("Cron Job running at " . now());

        AppointmentBooking::whereDate('appointment_date', '<', today())
        ->update([
            'status' => 0
        ]);
    }
}
