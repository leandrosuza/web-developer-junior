CREATE TABLE `users` (
  `id` integer PRIMARY KEY NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) UNIQUE NOT NULL,
  `password` varchar(255) NOT NULL,
  `session_token` text,
  `created_at` datetime,
  `updated_at` datetime
);

CREATE TABLE `posts` (
  `id` integer PRIMARY KEY NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255),
  `description` text COMMENT 'HTML content',
  `user_id` integer NOT NULL,
  `created_at` datetime,
  `updated_at` datetime
);

ALTER TABLE `posts` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
