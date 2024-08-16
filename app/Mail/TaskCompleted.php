<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Task;

class TaskCompleted extends Mailable
{
    use Queueable, SerializesModels;


    protected $task;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Task $task)
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
        return $this->subject('Tarea Completada')
                    ->from('from@example.com')
                    ->to($this->task->user->email)
                    ->view('emails.task_completed')
                    ->with([
                        'taskTitle' => $this->task->title,
                        'taskDescription' => $this->task->description,
                        'completionDate' => $this->task->updated_at->format('d/m/Y'),
                    ]);
    }
}
