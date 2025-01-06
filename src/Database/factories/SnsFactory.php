<?php

declare(strict_types=1);

namespace Modules\Sns\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Sns\Models\SnsLog;

/** @extends Factory<SnsLog> */
class SnsFactory extends Factory
{
    protected $model = SnsLog::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}
