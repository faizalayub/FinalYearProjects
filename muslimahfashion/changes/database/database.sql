ALTER TABLE `user_cart` ADD `size` VARCHAR(255) NULL DEFAULT NULL AFTER `user`;

ALTER TABLE `user_order` ADD `size` TEXT NULL DEFAULT NULL AFTER `payer_name`;
