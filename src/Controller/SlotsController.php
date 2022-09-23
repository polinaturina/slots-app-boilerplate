<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Slot;
use App\Service\SlotsSorter;
use App\Service\SlotsSortLocator;
use App\Service\SortTypeNotFoundException;
use App\ValueObject\SlotsCollection;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class SlotsController extends AbstractController
{
    // TODO: Replace with ParamConverter. Stuck with error message
    // https://symfony.com/bundles/SensioFrameworkExtraBundle/current/annotations/converters.html
    // @ParamConverter("listSlotsRequest", options={"mapping": {"sortType": "sortType"}})
    // Cannot autowire argument $listSlotsRequest of "App\Controller\SlotsController::list()": it references class "App\ValueObject\ListSlotsRequest" but no such service exists.

    private SlotsSortLocator $locator;
    private SlotsCollection $slotsCollection;

    public function __construct()
    {
        $this->locator = new SlotsSortLocator();
        $this->slotsCollection = new SlotsCollection();
    }

    /**
     * @Route("/slots/sortType/{sortType}", name="slots")
     */
    public function list(ManagerRegistry $doctrine, string $sortType): Response
    {
        if (!$this->isSortType($sortType)) {
            throw new SortTypeNotFoundException(
                sprintf('Sort type "%s" is not valid, supported: %s', $sortType, implode(', ', SlotsSorter::SORT_TYPES))
            );
        }

        $slots = $doctrine->getRepository(Slot::class)->findAll();

        $sortService = $this->locator->locate($sortType);
        $sortService->sort($this->getSlotsCollection($slots));

        return new Response(sprintf('Successfully sorted using "%s" sort type', $sortType));
    }

    /**
     * @param Slot[] $slots
     */
    private function getSlotsCollection(array $slots): SlotsCollection
    {
        foreach ($slots as $slot) {
            $this->slotsCollection->addSlot($slot);
        }

        return $this->slotsCollection;
    }

    private function isSortType(string $sortType): bool
    {
        return array_key_exists($sortType, SlotsSorter::SORT_TYPES);
    }
}
