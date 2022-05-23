<?php

declare(strict_types=1);

namespace App\Entity;

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
