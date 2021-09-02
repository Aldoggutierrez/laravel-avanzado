<?php

namespace App\Console\Commands;

use App\Notifications\VerifyEmailAddress;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendReminderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an email to the no verified users that create their account on the las week';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $query = User::query()->whereDate('created_at','=',Carbon::now()->subDays(7))
            ->whereNull('email_verified_at');
        $count = $query->count();
        if ($count)
        {
            $this->output->progressStart($count);

            $query->each(function (User $user)
                {
                    $user->notify(new VerifyEmailAddress());
                    $this->output->progressAdvance();
                });
            $this->output->progressFinish();
            $this->info("Se enviaron {$count} correos");
        }
        else
        {
            $this->info('No se envió ningún correo');
        }
    }
}
