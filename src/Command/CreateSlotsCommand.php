<?php

declare(strict_types=1);

namespace App\Command;

use App\Factory;
use App\Repository\DoctorRepository;
use App\Repository\SlotRepository;
use App\ValueObject\SlotsCollectionMapper;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateSlotsCommand extends Command
{
    protected static $defaultName = 'app:pull-doctor-slots';

    private Factory $factory;

    public function __construct(private ManagerRegistry $doctrin)
    {
        $this->factory = new Factory();

        parent::__construct();
    }

    // TODO: Can be executed only once - no protection from double entries
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $doctorRepository = new DoctorRepository($this->doctrin);
        $doctors = $doctorRepository->findAll();

        $client = $this->factory->createSupplierClient();
        $slotRepository = new SlotRepository($this->doctrin);
        $slotsMapper = new SlotsCollectionMapper();

        foreach ($doctors as $doctor) {

            // TODO: Broken API: 500 Internal Server Error on api/doctors/7, 13, 17, 23/slots
            if ($doctor->getId() === 7 || $doctor->getId() === 13 || $doctor->getId() === 17 || $doctor->getId() === 23) {
                continue;
            }

            $elements = $client->getAvailableSlotByDoctorId($doctor);
            $availableSlots = $slotsMapper->map($elements, $doctor);

            foreach ($availableSlots->getSlots() as $slot) {
                $slotRepository->add($slot, true);
                $output->writeln(sprintf('Slots for doctor %s successfully inserted into the "slot" table!', $doctor->getName()));
            }
        }

        return Command::SUCCESS;
    }
}
