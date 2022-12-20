<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221220140415 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C74404559F7E4405');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D9F7E4405');
        $this->addSql('ALTER TABLE conducteur DROP FOREIGN KEY FK_236771439F7E4405');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455A73F0036');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DA73F0036');
        $this->addSql('ALTER TABLE conducteur DROP FOREIGN KEY FK_2367714330A29AA0');
        $this->addSql('ALTER TABLE secteur DROP FOREIGN KEY FK_8045251FA73F0036');
        $this->addSql('DROP TABLE secteur');
        $this->addSql('DROP TABLE ville');
        $this->addSql('DROP INDEX IDX_C74404559F7E4405 ON client');
        $this->addSql('DROP INDEX IDX_C7440455A73F0036 ON client');
        $this->addSql('ALTER TABLE client ADD ville VARCHAR(255) DEFAULT NULL, ADD secteur VARCHAR(255) DEFAULT NULL, DROP ville_id, DROP secteur_id');
        $this->addSql('DROP INDEX IDX_6EEAA67DA73F0036 ON commande');
        $this->addSql('DROP INDEX IDX_6EEAA67D9F7E4405 ON commande');
        $this->addSql('ALTER TABLE commande DROP ville_id, DROP secteur_id');
        $this->addSql('DROP INDEX IDX_236771439F7E4405 ON conducteur');
        $this->addSql('DROP INDEX IDX_2367714330A29AA0 ON conducteur');
        $this->addSql('ALTER TABLE conducteur DROP ville_travail_id, DROP secteur_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE secteur (id INT AUTO_INCREMENT NOT NULL, ville_id INT DEFAULT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, hex_color VARCHAR(7) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created DATETIME NOT NULL, updated DATETIME NOT NULL, INDEX IDX_8045251FA73F0036 (ville_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE ville (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, longitude DOUBLE PRECISION DEFAULT NULL, latitude DOUBLE PRECISION DEFAULT NULL, hex_color VARCHAR(7) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created DATETIME NOT NULL, updated DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE secteur ADD CONSTRAINT FK_8045251FA73F0036 FOREIGN KEY (ville_id) REFERENCES ville (id)');
        $this->addSql('ALTER TABLE client ADD ville_id INT DEFAULT NULL, ADD secteur_id INT DEFAULT NULL, DROP ville, DROP secteur');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455A73F0036 FOREIGN KEY (ville_id) REFERENCES ville (id)');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C74404559F7E4405 FOREIGN KEY (secteur_id) REFERENCES secteur (id)');
        $this->addSql('CREATE INDEX IDX_C74404559F7E4405 ON client (secteur_id)');
        $this->addSql('CREATE INDEX IDX_C7440455A73F0036 ON client (ville_id)');
        $this->addSql('ALTER TABLE commande ADD ville_id INT NOT NULL, ADD secteur_id INT NOT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DA73F0036 FOREIGN KEY (ville_id) REFERENCES ville (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D9F7E4405 FOREIGN KEY (secteur_id) REFERENCES secteur (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67DA73F0036 ON commande (ville_id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D9F7E4405 ON commande (secteur_id)');
        $this->addSql('ALTER TABLE conducteur ADD ville_travail_id INT NOT NULL, ADD secteur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE conducteur ADD CONSTRAINT FK_2367714330A29AA0 FOREIGN KEY (ville_travail_id) REFERENCES ville (id)');
        $this->addSql('ALTER TABLE conducteur ADD CONSTRAINT FK_236771439F7E4405 FOREIGN KEY (secteur_id) REFERENCES secteur (id)');
        $this->addSql('CREATE INDEX IDX_236771439F7E4405 ON conducteur (secteur_id)');
        $this->addSql('CREATE INDEX IDX_2367714330A29AA0 ON conducteur (ville_travail_id)');
    }
}
