<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Slot;
use App\ValueObject\SlotsCollection;

class SortBySlotDuration implements SlotsSorter
{
    // TODO: Does not work correct, needed to be fixed
    public function sort(SlotsCollection $slotsCollection): SlotsCollection
    {
        $slots = $slotsCollection->getSlots();
        $slotsArray = &$slots;

        usort(
            $slotsArray,
            function (Slot $firstSlotToCompare, Slot $nextSlotToCompare) {
                $firsSlotTimeDuration = ($firstSlotToCompare->getDateTo()->getTimestamp()) - ($firstSlotToCompare->getDateFrom()->getTimestamp());
                $nextSlotTimeDuration = ($nextSlotToCompare->getDateTo()->getTimestamp()) - ($nextSlotToCompare->getDateFrom()->getTimestamp());
                return $firsSlotTimeDuration < $nextSlotTimeDuration ? -1 : 1;
            }
        );

        return $slotsCollection;
    }
}
