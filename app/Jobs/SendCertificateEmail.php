<?php

namespace App\Jobs;

use App\User;

use App\Jobs\Job;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendCertificateEmail extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $user, $attachment;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, $filename)
    {
        $this->user = $user;
        $this->attachment = $filename;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer)
    {
        //dd($this->user);

        $mailer->send('emails.certificate', ['user' => $this->user], function ($m) {
            $m->to( $this->user->email, 'Floorco User' );
            $m->from( 'admin@floorcoexpress.com', 'Floorco Admin' );
            $m->subject( 'Your Surgication Certificate!' );
            $m->attach($this->attachment);
        });

    }
}
