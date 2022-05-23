<?php

declare(strict_types=1);

namespace App\Command;

use App\Controller\DoctorController;
use App\Entity\Doctor;
use App\Factory;
use App\Http\DoctorCollectionMapper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateDoctorCommand extends Command
{
    protected static $defaultName = 'app:create-doctor';

    // Expose the EntityManager in the class level
    private EntityManagerInterface $entityManager;

    private Factory $factory;

    public function __construct(EntityManagerInterface $entityManager)
    {
        // Update the value of the private entityManager variable through injection
        $this->entityManager = $entityManager;
        $this->factory = new Factory();

        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $elements = ($this->factory->createSupplierClient())->getDoctorArray();
        $doctorCollectionItems = (new DoctorCollectionMapper())->map($elements);

        $repository = $this->entityManager->getRepository(Doctor::class);

        /** @var Doctor $doctorItem */
        foreach ($doctorCollectionItems->getElements() as $doctorItem) {
            if ($this->isValid($repository->findOneBy(array('name' => $doctorItem->getName())))) {
                $output->writeln(sprintf('Doctor %s already exists in the "doctor" table!', $doctorItem->getName()));
                continue;
            }

            $this->entityManager->persist($doctorItem);
            $this->entityManager->flush();

            $output->writeln(sprintf('Doctor %s successfully inserted into the "doctor" table!', $doctorItem->getName()));
        }

        return Command::SUCCESS;
    }

    private function isValid($entry): bool
    {
        return $entry !== null;
    }
}
