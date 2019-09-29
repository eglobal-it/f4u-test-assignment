<?php

namespace App\DataFixtures;

use App\Project\Context\UserModule\Client\Entity\ClientEntity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class ClientFixtures extends Fixture implements OrderedFixtureInterface
{
    /**
     * @var string
     */
    public const REFERENCE_CLIENT_NAME = 'client';

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        $client = (new ClientEntity())
            ->setFirstName($faker->firstName)
            ->setLastName($faker->lastName);

        $manager->persist($client);

        for ($i = 0; $i <= 10; $i++) {
            $newClient = (new ClientEntity())
                ->setFirstName($faker->firstName)
                ->setLastName($faker->lastName);

            $manager->persist($newClient);
        }

        $manager->flush();
        $this->addReference(self::REFERENCE_CLIENT_NAME, $client);
    }

    /**
     * @inheritDoc
     */
    public function getOrder(): int
    {
        return 1;
    }
}
