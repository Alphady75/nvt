<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221219073729 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client ADD compt_client_tr_cpt VARCHAR(255) DEFAULT NULL, ADD compt_client_cc_multi TINYINT(1) DEFAULT NULL, ADD compt_client_mod_reg VARCHAR(255) DEFAULT NULL, ADD compt_client_type_reg VARCHAR(255) DEFAULT NULL, ADD compt_client_type_reg_parc VARCHAR(255) DEFAULT NULL, ADD compt_client_jours_paiement INT DEFAULT NULL, ADD compt_client_act_vente VARCHAR(255) DEFAULT NULL, ADD compt_client_gr_tax_ventes VARCHAR(255) DEFAULT NULL, ADD compt_client_fact_aout TINYINT(1) DEFAULT NULL, ADD compt_client_certif_start_at DATETIME DEFAULT NULL, ADD compt_client_certif_end_at DATETIME DEFAULT NULL, ADD compt_client_ref VARCHAR(255) DEFAULT NULL, ADD relance_nom VARCHAR(255) DEFAULT NULL, ADD relance_tel VARCHAR(255) DEFAULT NULL, ADD relance_tel2 VARCHAR(255) DEFAULT NULL, ADD relance_email VARCHAR(255) DEFAULT NULL, ADD relance_memo LONGTEXT DEFAULT NULL, ADD relance_jours INT DEFAULT NULL, ADD adresse_type VARCHAR(255) DEFAULT NULL, ADD adresse_code VARCHAR(255) DEFAULT NULL, ADD adresse_nom VARCHAR(255) DEFAULT NULL, ADD adresse_dep VARCHAR(255) DEFAULT NULL, ADD adresse_ref VARCHAR(255) DEFAULT NULL, ADD adresse_ville VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client DROP compt_client_tr_cpt, DROP compt_client_cc_multi, DROP compt_client_mod_reg, DROP compt_client_type_reg, DROP compt_client_type_reg_parc, DROP compt_client_jours_paiement, DROP compt_client_act_vente, DROP compt_client_gr_tax_ventes, DROP compt_client_fact_aout, DROP compt_client_certif_start_at, DROP compt_client_certif_end_at, DROP compt_client_ref, DROP relance_nom, DROP relance_tel, DROP relance_tel2, DROP relance_email, DROP relance_memo, DROP relance_jours, DROP adresse_type, DROP adresse_code, DROP adresse_nom, DROP adresse_dep, DROP adresse_ref, DROP adresse_ville');
    }
}
