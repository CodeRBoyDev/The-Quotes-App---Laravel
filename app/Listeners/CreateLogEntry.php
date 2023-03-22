<?php

namespace App\Listeners;

use App\Models\QuoteLog;
use App\Events\QuoteCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateLogEntry
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  QuoteCreated  $event
     * @return void
     */
    public function handle(QuoteCreated $event)
    {
        dd($author = $event->author_name);
        $log_entry = new QuoteLog();
        $log_entry->author = $author;
        dd($log_entry);
        $log_entry->save();
    }
}
