<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190204115137 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE funcionarios (id INT AUTO_INCREMENT NOT NULL, salario_id INT NOT NULL, secretaria_id INT NOT NULL, nome VARCHAR(255) NOT NULL, tipo SMALLINT NOT NULL, status SMALLINT NOT NULL, data_admissao DATE NOT NULL, data_exoneracao DATE DEFAULT NULL, UNIQUE INDEX UNIQ_10A0008937E4732E (salario_id), INDEX IDX_10A00089584CC12E (secretaria_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE secretarias (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE documentos (id INT AUTO_INCREMENT NOT NULL, funcionario_id INT DEFAULT NULL, imagem VARCHAR(255) NOT NULL, INDEX IDX_1EB82936642FEB76 (funcionario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE salarios (id INT AUTO_INCREMENT NOT NULL, salbase DOUBLE PRECISION NOT NULL, gratificacao DOUBLE PRECISION DEFAULT NULL, desconto DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuario (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_2265B05DE7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE funcionarios ADD CONSTRAINT FK_10A0008937E4732E FOREIGN KEY (salario_id) REFERENCES salarios (id)');
        $this->addSql('ALTER TABLE funcionarios ADD CONSTRAINT FK_10A00089584CC12E FOREIGN KEY (secretaria_id) REFERENCES secretarias (id)');
        $this->addSql('ALTER TABLE documentos ADD CONSTRAINT FK_1EB82936642FEB76 FOREIGN KEY (funcionario_id) REFERENCES funcionarios (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE documentos DROP FOREIGN KEY FK_1EB82936642FEB76');
        $this->addSql('ALTER TABLE funcionarios DROP FOREIGN KEY FK_10A00089584CC12E');
        $this->addSql('ALTER TABLE funcionarios DROP FOREIGN KEY FK_10A0008937E4732E');
        $this->addSql('DROP TABLE funcionarios');
        $this->addSql('DROP TABLE secretarias');
        $this->addSql('DROP TABLE documentos');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE salarios');
        $this->addSql('DROP TABLE usuario');
    }
}
