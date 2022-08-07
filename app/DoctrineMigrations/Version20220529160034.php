<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220529160034 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE intern_inspection CHANGE breakdownVoltage breakdownVoltage INT DEFAULT NULL');
        $this->addSql('ALTER TABLE isolement CHANGE isolement isolement INT NOT NULL');
        $this->addSql('ALTER TABLE spare_part CHANGE oilBreakdownVoltage oilBreakdownVoltage INT DEFAULT NULL, CHANGE windings windings INT NOT NULL, CHANGE HTAETerminal HTAETerminal INT NOT NULL, CHANGE HTAPTerminals HTAPTerminals INT NOT NULL');
        $this->addSql('ALTER TABLE transformer CHANGE tensioncourtcircuit tensioncourtcircuit DOUBLE PRECISION DEFAULT NULL, CHANGE noloadcurent noloadcurent DOUBLE PRECISION DEFAULT NULL, CHANGE primarytension primarytension INT NOT NULL, CHANGE secondarytension secondarytension INT NOT NULL, CHANGE puissance puissance INT NOT NULL, CHANGE secondarycurrent secondarycurrent INT DEFAULT NULL, CHANGE primarycurrent primarycurrent INT DEFAULT NULL, CHANGE year year INT DEFAULT NULL, CHANGE oil oil INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE intern_inspection CHANGE breakdownVoltage breakdownVoltage VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE isolement CHANGE isolement isolement DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE spare_part CHANGE oilBreakdownVoltage oilBreakdownVoltage VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE windings windings VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE HTAETerminal HTAETerminal VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE HTAPTerminals HTAPTerminals VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE transformer CHANGE tensioncourtcircuit tensioncourtcircuit VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE noloadcurent noloadcurent VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE primarytension primarytension VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE secondarytension secondarytension VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE puissance puissance VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE secondarycurrent secondarycurrent VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE primarycurrent primarycurrent VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE year year VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE oil oil VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci');
    }
}
