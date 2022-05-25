<?php

namespace App\Tests\Entity;

use App\Entity\Doctor;
use App\Entity\DoctorCollection;
use PHPUnit\Framework\TestCase;

class DoctorCollectionTest extends TestCase
{

    public function testAddElement(): void
    {
        $collection = new DoctorCollection();
        $collection->addElement(new Doctor());

        $this->assertCount(1, $collection->getElements());
    }

    public function testGetElements(): void
    {
        $collection = new DoctorCollection();
        $doctor1 = new Doctor();
        $doctor2 = new Doctor();
        $collection->addElement($doctor1);
        $collection->addElement($doctor2);

        $this->assertCount(2, $collection->getElements());
    }
}
