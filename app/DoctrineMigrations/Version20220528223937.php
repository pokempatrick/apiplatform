<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220528223937 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE diagnostic CHANGE transformer_id transformer_id VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE downgrading CHANGE transformer_id transformer_id VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE intern_inspection CHANGE breakdownVoltage breakdownVoltage VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE quality CHANGE transformer_id transformer_id VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE repair CHANGE transformer_id transformer_id VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE spare_part CHANGE oilQuantity oilQuantity INT DEFAULT NULL, CHANGE oilBreakdownVoltage oilBreakdownVoltage VARCHAR(255) DEFAULT NULL, CHANGE oilTank oilTank VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE store_entrance CHANGE transformer_id transformer_id VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE third_party CHANGE transformer_id transformer_id VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE transformer CHANGE id id VARCHAR(255) NOT NULL, CHANGE tensioncourtcircuit tensioncourtcircuit VARCHAR(255) DEFAULT NULL, CHANGE noloadcurent noloadcurent VARCHAR(255) DEFAULT NULL, CHANGE primarytension primarytension VARCHAR(255) NOT NULL, CHANGE secondarytension secondarytension VARCHAR(255) NOT NULL, CHANGE puissance puissance VARCHAR(255) NOT NULL, CHANGE secondarycurrent secondarycurrent VARCHAR(255) DEFAULT NULL, CHANGE primarycurrent primarycurrent VARCHAR(255) DEFAULT NULL, CHANGE year year VARCHAR(255) DEFAULT NULL, CHANGE oil oil VARCHAR(255) DEFAULT NULL, CHANGE commutateur commutateur VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE diagnostic CHANGE transformer_id transformer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE downgrading CHANGE transformer_id transformer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE intern_inspection CHANGE breakdownVoltage breakdownVoltage DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE quality CHANGE transformer_id transformer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE repair CHANGE transformer_id transformer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE spare_part CHANGE oilQuantity oilQuantity INT NOT NULL, CHANGE oilBreakdownVoltage oilBreakdownVoltage INT NOT NULL, CHANGE oilTank oilTank VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE store_entrance CHANGE transformer_id transformer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE third_party CHANGE transformer_id transformer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE transformer CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE tensioncourtcircuit tensioncourtcircuit DOUBLE PRECISION DEFAULT NULL, CHANGE noloadcurent noloadcurent INT DEFAULT NULL, CHANGE primarytension primarytension INT NOT NULL, CHANGE secondarytension secondarytension INT NOT NULL, CHANGE puissance puissance INT NOT NULL, CHANGE secondarycurrent secondarycurrent INT DEFAULT NULL, CHANGE primarycurrent primarycurrent INT DEFAULT NULL, CHANGE year year INT DEFAULT NULL, CHANGE oil oil INT DEFAULT NULL, CHANGE commutateur commutateur INT NOT NULL');
    }
}
