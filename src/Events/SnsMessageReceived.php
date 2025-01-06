<?php

declare(strict_types=1);

namespace Modules\Sns\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SnsMessageReceived
{
    use Dispatchable, SerializesModels;

    public $snsMessage;

    /**
     * Create a new event instance.
     *
     * @param array $snsMessage
     */
    public function __construct(array $snsMessage)
    {
        $this->snsMessage = $snsMessage;
    }
}
