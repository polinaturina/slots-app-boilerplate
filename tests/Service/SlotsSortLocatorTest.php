<?php

namespace App\Tests\Service;

use App\Service\SlotsSortLocator;
use App\Service\SortBySlotDuration;
use App\Service\SortTypeNotSupportedException;
use PHPUnit\Framework\TestCase;

/** @covers \App\Service\SlotsSortLocator */
class SlotsSortLocatorTest extends TestCase
{
    private SlotsSortLocator $locator;

    protected function setUp(): void
    {
        $this->locator = new SlotsSortLocator();
    }

    public function testLocate(): void
    {
        $this->assertInstanceOf(SortBySlotDuration::class, $this->locator->locate('duration'));
    }

    public function testThrowsSortTypeNotSupportedException(): void
    {
        $this->expectException(SortTypeNotSupportedException::class);
        $this->expectExceptionMessage('Sort algorithm bubble is not supported');

        $this->locator->locate('bubble');
    }
}
