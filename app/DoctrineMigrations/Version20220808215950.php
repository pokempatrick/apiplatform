<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220808215950 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE diagnostic_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE downgrading_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE inspection_visuelle_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE intern_inspection_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE isolement_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE manufacturer_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE quality_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE repair_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE result_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE spare_part_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE store_entrance_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE third_party_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE transformer_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE turn_ratio_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE diagnostic (id INT NOT NULL, result_id INT DEFAULT NULL, transformer_id INT DEFAULT NULL, statut BOOLEAN NOT NULL, keyid VARCHAR(255) NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, createdDate TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, operateur VARCHAR(255) NOT NULL, conformity BOOLEAN NOT NULL, next VARCHAR(255) DEFAULT NULL, inspectionVisuelle_id INT DEFAULT NULL, internInspection_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FA7C88897A7B643 ON diagnostic (result_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FA7C88899265A7CE ON diagnostic (inspectionVisuelle_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FA7C8889603C3C46 ON diagnostic (internInspection_id)');
        $this->addSql('CREATE INDEX IDX_FA7C8889B4303423 ON diagnostic (transformer_id)');
        $this->addSql('CREATE TABLE downgrading (id INT NOT NULL, transformer_id INT DEFAULT NULL, statut BOOLEAN NOT NULL, keyid VARCHAR(255) NOT NULL, operateur VARCHAR(255) NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, createdDate TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, sparePart_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8D86B54BB4303423 ON downgrading (transformer_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D86B54BB06A4054 ON downgrading (sparePart_id)');
        $this->addSql('CREATE TABLE inspection_visuelle (id INT NOT NULL, borneBT BOOLEAN NOT NULL, borneHTA BOOLEAN NOT NULL, partieActive BOOLEAN NOT NULL, fuiteHuile BOOLEAN NOT NULL, other TEXT NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, operateur VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE intern_inspection (id INT NOT NULL, offLoadAdjuster BOOLEAN NOT NULL, winding BOOLEAN NOT NULL, magneticCircuit BOOLEAN NOT NULL, solidInsolation BOOLEAN NOT NULL, oil BOOLEAN NOT NULL, breakdownVoltage INT DEFAULT NULL, testPCB VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE isolement (id INT NOT NULL, diagnostic_id INT DEFAULT NULL, quality_id INT DEFAULT NULL, tension INT NOT NULL, type VARCHAR(255) NOT NULL, temps INT NOT NULL, isolement INT NOT NULL, keyid VARCHAR(255) NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, operateur VARCHAR(255) NOT NULL, thirdParty_id INT DEFAULT NULL, storeEntrance_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4C4A6B2B224CCA91 ON isolement (diagnostic_id)');
        $this->addSql('CREATE INDEX IDX_4C4A6B2BBCFC6D57 ON isolement (quality_id)');
        $this->addSql('CREATE INDEX IDX_4C4A6B2B3EA5CAB0 ON isolement (thirdParty_id)');
        $this->addSql('CREATE INDEX IDX_4C4A6B2B597BA0D6 ON isolement (storeEntrance_id)');
        $this->addSql('CREATE TABLE manufacturer (id INT NOT NULL, nom VARCHAR(255) DEFAULT NULL, pays VARCHAR(255) DEFAULT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, operateur VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE quality (id INT NOT NULL, result_id INT DEFAULT NULL, transformer_id INT DEFAULT NULL, statut BOOLEAN NOT NULL, keyid VARCHAR(255) NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, createdDate TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, operateur VARCHAR(255) NOT NULL, inspectionVisuelle_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7CB20B107A7B643 ON quality (result_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7CB20B109265A7CE ON quality (inspectionVisuelle_id)');
        $this->addSql('CREATE INDEX IDX_7CB20B10B4303423 ON quality (transformer_id)');
        $this->addSql('CREATE TABLE repair (id INT NOT NULL, transformer_id INT DEFAULT NULL, statut BOOLEAN NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, createdDate TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, keyid VARCHAR(255) NOT NULL, operateur VARCHAR(255) NOT NULL, sparePart_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8EE43421B4303423 ON repair (transformer_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8EE43421B06A4054 ON repair (sparePart_id)');
        $this->addSql('CREATE TABLE result (id INT NOT NULL, anomalie TEXT NOT NULL, conclusion VARCHAR(255) NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, operateur VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE spare_part (id INT NOT NULL, oilQuantity INT DEFAULT NULL, oilBreakdownVoltage INT DEFAULT NULL, oilTank VARCHAR(255) DEFAULT NULL, windings INT NOT NULL, HTAETerminal INT NOT NULL, HTAPTerminals INT NOT NULL, offLaodAdjuster BOOLEAN NOT NULL, connexion BOOLEAN NOT NULL, operateur VARCHAR(255) NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE store_entrance (id INT NOT NULL, result_id INT DEFAULT NULL, transformer_id INT DEFAULT NULL, statut BOOLEAN NOT NULL, keyid VARCHAR(255) NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, createdDate TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, operateur VARCHAR(255) NOT NULL, conformity BOOLEAN NOT NULL, inspectionVisuelle_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B9AD1E737A7B643 ON store_entrance (result_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B9AD1E739265A7CE ON store_entrance (inspectionVisuelle_id)');
        $this->addSql('CREATE INDEX IDX_B9AD1E73B4303423 ON store_entrance (transformer_id)');
        $this->addSql('CREATE TABLE third_party (id INT NOT NULL, result_id INT DEFAULT NULL, transformer_id INT DEFAULT NULL, statut BOOLEAN NOT NULL, keyid VARCHAR(255) NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, createdDate TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, operateur VARCHAR(255) NOT NULL, conformity BOOLEAN NOT NULL, inspectionVisuelle_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_346F1E227A7B643 ON third_party (result_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_346F1E229265A7CE ON third_party (inspectionVisuelle_id)');
        $this->addSql('CREATE INDEX IDX_346F1E22B4303423 ON third_party (transformer_id)');
        $this->addSql('CREATE TABLE transformer (id INT NOT NULL, serie VARCHAR(255) NOT NULL, matricule VARCHAR(255) DEFAULT NULL, manufacturer VARCHAR(255) NOT NULL, tensioncourtcircuit DOUBLE PRECISION DEFAULT NULL, noloadcurent DOUBLE PRECISION DEFAULT NULL, primarytension INT NOT NULL, secondarytension INT NOT NULL, puissance INT NOT NULL, secondarycurrent INT DEFAULT NULL, primarycurrent INT DEFAULT NULL, couplage VARCHAR(255) NOT NULL, year INT DEFAULT NULL, oil INT DEFAULT NULL, commutateur VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_664E9BAD12B2DC9C ON transformer (matricule)');
        $this->addSql('CREATE TABLE turn_ratio (id INT NOT NULL, diagnostic_id INT DEFAULT NULL, quality_id INT DEFAULT NULL, bobine VARCHAR(255) NOT NULL, ratio DOUBLE PRECISION NOT NULL, tension INT NOT NULL, equipment VARCHAR(255) NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, operateur VARCHAR(255) NOT NULL, keyid VARCHAR(255) NOT NULL, thirdParty_id INT DEFAULT NULL, storeEntrance_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_547A9F1B224CCA91 ON turn_ratio (diagnostic_id)');
        $this->addSql('CREATE INDEX IDX_547A9F1BBCFC6D57 ON turn_ratio (quality_id)');
        $this->addSql('CREATE INDEX IDX_547A9F1B3EA5CAB0 ON turn_ratio (thirdParty_id)');
        $this->addSql('CREATE INDEX IDX_547A9F1B597BA0D6 ON turn_ratio (storeEntrance_id)');
        $this->addSql('ALTER TABLE diagnostic ADD CONSTRAINT FK_FA7C88897A7B643 FOREIGN KEY (result_id) REFERENCES result (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE diagnostic ADD CONSTRAINT FK_FA7C88899265A7CE FOREIGN KEY (inspectionVisuelle_id) REFERENCES inspection_visuelle (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE diagnostic ADD CONSTRAINT FK_FA7C8889603C3C46 FOREIGN KEY (internInspection_id) REFERENCES intern_inspection (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE diagnostic ADD CONSTRAINT FK_FA7C8889B4303423 FOREIGN KEY (transformer_id) REFERENCES transformer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE downgrading ADD CONSTRAINT FK_8D86B54BB4303423 FOREIGN KEY (transformer_id) REFERENCES transformer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE downgrading ADD CONSTRAINT FK_8D86B54BB06A4054 FOREIGN KEY (sparePart_id) REFERENCES spare_part (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE isolement ADD CONSTRAINT FK_4C4A6B2B224CCA91 FOREIGN KEY (diagnostic_id) REFERENCES diagnostic (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE isolement ADD CONSTRAINT FK_4C4A6B2BBCFC6D57 FOREIGN KEY (quality_id) REFERENCES quality (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE isolement ADD CONSTRAINT FK_4C4A6B2B3EA5CAB0 FOREIGN KEY (thirdParty_id) REFERENCES third_party (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE isolement ADD CONSTRAINT FK_4C4A6B2B597BA0D6 FOREIGN KEY (storeEntrance_id) REFERENCES store_entrance (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE quality ADD CONSTRAINT FK_7CB20B107A7B643 FOREIGN KEY (result_id) REFERENCES result (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE quality ADD CONSTRAINT FK_7CB20B109265A7CE FOREIGN KEY (inspectionVisuelle_id) REFERENCES inspection_visuelle (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE quality ADD CONSTRAINT FK_7CB20B10B4303423 FOREIGN KEY (transformer_id) REFERENCES transformer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE repair ADD CONSTRAINT FK_8EE43421B4303423 FOREIGN KEY (transformer_id) REFERENCES transformer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE repair ADD CONSTRAINT FK_8EE43421B06A4054 FOREIGN KEY (sparePart_id) REFERENCES spare_part (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE store_entrance ADD CONSTRAINT FK_B9AD1E737A7B643 FOREIGN KEY (result_id) REFERENCES result (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE store_entrance ADD CONSTRAINT FK_B9AD1E739265A7CE FOREIGN KEY (inspectionVisuelle_id) REFERENCES inspection_visuelle (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE store_entrance ADD CONSTRAINT FK_B9AD1E73B4303423 FOREIGN KEY (transformer_id) REFERENCES transformer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE third_party ADD CONSTRAINT FK_346F1E227A7B643 FOREIGN KEY (result_id) REFERENCES result (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE third_party ADD CONSTRAINT FK_346F1E229265A7CE FOREIGN KEY (inspectionVisuelle_id) REFERENCES inspection_visuelle (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE third_party ADD CONSTRAINT FK_346F1E22B4303423 FOREIGN KEY (transformer_id) REFERENCES transformer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE turn_ratio ADD CONSTRAINT FK_547A9F1B224CCA91 FOREIGN KEY (diagnostic_id) REFERENCES diagnostic (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE turn_ratio ADD CONSTRAINT FK_547A9F1BBCFC6D57 FOREIGN KEY (quality_id) REFERENCES quality (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE turn_ratio ADD CONSTRAINT FK_547A9F1B3EA5CAB0 FOREIGN KEY (thirdParty_id) REFERENCES third_party (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE turn_ratio ADD CONSTRAINT FK_547A9F1B597BA0D6 FOREIGN KEY (storeEntrance_id) REFERENCES store_entrance (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE isolement DROP CONSTRAINT FK_4C4A6B2B224CCA91');
        $this->addSql('ALTER TABLE turn_ratio DROP CONSTRAINT FK_547A9F1B224CCA91');
        $this->addSql('ALTER TABLE diagnostic DROP CONSTRAINT FK_FA7C88899265A7CE');
        $this->addSql('ALTER TABLE quality DROP CONSTRAINT FK_7CB20B109265A7CE');
        $this->addSql('ALTER TABLE store_entrance DROP CONSTRAINT FK_B9AD1E739265A7CE');
        $this->addSql('ALTER TABLE third_party DROP CONSTRAINT FK_346F1E229265A7CE');
        $this->addSql('ALTER TABLE diagnostic DROP CONSTRAINT FK_FA7C8889603C3C46');
        $this->addSql('ALTER TABLE isolement DROP CONSTRAINT FK_4C4A6B2BBCFC6D57');
        $this->addSql('ALTER TABLE turn_ratio DROP CONSTRAINT FK_547A9F1BBCFC6D57');
        $this->addSql('ALTER TABLE diagnostic DROP CONSTRAINT FK_FA7C88897A7B643');
        $this->addSql('ALTER TABLE quality DROP CONSTRAINT FK_7CB20B107A7B643');
        $this->addSql('ALTER TABLE store_entrance DROP CONSTRAINT FK_B9AD1E737A7B643');
        $this->addSql('ALTER TABLE third_party DROP CONSTRAINT FK_346F1E227A7B643');
        $this->addSql('ALTER TABLE downgrading DROP CONSTRAINT FK_8D86B54BB06A4054');
        $this->addSql('ALTER TABLE repair DROP CONSTRAINT FK_8EE43421B06A4054');
        $this->addSql('ALTER TABLE isolement DROP CONSTRAINT FK_4C4A6B2B597BA0D6');
        $this->addSql('ALTER TABLE turn_ratio DROP CONSTRAINT FK_547A9F1B597BA0D6');
        $this->addSql('ALTER TABLE isolement DROP CONSTRAINT FK_4C4A6B2B3EA5CAB0');
        $this->addSql('ALTER TABLE turn_ratio DROP CONSTRAINT FK_547A9F1B3EA5CAB0');
        $this->addSql('ALTER TABLE diagnostic DROP CONSTRAINT FK_FA7C8889B4303423');
        $this->addSql('ALTER TABLE downgrading DROP CONSTRAINT FK_8D86B54BB4303423');
        $this->addSql('ALTER TABLE quality DROP CONSTRAINT FK_7CB20B10B4303423');
        $this->addSql('ALTER TABLE repair DROP CONSTRAINT FK_8EE43421B4303423');
        $this->addSql('ALTER TABLE store_entrance DROP CONSTRAINT FK_B9AD1E73B4303423');
        $this->addSql('ALTER TABLE third_party DROP CONSTRAINT FK_346F1E22B4303423');
        $this->addSql('DROP SEQUENCE diagnostic_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE downgrading_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE inspection_visuelle_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE intern_inspection_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE isolement_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE manufacturer_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE quality_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE repair_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE result_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE spare_part_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE store_entrance_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE third_party_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE transformer_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE turn_ratio_id_seq CASCADE');
        $this->addSql('DROP TABLE diagnostic');
        $this->addSql('DROP TABLE downgrading');
        $this->addSql('DROP TABLE inspection_visuelle');
        $this->addSql('DROP TABLE intern_inspection');
        $this->addSql('DROP TABLE isolement');
        $this->addSql('DROP TABLE manufacturer');
        $this->addSql('DROP TABLE quality');
        $this->addSql('DROP TABLE repair');
        $this->addSql('DROP TABLE result');
        $this->addSql('DROP TABLE spare_part');
        $this->addSql('DROP TABLE store_entrance');
        $this->addSql('DROP TABLE third_party');
        $this->addSql('DROP TABLE transformer');
        $this->addSql('DROP TABLE turn_ratio');
    }
}
