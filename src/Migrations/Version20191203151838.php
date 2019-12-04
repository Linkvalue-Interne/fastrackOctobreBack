<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191203151838 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE partner CHANGE customer customer VARCHAR(255) DEFAULT NULL, CHANGE project project VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE category CHANGE parent_id parent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE skills_categories DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE skills_categories ADD skill_id INT NOT NULL');
        $this->addSql('ALTER TABLE skills_categories ADD CONSTRAINT FK_FA9DB9A55585C142 FOREIGN KEY (skill_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE skills_categories ADD CONSTRAINT FK_FA9DB9A512469DE2 FOREIGN KEY (category_id) REFERENCES skill (id)');
        $this->addSql('CREATE INDEX IDX_FA9DB9A55585C142 ON skills_categories (skill_id)');
        $this->addSql('CREATE INDEX IDX_FA9DB9A512469DE2 ON skills_categories (category_id)');
        $this->addSql('ALTER TABLE skills_categories ADD PRIMARY KEY (skill_id, category_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE category CHANGE parent_id parent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE partner CHANGE customer customer VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE project project VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE skills_categories DROP FOREIGN KEY FK_FA9DB9A55585C142');
        $this->addSql('ALTER TABLE skills_categories DROP FOREIGN KEY FK_FA9DB9A512469DE2');
        $this->addSql('DROP INDEX IDX_FA9DB9A55585C142 ON skills_categories');
        $this->addSql('DROP INDEX IDX_FA9DB9A512469DE2 ON skills_categories');
        $this->addSql('ALTER TABLE skills_categories DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE skills_categories DROP skill_id');
        $this->addSql('ALTER TABLE skills_categories ADD PRIMARY KEY (category_id)');
    }
}
