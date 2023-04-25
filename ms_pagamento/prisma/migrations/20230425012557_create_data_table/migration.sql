-- CreateTable
CREATE TABLE `notas` (
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `id_usuario` INTEGER NOT NULL,
    `total_itens` INTEGER NOT NULL,
    `valor` DECIMAL(10, 2) NOT NULL DEFAULT 0.00,

    PRIMARY KEY (`id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- CreateTable
CREATE TABLE `vendas` (
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `id_jogo` INTEGER NOT NULL,
    `id_nota` INTEGER NOT NULL,

    PRIMARY KEY (`id`)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- AddForeignKey
ALTER TABLE `vendas` ADD CONSTRAINT `vendas_id_nota_fkey` FOREIGN KEY (`id_nota`) REFERENCES `notas`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
