<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190130182118 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE documentos ADD funcionario_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE documentos ADD CONSTRAINT FK_1EB82936642FEB76 FOREIGN KEY (funcionario_id) REFERENCES funcionarios (id)');
        $this->addSql('CREATE INDEX IDX_1EB82936642FEB76 ON documentos (funcionario_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE documentos DROP FOREIGN KEY FK_1EB82936642FEB76');
        $this->addSql('DROP INDEX IDX_1EB82936642FEB76 ON documentos');
        $this->addSql('ALTER TABLE documentos DROP funcionario_id');
    }
}
