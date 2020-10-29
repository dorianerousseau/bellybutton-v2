<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201028130310 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE vente_ig (id INT AUTO_INCREMENT NOT NULL, cachet_post INT NOT NULL, marge_post INT NOT NULL, cachet_story INT NOT NULL, marge_story INT NOT NULL, cachet_igtv INT NOT NULL, marge_igtv INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vente_tk (id INT AUTO_INCREMENT NOT NULL, cachet_post INT NOT NULL, marge_post INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vente_tw (id INT AUTO_INCREMENT NOT NULL, cachet_pdp INT NOT NULL, marge_pdp INT NOT NULL, cachet_sponso INT NOT NULL, marge_sponso INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vente_yt (id INT AUTO_INCREMENT NOT NULL, garantie INT NOT NULL, estimation INT NOT NULL, cachet_inte INT NOT NULL, marge_inte INT NOT NULL, cachet_vid_de INT NOT NULL, marge_vid_de INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE performance ADD id_vente_yt INT DEFAULT NULL, ADD id_vente_tw INT NOT NULL, ADD id_vente_tk INT NOT NULL, ADD id_vente_ig INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE vente_ig');
        $this->addSql('DROP TABLE vente_tk');
        $this->addSql('DROP TABLE vente_tw');
        $this->addSql('DROP TABLE vente_yt');
        $this->addSql('ALTER TABLE performance DROP id_vente_yt, DROP id_vente_tw, DROP id_vente_tk, DROP id_vente_ig');
    }
}
