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

namespace App\Persistence\Repository;

use App\Persistence\Entity\NamedEntityInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\ORMException;

/**
 * @author Anton Dyshkant <vyshkant@gmail.com>
 */
abstract class NamedEntityRepository extends ServiceEntityRepository
{
    public function findOneByName(string $name): ?NamedEntityInterface
    {
        return $this->findOneBy(['name' => $name]);
    }

    /**
     * @throws ORMException
     */
    public function findOneByNameOrCreate(string $name): NamedEntityInterface
    {
        $entity = $this->findOneByName($name);

        if (null === $entity) {
            $entity = $this->createEmpty();

            $entity->setName($name);

            $this->getEntityManager()->persist($entity);
        }

        return $entity;
    }

    abstract protected function createEmpty(): NamedEntityInterface;
}
