<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180913175437 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE todo_item ADD CONSTRAINT FK_40CA43019D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE todo_item ADD CONSTRAINT FK_40CA43017E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_40CA43019D86650F ON todo_item (user_id_id)');
        $this->addSql('CREATE INDEX IDX_40CA43017E3C61F9 ON todo_item (owner_id)');
        $this->addSql('ALTER TABLE user ADD user_name VARCHAR(255) NOT NULL, DROP userName');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE todo_item DROP FOREIGN KEY FK_40CA43019D86650F');
        $this->addSql('ALTER TABLE todo_item DROP FOREIGN KEY FK_40CA43017E3C61F9');
        $this->addSql('DROP INDEX IDX_40CA43019D86650F ON todo_item');
        $this->addSql('DROP INDEX IDX_40CA43017E3C61F9 ON todo_item');
        $this->addSql('ALTER TABLE user ADD userName VARCHAR(255) DEFAULT \'\' NOT NULL COLLATE utf8mb4_unicode_ci, DROP user_name');
    }
}
