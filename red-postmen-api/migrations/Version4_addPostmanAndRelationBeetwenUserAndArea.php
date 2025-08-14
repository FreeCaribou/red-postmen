<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version4_addPostmanAndRelationBeetwenUserAndArea extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE postman (id SERIAL NOT NULL, name VARCHAR(100) NOT NULL, city VARCHAR(100) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE user_postman (user_id INT NOT NULL, postman_id INT NOT NULL, PRIMARY KEY(user_id, postman_id))');
        $this->addSql('CREATE INDEX IDX_1C674FCEA76ED395 ON user_postman (user_id)');
        $this->addSql('CREATE INDEX IDX_1C674FCEFE201FBB ON user_postman (postman_id)');
        $this->addSql('ALTER TABLE user_postman ADD CONSTRAINT FK_1C674FCEA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_postman ADD CONSTRAINT FK_1C674FCEFE201FBB FOREIGN KEY (postman_id) REFERENCES postman (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE area ADD postman_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE area ADD CONSTRAINT FK_D7943D68FE201FBB FOREIGN KEY (postman_id) REFERENCES postman (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_D7943D68FE201FBB ON area (postman_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE area DROP CONSTRAINT FK_D7943D68FE201FBB');
        $this->addSql('ALTER TABLE user_postman DROP CONSTRAINT FK_1C674FCEA76ED395');
        $this->addSql('ALTER TABLE user_postman DROP CONSTRAINT FK_1C674FCEFE201FBB');
        $this->addSql('DROP TABLE postman');
        $this->addSql('DROP TABLE user_postman');
        $this->addSql('DROP INDEX IDX_D7943D68FE201FBB');
        $this->addSql('ALTER TABLE area DROP postman_id');
    }
}
