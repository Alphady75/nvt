<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221220150031 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE commande_itineraire');
        $this->addSql('ALTER TABLE commande ADD itineraire_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DA9B853B8 FOREIGN KEY (itineraire_id) REFERENCES itineraire (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67DA9B853B8 ON commande (itineraire_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commande_itineraire (commande_id INT NOT NULL, itineraire_id INT NOT NULL, INDEX IDX_D0BEB6F7A9B853B8 (itineraire_id), INDEX IDX_D0BEB6F782EA2E54 (commande_id), PRIMARY KEY(commande_id, itineraire_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE commande_itineraire ADD CONSTRAINT FK_D0BEB6F782EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande_itineraire ADD CONSTRAINT FK_D0BEB6F7A9B853B8 FOREIGN KEY (itineraire_id) REFERENCES itineraire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DA9B853B8');
        $this->addSql('DROP INDEX IDX_6EEAA67DA9B853B8 ON commande');
        $this->addSql('ALTER TABLE commande DROP itineraire_id');
    }
}
