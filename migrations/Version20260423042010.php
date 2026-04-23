<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260423042010 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tasks DROP FOREIGN KEY UserID');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP INDEX UserID ON tasks');
        $this->addSql('ALTER TABLE tasks ADD date_completed DATETIME DEFAULT NULL, ADD due_date DATETIME DEFAULT NULL, DROP DateCompleted, DROP DueDate, CHANGE Description description VARCHAR(255) NOT NULL, CHANGE TaskName task_name VARCHAR(50) NOT NULL, CHANGE UserID user_id INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE users (UserID INT AUTO_INCREMENT NOT NULL, Username VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, PRIMARY KEY(UserID)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE tasks ADD DateCompleted DATETIME DEFAULT NULL, ADD DueDate DATETIME DEFAULT NULL, DROP date_completed, DROP due_date, CHANGE description Description VARCHAR(200) NOT NULL, CHANGE task_name TaskName VARCHAR(50) NOT NULL, CHANGE user_id UserID INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tasks ADD CONSTRAINT UserID FOREIGN KEY (UserID) REFERENCES users (UserID) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('CREATE INDEX UserID ON tasks (UserID)');
    }
}
