<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DestroyTaskMail extends Mailable
{
    use Queueable, SerializesModels;

    public $task;
    public $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($task)
    {
        $this->task = $task->task;
        $this->url = route('task.index');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.destroy-task')->subject('Tarefa Excluída');
    }
}
