<?php

declare(strict_types=1);

namespace App\Command;

use App\Entity\Doctor;
use App\Factory;
use App\Http\DoctorCollectionMapper;
use App\Repository\DoctorRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateDoctorCommand extends Command
{
    protected static $defaultName = 'app:create-doctor';
    private Factory $factory;

    public function __construct(private ManagerRegistry $doctrin)
    {
        $this->factory = new Factory();

        parent::__construct();
    }

    // TODO: Bug with id = 0
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $elements = ($this->factory->createSupplierClient())->getDoctorArray();
        $doctorCollectionItems = (new DoctorCollectionMapper())->map($elements);

        $repository = new DoctorRepository($this->doctrin);

        /** @var Doctor $doctorItem */
        foreach ($doctorCollectionItems->getElements() as $doctorItem) {
            if ($repository->findOneByID($doctorItem->getId()) !== null) {
                $output->writeln(sprintf('Doctor %s already exists in the "doctor" table!', $doctorItem->getName()));
                continue;
            }

            $repository->add($doctorItem, true);

            $output->writeln(sprintf('Doctor %s successfully inserted into the "doctor" table!', $doctorItem->getName()));
        }

        return Command::SUCCESS;
    }
}
