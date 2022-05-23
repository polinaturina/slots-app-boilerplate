<?php

declare(strict_types=1);

namespace App\Entity;

// TODO: move to ValueObject folder
class DoctorCollection
{
    /**
     * @var Doctor
     */
    private $doctors = [];

    public function addElement(Doctor $doctor): void
    {
        $this->doctors[] = $doctor;
    }

    public function getElements(): array
    {
        return $this->doctors;
    }
}
