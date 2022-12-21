<?php

namespace App\Console\Commands;

use App\Models\Auth\User;
use App\Models\TravelReports\TravelReports;
use Illuminate\Console\Command;

class AddRoleTypeToTravelReportsTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add-role-type-to-travel-reports-table';

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
            $user_id = data_get($travel_report, 'user_id');
            $user = User::where('id', '=', $user_id)->first();
            if(isset($user) && !empty($user)){
                $role_type = data_get($user, 'role_type');
                $travel_report->role_type = $role_type;
                $travel_report->save();
            }else{
                $travel_report->role_type = null;
                $travel_report->save();
            }
            
        }

        return 0;
    }
}
