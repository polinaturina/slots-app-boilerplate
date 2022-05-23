<?php

declare(strict_types=1);

namespace App\ValueObject;

use App\Entity\Doctor;
use App\Entity\Slot;
use DateTime;

class SlotsCollectionMapper
{
    private const COLUMN_DATE_FROM = 'start';
    private const COLUMN_DATE_TO = 'end';

    public function map(array $elements, Doctor $doctor): SlotsCollection
    {
        $slotsCollection = new SlotsCollection();

        foreach ($elements as $element) {
            $slot = new Slot();
            $slot->setDateFrom(new DateTime($element[self::COLUMN_DATE_FROM]));
            $slot->setDateTo(new DateTime($element[self::COLUMN_DATE_TO]));
            $slot->setDoctorId($doctor->getId());
            $slotsCollection->addSlot($slot);
        }

        return $slotsCollection;
    }
}
