<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201002115950 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE performance MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE performance DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE performance CHANGE id id_user INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE performance ADD PRIMARY KEY (id_user)');
        $this->addSql('ALTER TABLE user ADD info_contact INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE performance MODIFY id_user INT NOT NULL');
        $this->addSql('ALTER TABLE performance DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE performance CHANGE id_user id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE performance ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE user DROP info_contact');
    }
}
