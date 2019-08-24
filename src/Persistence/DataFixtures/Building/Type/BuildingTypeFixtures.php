<?php

declare(strict_types=1);

/*
 * This file is part of «Epigraphy of Medieval Rus'» database.
 *
 * Copyright (c) National Research University Higher School of Economics
 *
 * «Epigraphy of Medieval Rus'» database is free software:
 * you can redistribute it and/or modify it under the terms of the
 * GNU General Public License as published by the Free Software Foundation, version 3.
 *
 * «Epigraphy of Medieval Rus'» database is distributed
 * in the hope  that it will be useful, but WITHOUT ANY WARRANTY; without even
 * the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU General Public License for more details.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code. If you have not received
 * a copy of the GNU General Public License along with
 * «Epigraphy of Medieval Rus'» database,
 * see <http://www.gnu.org/licenses/>.
 */

namespace App\Persistence\DataFixtures\Building\Type;

use App\Persistence\Entity\Building\Type\BuildingType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * @author Anton Dyshkant <vyshkant@gmail.com>
 */
final class BuildingTypeFixtures extends Fixture
{
    public const REFERENCE_TSERKOV = self::class.'церковь';

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        $this->loadObject($manager, 'церковь', self::REFERENCE_TSERKOV);

        $manager->flush();
    }

    /**
     * @param ObjectManager $manager
     * @param string        $name
     * @param string        $reference
     */
    private function loadObject(ObjectManager $manager, string $name, string $reference): void
    {
        $buildingType = (new BuildingType())
            ->setName($name)
        ;

        $this->addReference($reference, $buildingType);

        $manager->persist($buildingType);
    }
}
