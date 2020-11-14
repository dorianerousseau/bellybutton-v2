<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201114135730 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE agency (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, name_agency VARCHAR(180) NOT NULL, id_default_contact INT NOT NULL, name_contact VARCHAR(255) DEFAULT NULL, id_contact INT DEFAULT NULL, name_special_contact VARCHAR(255) DEFAULT NULL, commentary VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_70C0C6E676B855AB (name_agency), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(100) NOT NULL, subtitle VARCHAR(100) DEFAULT NULL, body LONGTEXT NOT NULL, image VARCHAR(80) DEFAULT NULL, nb_view INT DEFAULT NULL, status TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_tag (article_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_919694F97294869C (article_id), INDEX IDX_919694F9BAD26311 (tag_id), PRIMARY KEY(article_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_user (article_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_3DD151487294869C (article_id), INDEX IDX_3DD15148A76ED395 (user_id), PRIMARY KEY(article_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE audience_type (id_audience INT AUTO_INCREMENT NOT NULL, country1 VARCHAR(255) NOT NULL, country2 VARCHAR(255) NOT NULL, country3 VARCHAR(255) NOT NULL, world INT NOT NULL, share_m INT NOT NULL, less13 INT DEFAULT NULL, less17 INT DEFAULT NULL, less24 INT DEFAULT NULL, less34 INT DEFAULT NULL, less44 INT DEFAULT NULL, more45 INT DEFAULT NULL, PRIMARY KEY(id_audience)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE campaign (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, price INT NOT NULL, view_goal INT NOT NULL, view INT DEFAULT NULL, nb_like INT DEFAULT NULL, nb_comment INT DEFAULT NULL, total_impression INT DEFAULT NULL, cost_per_thousand INT DEFAULT NULL, engagement_rate INT DEFAULT NULL, status TINYINT(1) NOT NULL, finish_at DATETIME NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE campaign_user (campaign_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_8C74EDABF639F774 (campaign_id), INDEX IDX_8C74EDABA76ED395 (user_id), PRIMARY KEY(campaign_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, support_id INT DEFAULT NULL, number INT DEFAULT NULL, created_at DATETIME NOT NULL, INDEX IDX_9474526C315B405 (support_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentary (id INT AUTO_INCREMENT NOT NULL, article_id INT NOT NULL, username VARCHAR(80) NOT NULL, body LONGTEXT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_1CAC12CA7294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE info_contact (id INT AUTO_INCREMENT NOT NULL, mail_pro VARCHAR(180) DEFAULT NULL, phone_number INT DEFAULT NULL, postal_adress VARCHAR(500) DEFAULT NULL, num_whats_app VARCHAR(17) DEFAULT NULL, prefered_contact VARCHAR(100) DEFAULT NULL, commentary VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_CEA7CFA677AFF995 (mail_pro), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `like` (id INT AUTO_INCREMENT NOT NULL, support_id INT DEFAULT NULL, number INT DEFAULT NULL, created_at DATETIME NOT NULL, INDEX IDX_AC6340B3315B405 (support_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE performance (id_user INT AUTO_INCREMENT NOT NULL, id_stats_yt INT DEFAULT NULL, id_stats_ig INT DEFAULT NULL, id_stats_tw INT DEFAULT NULL, id_stats_tk INT DEFAULT NULL, audience_categorie INT NOT NULL, status INT NOT NULL, sector INT NOT NULL, margin INT DEFAULT NULL, picture_large VARCHAR(255) DEFAULT NULL, picture_small VARCHAR(255) DEFAULT NULL, id_vente_yt INT DEFAULT NULL, id_vente_tw INT NOT NULL, id_vente_tk INT NOT NULL, id_vente_ig INT NOT NULL, PRIMARY KEY(id_user)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, label VARCHAR(50) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stats_ig (id_stats_ig INT AUTO_INCREMENT NOT NULL, like_ig INT DEFAULT NULL, nbr_coms_ig INT DEFAULT NULL, nbr_abo_ig INT DEFAULT NULL, id_audience INT NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id_stats_ig)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stats_tk (id_stats_tk INT AUTO_INCREMENT NOT NULL, nbr_like_tk INT DEFAULT NULL, nbr_abo_tk INT DEFAULT NULL, nbr_coms_tk INT DEFAULT NULL, nbr_vues_tk INT DEFAULT NULL, id_audience INT NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id_stats_tk)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stats_tw (id_stats_tw INT AUTO_INCREMENT NOT NULL, average_view_tw INT DEFAULT NULL, nbr_abo_tw INT DEFAULT NULL, id_audience INT NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id_stats_tw)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stats_yt (id_stats_yt INT AUTO_INCREMENT NOT NULL, estimations_yt INT DEFAULT NULL, like_yt INT DEFAULT NULL, dislike_yt INT DEFAULT NULL, view_yt INT DEFAULT NULL, nb_vid7_yt INT DEFAULT NULL, nb_vid37_yt INT DEFAULT NULL, nb_abo_yt INT DEFAULT NULL, nb_coms_yt INT DEFAULT NULL, id_audience INT NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id_stats_yt)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE support (id INT AUTO_INCREMENT NOT NULL, campaign_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, id_video VARCHAR(255) NOT NULL, network VARCHAR(100) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, author VARCHAR(255) NOT NULL, INDEX IDX_8004EBA5F639F774 (campaign_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(100) NOT NULL, lastname VARCHAR(100) NOT NULL, status TINYINT(1) NOT NULL, id_instagram VARCHAR(100) DEFAULT NULL, id_facebook VARCHAR(100) DEFAULT NULL, id_youtube VARCHAR(100) DEFAULT NULL, id_snapchat VARCHAR(100) DEFAULT NULL, id_tiktok VARCHAR(100) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, company_name VARCHAR(100) DEFAULT NULL, commentary VARCHAR(255) DEFAULT NULL, id_agency INT DEFAULT NULL, info_contact INT DEFAULT NULL, reset_token VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_role (user_id INT NOT NULL, role_id INT NOT NULL, INDEX IDX_2DE8C6A3A76ED395 (user_id), INDEX IDX_2DE8C6A3D60322AC (role_id), PRIMARY KEY(user_id, role_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vente_ig (id INT AUTO_INCREMENT NOT NULL, cachet_post INT NOT NULL, marge_post INT NOT NULL, cachet_story INT NOT NULL, marge_story INT NOT NULL, cachet_igtv INT NOT NULL, marge_igtv INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vente_tk (id INT AUTO_INCREMENT NOT NULL, cachet_post INT NOT NULL, marge_post INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vente_tw (id INT AUTO_INCREMENT NOT NULL, cachet_pdp INT NOT NULL, marge_pdp INT NOT NULL, cachet_sponso INT NOT NULL, marge_sponso INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vente_yt (id INT AUTO_INCREMENT NOT NULL, garantie INT NOT NULL, estimation INT NOT NULL, cachet_inte INT NOT NULL, marge_inte INT NOT NULL, cachet_vid_de INT NOT NULL, marge_vid_de INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE view (id INT AUTO_INCREMENT NOT NULL, support_id INT DEFAULT NULL, number INT DEFAULT NULL, created_at DATETIME NOT NULL, INDEX IDX_FEFDAB8E315B405 (support_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article_tag ADD CONSTRAINT FK_919694F97294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_tag ADD CONSTRAINT FK_919694F9BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_user ADD CONSTRAINT FK_3DD151487294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_user ADD CONSTRAINT FK_3DD15148A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE campaign_user ADD CONSTRAINT FK_8C74EDABF639F774 FOREIGN KEY (campaign_id) REFERENCES campaign (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE campaign_user ADD CONSTRAINT FK_8C74EDABA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C315B405 FOREIGN KEY (support_id) REFERENCES support (id)');
        $this->addSql('ALTER TABLE commentary ADD CONSTRAINT FK_1CAC12CA7294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE `like` ADD CONSTRAINT FK_AC6340B3315B405 FOREIGN KEY (support_id) REFERENCES support (id)');
        $this->addSql('ALTER TABLE support ADD CONSTRAINT FK_8004EBA5F639F774 FOREIGN KEY (campaign_id) REFERENCES campaign (id)');
        $this->addSql('ALTER TABLE user_role ADD CONSTRAINT FK_2DE8C6A3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_role ADD CONSTRAINT FK_2DE8C6A3D60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE view ADD CONSTRAINT FK_FEFDAB8E315B405 FOREIGN KEY (support_id) REFERENCES support (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article_tag DROP FOREIGN KEY FK_919694F97294869C');
        $this->addSql('ALTER TABLE article_user DROP FOREIGN KEY FK_3DD151487294869C');
        $this->addSql('ALTER TABLE commentary DROP FOREIGN KEY FK_1CAC12CA7294869C');
        $this->addSql('ALTER TABLE campaign_user DROP FOREIGN KEY FK_8C74EDABF639F774');
        $this->addSql('ALTER TABLE support DROP FOREIGN KEY FK_8004EBA5F639F774');
        $this->addSql('ALTER TABLE user_role DROP FOREIGN KEY FK_2DE8C6A3D60322AC');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C315B405');
        $this->addSql('ALTER TABLE `like` DROP FOREIGN KEY FK_AC6340B3315B405');
        $this->addSql('ALTER TABLE view DROP FOREIGN KEY FK_FEFDAB8E315B405');
        $this->addSql('ALTER TABLE article_tag DROP FOREIGN KEY FK_919694F9BAD26311');
        $this->addSql('ALTER TABLE article_user DROP FOREIGN KEY FK_3DD15148A76ED395');
        $this->addSql('ALTER TABLE campaign_user DROP FOREIGN KEY FK_8C74EDABA76ED395');
        $this->addSql('ALTER TABLE user_role DROP FOREIGN KEY FK_2DE8C6A3A76ED395');
        $this->addSql('DROP TABLE agency');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE article_tag');
        $this->addSql('DROP TABLE article_user');
        $this->addSql('DROP TABLE audience_type');
        $this->addSql('DROP TABLE campaign');
        $this->addSql('DROP TABLE campaign_user');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE commentary');
        $this->addSql('DROP TABLE info_contact');
        $this->addSql('DROP TABLE `like`');
        $this->addSql('DROP TABLE performance');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE stats_ig');
        $this->addSql('DROP TABLE stats_tk');
        $this->addSql('DROP TABLE stats_tw');
        $this->addSql('DROP TABLE stats_yt');
        $this->addSql('DROP TABLE support');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_role');
        $this->addSql('DROP TABLE vente_ig');
        $this->addSql('DROP TABLE vente_tk');
        $this->addSql('DROP TABLE vente_tw');
        $this->addSql('DROP TABLE vente_yt');
        $this->addSql('DROP TABLE view');
    }
}
