<?php

namespace App\DataFixtures;

use App\Entity\Car;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $items = [
            [
                'vin' => 'JHMWD5523DS022721',
                'make' => 'Porsche',
                'model' => 'Cayenne',
                'yearOfProduction' => 2023,
            ],
            [
                'vin' => 'JT2SV12E8G0417278',
                'make' => 'Audi',
                'model' => 'S5',
                'color' => 'black',
            ],
            [
                'vin' => '2C4GM68475R667819',
                'make' => 'Fiat',
                'model' => 'Tipo',
            ],
            [
                'vin' => '1B3HB48B67D562726',
                'make' => 'Nissan',
                'model' => 'Qashqai',
            ],
            [
                'vin' => 'JNKCV51E03M018631',
                'make' => 'Seat',
                'model' => 'Leon',
                'color' => 'white',
                'yearOfProduction' => 2020,
            ],
            [
                'vin' => '2HGES15252H603204',
                'make' => 'Mazda',
                'model' => '6',
            ],
            [
                'vin' => 'WAUAC48H55K008231',
                'make' => 'Ford',
                'model' => 'Mondeo',
            ],
            [
                'vin' => 'JH4KA8150MC012098',
                'make' => 'Kia',
                'model' => 'Sportage',
                'yearOfProduction' => 2015,
            ],
        ];

        foreach ($items as $item) {
            $car = new Car($item['vin'], $item['make'], $item['model']);
            if (isset($item['color'])) {
                $car->setColor($item['color']);
            }
            if (isset($item['yearOfProduction'])) {
                $car->setYearOfProduction($item['yearOfProduction']);
            }
            $manager->persist($car);
        }

        $manager->flush();
    }
}
