<?php

namespace App\Console\Commands;

use App\Notifications\NewsletterNotification;
use App\User;
use Illuminate\Console\Command;

class SendNewsLetterCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:newsletter 
    {emails?*}: Correos Electronicos a los cuales enviar directamente
    {--s|schedule : Si debe ser ejecutado directamente o no}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an email';
    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $emails = $this->argument('emails');
        $schedule = $this->option('schedule');

        $builder = User::query();
        
        if ($emails)
        {
            $builder->whereIn('email',$emails);
        }
        $count = $builder->count();

        if ($count)
        {
            $this->output->progressStart($count);
            $builder->whereNotNull('email_verified_at')
                ->each(function (User $user)
                {
                    $user->notify(new NewsletterNotification());
                    $this->output->progressAdvance();
                });
            $this->output->progressFinish();
            $this->info("Se enviaron {$count} correos");
        }
        else
        {
            $this->info('No se envio ningun correo');
        }
    }
}
