<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Models\InviteFriend;
use App\Models\Auth\User;

class CheckStatusInviteFriend extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check-status-invite-friend';

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
        Log::info("Start Update Status Invite Friend");
        
        $inviteFriends = InviteFriend::all();
        $now = strtotime(Carbon::now());

        foreach($inviteFriends as $inviteFriend){
            $dayInvite = strtotime($inviteFriend->date_invite);
            $emailInvited = $inviteFriend->email;
            $deltaTime = round(($now - $dayInvite)/86400);

            if($deltaTime > 10){
                $user = User::where('email', $emailInvited)->first();
                if(!isset($user)){
                    $inviteFriend->status_invitation = 'notAccept';
                    $inviteFriend->save();
                }
            }else{
                $user = User::where('email', $emailInvited)->first();
                if(!isset($user)){
                    $inviteFriend->status_invitation = 'pending';
                    $inviteFriend->save();
                }else{
                    $inviteFriend->status_invitation = 'accept';
                    $inviteFriend->save();
                }
            }
        }


        Log::info("End Update Status Invite Friend");
    }
}
