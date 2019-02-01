<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190130182500 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE documentos DROP FOREIGN KEY FK_1EB8293664892549');
        $this->addSql('DROP INDEX IDX_1EB8293664892549 ON documentos');
        $this->addSql('ALTER TABLE documentos DROP imagem_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE documentos ADD imagem_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE documentos ADD CONSTRAINT FK_1EB8293664892549 FOREIGN KEY (imagem_id) REFERENCES funcionarios (id)');
        $this->addSql('CREATE INDEX IDX_1EB8293664892549 ON documentos (imagem_id)');
    }
}
