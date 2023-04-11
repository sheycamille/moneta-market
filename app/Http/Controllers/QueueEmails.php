<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Jobs\ProcessEmails;

class QueueEmails extends Controller
{
    public function dispatchEmail()
    {
        $emailJobs = new ProcessEmails();

        $this->dispatch($emailJobs);
    }
}
