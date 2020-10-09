<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201009092004 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE agency ADD user_id INT NOT NULL, ADD name_special_contact VARCHAR(255) DEFAULT NULL, ADD commentary VARCHAR(255) DEFAULT NULL, CHANGE name_contact name_contact VARCHAR(255) DEFAULT NULL, CHANGE id_contact id_contact INT DEFAULT NULL');
        $this->addSql('ALTER TABLE audience_type CHANGE less13 less13 INT DEFAULT NULL, CHANGE less17 less17 INT DEFAULT NULL, CHANGE less24 less24 INT DEFAULT NULL, CHANGE less34 less34 INT DEFAULT NULL, CHANGE less44 less44 INT DEFAULT NULL, CHANGE more45 more45 INT DEFAULT NULL, CHANGE share_h share_m INT NOT NULL');
        $this->addSql('ALTER TABLE info_contact ADD commentary VARCHAR(255) DEFAULT NULL, CHANGE mail_pro mail_pro VARCHAR(180) DEFAULT NULL, CHANGE phone_number phone_number INT DEFAULT NULL, CHANGE postal_adress postal_adress VARCHAR(500) DEFAULT NULL, CHANGE num_whats_app num_whats_app VARCHAR(17) DEFAULT NULL, CHANGE prefered_contact prefered_contact VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE performance CHANGE id_stats_yt id_stats_yt INT DEFAULT NULL, CHANGE id_stats_ig id_stats_ig INT DEFAULT NULL, CHANGE id_stats_tw id_stats_tw INT DEFAULT NULL, CHANGE id_stats_tk id_stats_tk INT DEFAULT NULL, CHANGE margin margin INT DEFAULT NULL, CHANGE picture_large picture_large VARCHAR(255) DEFAULT NULL, CHANGE picture_small picture_small VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE stats_ig CHANGE like_ig like_ig INT DEFAULT NULL, CHANGE nbr_coms_ig nbr_coms_ig INT DEFAULT NULL, CHANGE nbr_abo_ig nbr_abo_ig INT DEFAULT NULL');
        $this->addSql('ALTER TABLE stats_tk CHANGE nbr_like_tk nbr_like_tk INT DEFAULT NULL, CHANGE nbr_abo_tk nbr_abo_tk INT DEFAULT NULL, CHANGE nbr_coms_tk nbr_coms_tk INT DEFAULT NULL, CHANGE nbr_vues_tk nbr_vues_tk INT DEFAULT NULL');
        $this->addSql('ALTER TABLE stats_tw CHANGE average_view_tw average_view_tw INT DEFAULT NULL, CHANGE nbr_abo_tw nbr_abo_tw INT DEFAULT NULL');
        $this->addSql('ALTER TABLE stats_yt CHANGE estimations_yt estimations_yt INT DEFAULT NULL, CHANGE like_yt like_yt INT DEFAULT NULL, CHANGE dislike_yt dislike_yt INT DEFAULT NULL, CHANGE view_yt view_yt INT DEFAULT NULL, CHANGE nb_vid7_yt nb_vid7_yt INT DEFAULT NULL, CHANGE nb_vid37_yt nb_vid37_yt INT DEFAULT NULL, CHANGE nb_abo_yt nb_abo_yt INT DEFAULT NULL, CHANGE nb_coms_yt nb_coms_yt INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD commentary VARCHAR(255) DEFAULT NULL, CHANGE id_agency id_agency INT DEFAULT NULL, CHANGE info_contact info_contact INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE agency DROP user_id, DROP name_special_contact, DROP commentary, CHANGE name_contact name_contact VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE id_contact id_contact INT NOT NULL');
        $this->addSql('ALTER TABLE audience_type CHANGE less13 less13 INT NOT NULL, CHANGE less17 less17 INT NOT NULL, CHANGE less24 less24 INT NOT NULL, CHANGE less34 less34 INT NOT NULL, CHANGE less44 less44 INT NOT NULL, CHANGE more45 more45 INT NOT NULL, CHANGE share_m share_h INT NOT NULL');
        $this->addSql('ALTER TABLE info_contact DROP commentary, CHANGE mail_pro mail_pro VARCHAR(180) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE phone_number phone_number INT NOT NULL, CHANGE postal_adress postal_adress VARCHAR(500) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE num_whats_app num_whats_app INT NOT NULL, CHANGE prefered_contact prefered_contact VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE performance CHANGE id_stats_yt id_stats_yt INT NOT NULL, CHANGE id_stats_ig id_stats_ig INT NOT NULL, CHANGE id_stats_tw id_stats_tw INT NOT NULL, CHANGE id_stats_tk id_stats_tk INT NOT NULL, CHANGE margin margin INT NOT NULL, CHANGE picture_large picture_large VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE picture_small picture_small VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE stats_ig CHANGE like_ig like_ig INT NOT NULL, CHANGE nbr_coms_ig nbr_coms_ig INT NOT NULL, CHANGE nbr_abo_ig nbr_abo_ig INT NOT NULL');
        $this->addSql('ALTER TABLE stats_tk CHANGE nbr_like_tk nbr_like_tk INT NOT NULL, CHANGE nbr_abo_tk nbr_abo_tk INT NOT NULL, CHANGE nbr_coms_tk nbr_coms_tk INT NOT NULL, CHANGE nbr_vues_tk nbr_vues_tk INT NOT NULL');
        $this->addSql('ALTER TABLE stats_tw CHANGE average_view_tw average_view_tw INT NOT NULL, CHANGE nbr_abo_tw nbr_abo_tw INT NOT NULL');
        $this->addSql('ALTER TABLE stats_yt CHANGE estimations_yt estimations_yt INT NOT NULL, CHANGE like_yt like_yt INT NOT NULL, CHANGE dislike_yt dislike_yt INT NOT NULL, CHANGE view_yt view_yt INT NOT NULL, CHANGE nb_vid7_yt nb_vid7_yt INT NOT NULL, CHANGE nb_vid37_yt nb_vid37_yt INT NOT NULL, CHANGE nb_abo_yt nb_abo_yt INT NOT NULL, CHANGE nb_coms_yt nb_coms_yt INT NOT NULL');
        $this->addSql('ALTER TABLE user DROP commentary, CHANGE id_agency id_agency INT NOT NULL, CHANGE info_contact info_contact INT NOT NULL');
    }
}
