<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;
use DB;
use App\User;
use App\Catalogue;
use Carbon\Carbon;
class SendCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send email for every user';

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
        $yesterday  = Carbon::yesterday();
        $now        = Carbon::now();
        $users      = User::all();

        foreach($users as $user){

            $favorites = DB::table('favorites')->where('user_id', $user->id)->whereBetween('created_at', [$yesterday, $now])->exists();

            if($favorites){

                $catalogues = $user->favorite(Catalogue::class);
                        Mail::send('emails.allFavorite', [ 
                                                            'user'          => $user, 
                                                            'catalogues'  => $catalogues
                                                        ], function ($m) use ($user)  {
                                                        
                        $m->from('github@nextmedia.ma', 'Next Media');
                        $m->to($user->email, $user->nom)->subject('All favorite');

                                                                                                });

            }
        }

        $this->info('Send email successfully!');
    }
}
