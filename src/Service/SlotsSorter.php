<?php

declare(strict_types=1);

namespace App\Service;

use App\ValueObject\SlotsCollection;

interface SlotsSorter
{
    public const SORT_TYPES = [
        self::DURATION_SORT_TYPE => self::DURATION_SORT_TYPE
    ];

    public const DURATION_SORT_TYPE = 'duration';

    public function sort(SlotsCollection $slotsCollection): SlotsCollection;
}
