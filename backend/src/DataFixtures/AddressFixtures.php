<?php

namespace App\DataFixtures;

use App\Project\Context\CommonInterfaces\Entity\ClientEntityInterface;
use App\Project\Context\DeliveryModule\Address\Entity\AddressEntity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class AddressFixtures extends Fixture implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        /** @var ClientEntityInterface $client */
        $client = $this->getReference(ClientFixtures::REFERENCE_CLIENT_NAME);

        $this->createAddress($manager, $client, $faker, true);
        $this->createAddress($manager, $client, $faker, false);
        $this->createAddress($manager, $client, $faker, false);

        $manager->flush();
    }

    /**
     * @inheritDoc
     */
    public function getOrder(): int
    {
        return 2;
    }

    /**
     * @param ObjectManager $manager
     * @param ClientEntityInterface $client
     * @param Generator $faker
     * @param bool $isDefault
     */
    private function createAddress(
        ObjectManager $manager,
        ClientEntityInterface $client,
        Generator $faker,
        bool $isDefault
    ): void {
        $manager->persist((new AddressEntity())
            ->setClient($client)
            ->setZipCode($faker->postcode)
            ->setCountry($faker->country)
            ->setCity($faker->city)
            ->setStreet($faker->streetName)
            ->setIsDefault($isDefault));
    }
}
