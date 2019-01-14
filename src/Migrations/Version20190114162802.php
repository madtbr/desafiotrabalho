<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190114162802 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE salarios (id INT AUTO_INCREMENT NOT NULL, salbase DOUBLE PRECISION NOT NULL, gratificacao DOUBLE PRECISION DEFAULT NULL, desconto DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE funcionarios ADD salario_id INT NOT NULL, ADD secretaria_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE funcionarios ADD CONSTRAINT FK_10A0008937E4732E FOREIGN KEY (salario_id) REFERENCES salarios (id)');
        $this->addSql('ALTER TABLE funcionarios ADD CONSTRAINT FK_10A00089584CC12E FOREIGN KEY (secretaria_id) REFERENCES secretarias (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_10A0008937E4732E ON funcionarios (salario_id)');
        $this->addSql('CREATE INDEX IDX_10A00089584CC12E ON funcionarios (secretaria_id)');
        $this->addSql('ALTER TABLE documentos ADD imagem_id INT DEFAULT NULL, DROP imagem');
        $this->addSql('ALTER TABLE documentos ADD CONSTRAINT FK_1EB8293664892549 FOREIGN KEY (imagem_id) REFERENCES funcionarios (id)');
        $this->addSql('CREATE INDEX IDX_1EB8293664892549 ON documentos (imagem_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE funcionarios DROP FOREIGN KEY FK_10A0008937E4732E');
        $this->addSql('DROP TABLE salarios');
        $this->addSql('ALTER TABLE documentos DROP FOREIGN KEY FK_1EB8293664892549');
        $this->addSql('DROP INDEX IDX_1EB8293664892549 ON documentos');
        $this->addSql('ALTER TABLE documentos ADD imagem LONGBLOB NOT NULL, DROP imagem_id');
        $this->addSql('ALTER TABLE funcionarios DROP FOREIGN KEY FK_10A00089584CC12E');
        $this->addSql('DROP INDEX UNIQ_10A0008937E4732E ON funcionarios');
        $this->addSql('DROP INDEX IDX_10A00089584CC12E ON funcionarios');
        $this->addSql('ALTER TABLE funcionarios DROP salario_id, DROP secretaria_id');
    }
}
