<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TaskCreated extends Mailable
{
    use Queueable, SerializesModels;


    public $task;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($task)
    {
        $this->task = $task;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user = $this->task->user;

        if (!$user) {

            throw new \Exception('No user associated with this task.');
        }

        return $this->subject('Nueva Tarea Creada')
            ->from('from@example.com')
            ->to($user->email)
            ->view('emails.task_created')
            ->with(['task' => $this->task]);
    }
}
