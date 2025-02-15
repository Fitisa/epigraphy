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

namespace App\Models;

use App\Persistence\Entity\Epigraphy\Interpretation;
use App\Persistence\Entity\Media\File;
use Symfony\Contracts\Translation\TranslatorInterface;

final class FilesActualValue
{
    /**
     * @var array|File[]
     */
    private array $value;

    private ?Interpretation $interpretation;

    /**
     * @param array|File[] $value
     */
    public function __construct(array $value, ?Interpretation $interpretation)
    {
        $this->value = $value;
        $this->interpretation = $interpretation;
    }

    /**
     * @return array|File[]
     */
    public function getValue(): array
    {
        return $this->value;
    }

    public function getInterpretation(): ?Interpretation
    {
        return $this->interpretation;
    }
}
