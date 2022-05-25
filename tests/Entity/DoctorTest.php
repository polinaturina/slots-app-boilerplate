<?php

namespace App\Tests\Entity;

use App\Entity\Doctor;
use PHPUnit\Framework\TestCase;

/** @covers \App\Entity\Doctor */
class DoctorTest extends TestCase
{
    private Doctor $doctor;

    protected function setUp(): void
    {
        $this->doctor = new Doctor();
    }

    public function testGetId(): void
    {
        $this->doctor->setId(42);
        $this->assertSame(42, $this->doctor->getId());

    }

    public function testGetName(): void
    {
        $this->doctor->setName('test');
        $this->assertSame('test', $this->doctor->getName());
    }
}
