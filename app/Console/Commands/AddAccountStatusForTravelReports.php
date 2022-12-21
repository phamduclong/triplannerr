<?php

namespace App\Console\Commands;
use App\Models\TravelReports\TravelReports;

use Illuminate\Console\Command;

class AddAccountStatusForTravelReports extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add-account-status-for-travel-reports';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $travel_reports = TravelReports::all();
        foreach($travel_reports as $travel_report){
            $travel_report->account_status = 'normally';
            $travel_report->save();
        }

        return 0;
    }
}
