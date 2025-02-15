<?php

declare(strict_types=1);

/*
 * This file is part of «Epigraphy of Medieval Rus» database.
 *
 * Copyright (c) National Research University Higher School of Economics
 *
 * «Epigraphy of Medieval Rus» database is free software:
 * you can redistribute it and/or modify it under the terms of the
 * GNU General Public License as published by the Free Software Foundation, version 3.
 *
 * «Epigraphy of Medieval Rus» database is distributed
 * in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even
 * the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU General Public License for more details.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code. If you have not received
 * a copy of the GNU General Public License along with
 * «Epigraphy of Medieval Rus» database,
 * see <http://www.gnu.org/licenses/>.
 */

namespace App\Persistence\Entity\Epigraphy;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Carrier implements StringifiableEntityInterface
{
    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * @var Collection|CarrierType[]
     *
     * @ORM\ManyToMany(targetEntity="App\Persistence\Entity\Epigraphy\CarrierType", cascade={"persist"})
     * @ORM\JoinTable(name="carrier_carrier_type")
     */
    private $types;

    /**
     * @var Collection|CarrierCategory[]
     *
     * @ORM\ManyToMany(targetEntity="App\Persistence\Entity\Epigraphy\CarrierCategory", cascade={"persist"})
     * @ORM\JoinTable(name="carrier_carrier_category")
     */
    private $categories;

    /**
     * @var string|null
     *
     * @ORM\Column(name="origin1", type="string", length=255, nullable=true)
     */
    private $origin1;

    /**
     * @var string|null
     *
     * @ORM\Column(name="origin2", type="string", length=255, nullable=true)
     */
    private $origin2;

    /**
     * @var string|null
     *
     * @ORM\Column(name="find_circumstances", type="text", length=65535, nullable=true)
     */
    private $findCircumstances;

    /**
     * @var string|null
     *
     * @ORM\Column(name="characteristics", type="text", length=65535, nullable=true)
     */
    private $characteristics;

    /**
     * @var string|null
     *
     * @ORM\Column(name="individual_name", type="string", length=255, nullable=true)
     */
    private $individualName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="storage_place", type="string", length=255, nullable=true)
     */
    private $storagePlace;

    /**
     * @var string|null
     *
     * @ORM\Column(name="inventory_number", type="string", length=255, nullable=true)
     */
    private $inventoryNumber;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="is_in_situ", type="boolean", nullable=true)
     */
    private $isInSitu;

    public function __construct()
    {
        $this->types = new ArrayCollection();
        $this->categories = new ArrayCollection();
    }

    public function __toString(): string
    {
        return sprintf(
            '%s, %s (%s, %s); (id: %s)',
            (string) $this->getOrigin1(),
            (string) $this->getOrigin2(),
            (string) $this->getIndividualName(),
            (string) $this->getInventoryNumber(),
            (string) $this->getId()
        );
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|CarrierType[]
     */
    public function getTypes(): Collection
    {
        return $this->types;
    }

    public function setTypes(Collection $types): self
    {
        $this->types = $types;

        return $this;
    }

    /**
     * @return Collection|CarrierCategory[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    /**
     * @param Collection|CarrierCategory[] $categories
     */
    public function setCategories(Collection $categories): self
    {
        $this->categories = $categories;

        return $this;
    }

    public function getOrigin1(): ?string
    {
        return $this->origin1;
    }

    public function setOrigin1(?string $origin1): self
    {
        $this->origin1 = $origin1;

        return $this;
    }

    public function getOrigin2(): ?string
    {
        return $this->origin2;
    }

    public function setOrigin2(?string $origin2): self
    {
        $this->origin2 = $origin2;

        return $this;
    }

    public function getFindCircumstances(): ?string
    {
        return $this->findCircumstances;
    }

    public function setFindCircumstances(?string $findCircumstances): self
    {
        $this->findCircumstances = $findCircumstances;

        return $this;
    }

    public function getCharacteristics(): ?string
    {
        return $this->characteristics;
    }

    public function setCharacteristics(?string $characteristics): self
    {
        $this->characteristics = $characteristics;

        return $this;
    }

    public function getIndividualName(): ?string
    {
        return $this->individualName;
    }

    public function setIndividualName(?string $individualName): self
    {
        $this->individualName = $individualName;

        return $this;
    }

    public function getStoragePlace(): ?string
    {
        return $this->storagePlace;
    }

    public function setStoragePlace(?string $storagePlace): self
    {
        $this->storagePlace = $storagePlace;

        return $this;
    }

    public function getInventoryNumber(): ?string
    {
        return $this->inventoryNumber;
    }

    public function setInventoryNumber(?string $inventoryNumber): self
    {
        $this->inventoryNumber = $inventoryNumber;

        return $this;
    }

    public function getIsInSitu(): ?bool
    {
        return $this->isInSitu;
    }

    public function setIsInSitu(?bool $isInSitu): self
    {
        $this->isInSitu = $isInSitu;

        return $this;
    }
}
