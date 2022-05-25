<?php

declare(strict_types=1);

namespace App\Service;

class SlotsSortLocator
{
    public function locate(string $sortType): SlotsSorter
    {
        switch ($sortType) {
            case SlotsSorter::DURATION_SORT_TYPE:
                return new SortBySlotDuration();
            default:
                throw new SortTypeNotSupportedException(sprintf('Sort algorithm %s is not supported', $sortType));
        }
    }
}
