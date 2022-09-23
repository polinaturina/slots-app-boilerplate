<?php

declare(strict_types=1);

namespace App\Http;

use App\Entity\Doctor;
use App\Entity\DoctorCollection;

// Todo: move to another folder
class DoctorCollectionMapper
{
    private const COLUMN_NAME_IN_DOCTOR_TABLE = 'name';
    private const COLUMN_ID_IN_DOCTOR_TABLE = 'id';

    public function map(array $elements): DoctorCollection
    {
        $doctorCollection = new DoctorCollection();

        foreach ($elements as $element) {
            $doctor = new Doctor();
            $doctor->setId($element[self::COLUMN_ID_IN_DOCTOR_TABLE]);
            $doctor->setName($element[self::COLUMN_NAME_IN_DOCTOR_TABLE]);
            $doctorCollection->addElement($doctor);
        }

        return $doctorCollection;
    }
}
