<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200115103654 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE partner (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, job VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phone_number VARCHAR(255) NOT NULL, experience INT NOT NULL, customer VARCHAR(255) DEFAULT NULL, project VARCHAR(255) DEFAULT NULL, avatar LONGTEXT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, is_active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE favorite_skill (partner_id INT NOT NULL, skill_id INT NOT NULL, INDEX IDX_E8B5CF539393F8FE (partner_id), INDEX IDX_E8B5CF535585C142 (skill_id), PRIMARY KEY(partner_id, skill_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skill (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, icon VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partner_skill (id INT AUTO_INCREMENT NOT NULL, skill_id INT DEFAULT NULL, partner_id INT DEFAULT NULL, level INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_4D0148125585C142 (skill_id), INDEX IDX_4D0148129393F8FE (partner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, parent_id INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skills_categories (category_id INT NOT NULL, skill_id INT NOT NULL, INDEX IDX_FA9DB9A512469DE2 (category_id), INDEX IDX_FA9DB9A55585C142 (skill_id), PRIMARY KEY(category_id, skill_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE favorite_skill ADD CONSTRAINT FK_E8B5CF539393F8FE FOREIGN KEY (partner_id) REFERENCES partner (id)');
        $this->addSql('ALTER TABLE favorite_skill ADD CONSTRAINT FK_E8B5CF535585C142 FOREIGN KEY (skill_id) REFERENCES skill (id)');
        $this->addSql('ALTER TABLE partner_skill ADD CONSTRAINT FK_4D0148125585C142 FOREIGN KEY (skill_id) REFERENCES skill (id)');
        $this->addSql('ALTER TABLE partner_skill ADD CONSTRAINT FK_4D0148129393F8FE FOREIGN KEY (partner_id) REFERENCES partner (id)');
        $this->addSql('ALTER TABLE skills_categories ADD CONSTRAINT FK_FA9DB9A512469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE skills_categories ADD CONSTRAINT FK_FA9DB9A55585C142 FOREIGN KEY (skill_id) REFERENCES skill (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE favorite_skill DROP FOREIGN KEY FK_E8B5CF539393F8FE');
        $this->addSql('ALTER TABLE partner_skill DROP FOREIGN KEY FK_4D0148129393F8FE');
        $this->addSql('ALTER TABLE favorite_skill DROP FOREIGN KEY FK_E8B5CF535585C142');
        $this->addSql('ALTER TABLE partner_skill DROP FOREIGN KEY FK_4D0148125585C142');
        $this->addSql('ALTER TABLE skills_categories DROP FOREIGN KEY FK_FA9DB9A55585C142');
        $this->addSql('ALTER TABLE skills_categories DROP FOREIGN KEY FK_FA9DB9A512469DE2');
        $this->addSql('DROP TABLE partner');
        $this->addSql('DROP TABLE favorite_skill');
        $this->addSql('DROP TABLE skill');
        $this->addSql('DROP TABLE partner_skill');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE skills_categories');
    }
}
