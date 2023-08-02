<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UpTaskMail extends Mailable
{
    use Queueable, SerializesModels;

    public $task;
    public $previousTask;

    public $deadline_date;
    public $previousDeadline_date;
    public $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($previousTask, $task)
    {
        $this->task = $task->task;
        $this->previousTask = $previousTask['task'];

        $this->deadline_date = date('d/m/Y', strtotime($task->deadline_date));
        $this->previousDeadline_date = date('d/m/Y', strtotime($previousTask['deadline_date']));

        $this->url = route('task.show', $task->id);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.up-task')->subject('Tarefa Alterada');
    }
}
