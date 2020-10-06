<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201006115911 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE audience_type ADD less13 INT NOT NULL, ADD less17 INT NOT NULL, ADD less24 INT NOT NULL, ADD less34 INT NOT NULL, ADD less44 INT NOT NULL, ADD more45 INT NOT NULL');
        $this->addSql('ALTER TABLE performance MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE performance DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE performance CHANGE id id_user INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE performance ADD PRIMARY KEY (id_user)');
        $this->addSql('ALTER TABLE user ADD id_agency INT NOT NULL, ADD info_contact INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE audience_type DROP less13, DROP less17, DROP less24, DROP less34, DROP less44, DROP more45');
        $this->addSql('ALTER TABLE performance MODIFY id_user INT NOT NULL');
        $this->addSql('ALTER TABLE performance DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE performance CHANGE id_user id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE performance ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE user DROP id_agency, DROP info_contact');
    }
}
