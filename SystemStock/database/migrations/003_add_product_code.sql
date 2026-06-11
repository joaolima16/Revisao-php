ALTER TABLE products
    ADD COLUMN code_product CHAR(36) NULL;

UPDATE products
SET code_product = UUID()
WHERE code_product IS NULL;

ALTER TABLE products
    MODIFY COLUMN code_product CHAR(36) NOT NULL,
    ADD CONSTRAINT uq_products_code_product UNIQUE (code_product);
