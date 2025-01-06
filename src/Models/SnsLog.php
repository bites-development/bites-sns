<?php

declare(strict_types=1);

namespace Modules\Sns\Models;

use Modules\Sns\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Modules\Sns\Database\factories\SnsFactory;

class SnsLog extends Model
{
    use UuidTrait;


    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'message',
        'message_identifier',
        'message_type',
    ];

    protected $casts = [
        'id' => 'string',
    ];

    protected static function newFactory(): SnsFactory
    {
        return SnsFactory::new();
    }
}
