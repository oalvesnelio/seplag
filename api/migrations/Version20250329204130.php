<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250329204130 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Gerar tabelas de servidor efetivo e temporario.';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(
            'CREATE TABLE servidor_efetivo (
                se_matricula VARCHAR(20) NOT NULL,
                pes_id INT NOT NULL,
                PRIMARY KEY(pes_id)
            )'
        );
        $this->addSql(
            'CREATE TABLE servidor_temporario (
                st_data_admissao DATE NOT NULL,
                st_data_demissao DATE DEFAULT NULL,
                pes_id INT NOT NULL,
                PRIMARY KEY(pes_id)
            )'
        );
        $this->addSql(
            'ALTER TABLE servidor_efetivo
                ADD CONSTRAINT FK_C379765BB8470F
                FOREIGN KEY (pes_id)
                REFERENCES pessoa (pes_id)
                NOT DEFERRABLE INITIALLY IMMEDIATE
            '
        );
        $this->addSql(
            'ALTER TABLE servidor_temporario
                ADD CONSTRAINT FK_1CEAA245BB8470F
                FOREIGN KEY (pes_id)
                REFERENCES pessoa (pes_id)
                NOT DEFERRABLE INITIALLY IMMEDIATE
            '
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE servidor_efetivo DROP CONSTRAINT FK_C379765BB8470F');
        $this->addSql('ALTER TABLE servidor_temporario DROP CONSTRAINT FK_1CEAA245BB8470F');
        $this->addSql('DROP TABLE servidor_efetivo');
        $this->addSql('DROP TABLE servidor_temporario');
    }
}
