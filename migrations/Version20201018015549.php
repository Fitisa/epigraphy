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

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * @author Anton Dyshkant <vyshkant@gmail.com>
 */
final class Version20201018015549 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Extends file names fields sizes.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE interpretation CHANGE text_image_file_names text_image_file_names LONGTEXT DEFAULT NULL, CHANGE photo_file_names photo_file_names LONGTEXT DEFAULT NULL, CHANGE sketch_file_names sketch_file_names LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE zero_row CHANGE text_image_file_names text_image_file_names LONGTEXT DEFAULT NULL, CHANGE photo_file_names photo_file_names LONGTEXT DEFAULT NULL, CHANGE sketch_file_names sketch_file_names LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE interpretation CHANGE text_image_file_names text_image_file_names VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE photo_file_names photo_file_names VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE sketch_file_names sketch_file_names VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE zero_row CHANGE text_image_file_names text_image_file_names VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE photo_file_names photo_file_names VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE sketch_file_names sketch_file_names VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
