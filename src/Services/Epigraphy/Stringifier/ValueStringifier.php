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

namespace App\Services\Epigraphy\Stringifier;

use App\Models\StringActualValue;
use App\Persistence\Entity\Epigraphy\Inscription;
use App\Services\Epigraphy\ActualValue\Extractor\ActualValueExtractorInterface;
use App\Services\Epigraphy\ActualValue\Formatter\ActualValueFormatterInterface;

final class ValueStringifier implements ValueStringifierInterface
{
    private ActualValueExtractorInterface $extractor;

    private ActualValueFormatterInterface $formatter;

    public function __construct(
        ActualValueExtractorInterface $extractor,
        ActualValueFormatterInterface $formatter
    ) {
        $this->extractor = $extractor;
        $this->formatter = $formatter;
    }

    public function stringify(
        Inscription $inscription,
        string $propertyName,
        string $formatType = ActualValueFormatterInterface::FORMAT_TYPE_DEFAULT
    ): ?string {
        $result = implode(
            '<br />',
            array_map(
                fn (StringActualValue $actualValue): string => $this->formatter->format($actualValue, $formatType),
                $this->extractor->extractFromZeroRowAsStrings($inscription, $propertyName)
            )
        );

        return '' === $result ? null : $result;
    }
}
