<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221219061115 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client ADD plan_char TINYINT(1) DEFAULT NULL, ADD plan_code_char TINYINT(1) DEFAULT NULL, ADD plan_sup_char VARCHAR(255) DEFAULT NULL, ADD plan_nb_car_char INT DEFAULT NULL, ADD plan_vide_char TINYINT(1) DEFAULT NULL, ADD plan_ref_client_char TINYINT(1) DEFAULT NULL, ADD plan_sup2_char VARCHAR(255) DEFAULT NULL, ADD plan_nb_car2_char INT DEFAULT NULL, ADD plan_liv TINYINT(1) DEFAULT NULL, ADD plan_liv_code TINYINT(1) DEFAULT NULL, ADD plan_liv_sup VARCHAR(255) DEFAULT NULL, ADD plan_liv_nb_car INT DEFAULT NULL, ADD plan_liv_ref_client TINYINT(1) DEFAULT NULL, ADD plan_liv_sup2 VARCHAR(255) DEFAULT NULL, ADD plan_liv_nb_car2 INT DEFAULT NULL, ADD feuille_char TINYINT(1) DEFAULT NULL, ADD feuille_code_char TINYINT(1) DEFAULT NULL, ADD feuille_sup_char VARCHAR(255) DEFAULT NULL, ADD feuille_nb_car_char INT DEFAULT NULL, ADD feuille_vide_char TINYINT(1) DEFAULT NULL, ADD feuille_ref_client_char TINYINT(1) DEFAULT NULL, ADD feuille_liv TINYINT(1) DEFAULT NULL, ADD feuille_liv_code TINYINT(1) DEFAULT NULL, ADD feuille_liv_sup VARCHAR(255) DEFAULT NULL, ADD feuille_liv_nb_car INT DEFAULT NULL, ADD feuille_liv_ref_client TINYINT(1) DEFAULT NULL, ADD compt_four_tr_cpt VARCHAR(255) DEFAULT NULL, ADD compt_four_cc_multi TINYINT(1) DEFAULT NULL, ADD compt_four_mod_reg VARCHAR(255) DEFAULT NULL, ADD compt_four_type_reg VARCHAR(255) DEFAULT NULL, ADD compt_four_type_reg_parc VARCHAR(255) DEFAULT NULL, ADD compt_four_jour_paiement DATETIME DEFAULT NULL, ADD compt_four_act_achat VARCHAR(255) DEFAULT NULL, ADD compt_four_gr_tax_achats VARCHAR(255) DEFAULT NULL, ADD compt_four_fact_aout TINYINT(1) DEFAULT NULL, ADD compt_four_certif_start_at DATETIME DEFAULT NULL, ADD compt_four_certif_end_at DATETIME DEFAULT NULL, ADD compt_four_ref VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client DROP plan_char, DROP plan_code_char, DROP plan_sup_char, DROP plan_nb_car_char, DROP plan_vide_char, DROP plan_ref_client_char, DROP plan_sup2_char, DROP plan_nb_car2_char, DROP plan_liv, DROP plan_liv_code, DROP plan_liv_sup, DROP plan_liv_nb_car, DROP plan_liv_ref_client, DROP plan_liv_sup2, DROP plan_liv_nb_car2, DROP feuille_char, DROP feuille_code_char, DROP feuille_sup_char, DROP feuille_nb_car_char, DROP feuille_vide_char, DROP feuille_ref_client_char, DROP feuille_liv, DROP feuille_liv_code, DROP feuille_liv_sup, DROP feuille_liv_nb_car, DROP feuille_liv_ref_client, DROP compt_four_tr_cpt, DROP compt_four_cc_multi, DROP compt_four_mod_reg, DROP compt_four_type_reg, DROP compt_four_type_reg_parc, DROP compt_four_jour_paiement, DROP compt_four_act_achat, DROP compt_four_gr_tax_achats, DROP compt_four_fact_aout, DROP compt_four_certif_start_at, DROP compt_four_certif_end_at, DROP compt_four_ref');
    }
}
