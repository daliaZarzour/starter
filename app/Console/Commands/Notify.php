<?php

namespace App\Console\Commands;

use APP\Mail\NotifyEmail;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;


class Notify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send notify by email';

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
     * @return int
     */
    public function handle()
    {
        //$user=User::select('email')->get();
        $emails=User::pluck('email')->toArray();
        $data=['title'=>'programing','body'=>'php'];
        foreach($emails as $email){
          //  Mail::to($email)->send(new NotifyEmail($data));
              Mail::To($email)->send(new NotifyEmail($data));

        }
    }
}
