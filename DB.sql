SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE IF NOT EXISTS `va_categories` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `is_activated` int(1) NOT NULL DEFAULT '0',
  `order_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `va_comments` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `c_text` text NOT NULL,
  `author_id` int(11) DEFAULT NULL,
  `gallery_id` int(11) NOT NULL DEFAULT '0',
  `is_read` int(1) NOT NULL DEFAULT '0',
  `is_active` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `va_dont_like_galleries` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `dontlike_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `va_entrees` (
  `id` int(11) NOT NULL,
  `moderator_id` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `work_id` int(11) DEFAULT NULL,
  `description` text NOT NULL,
  `destination_date` date NOT NULL DEFAULT '0000-00-00',
  `is_waiting` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `va_forums` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `created` date NOT NULL,
  `created_time` time NOT NULL,
  `order_number` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `va_like_galleries` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `like_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `va_messages` (
  `id` int(11) NOT NULL,
  `m_from` int(11) DEFAULT NULL,
  `m_to` int(11) DEFAULT NULL,
  `title` text NOT NULL,
  `m_text` text NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `is_read` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `va_news` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `lead` text NOT NULL,
  `n_text` longtext NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `author_id` int(11) DEFAULT NULL,
  `source` text NOT NULL,
  `is_activated` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `va_news_comments` (
  `id` int(11) NOT NULL,
  `c_text` text NOT NULL,
  `author_id` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `news_id` int(11) DEFAULT NULL,
  `is_read` int(11) NOT NULL DEFAULT '0',
  `is_active` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `va_news_files` (
  `id` int(11) NOT NULL,
  `file_name` text NOT NULL,
  `news_id` int(11) DEFAULT NULL,
  `w` int(11) NOT NULL DEFAULT '0',
  `h` int(11) NOT NULL DEFAULT '0',
  `author_id` int(11) DEFAULT NULL,
  `date` date NOT NULL DEFAULT '0000-00-00',
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `va_new_works_in_like_galleries` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `work_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `va_posts` (
  `id` int(11) NOT NULL,
  `forum_id` int(11) DEFAULT NULL,
  `topic_id` int(11) DEFAULT NULL,
  `content` text NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created` date NOT NULL DEFAULT '0000-00-00',
  `created_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `va_register` (
  `id` int(11) NOT NULL,
  `moderator_id` int(11) DEFAULT NULL,
  `action` text NOT NULL,
  `description` text NOT NULL,
  `date` date NOT NULL DEFAULT '0000-00-00',
  `time` time NOT NULL DEFAULT '00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `va_topics` (
  `id` int(11) NOT NULL,
  `forum_id` int(11) DEFAULT NULL,
  `name` text NOT NULL,
  `content` text NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created` date NOT NULL DEFAULT '0000-00-00',
  `created_time` time NOT NULL,
  `is_closed` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `va_users` (
  `id` int(11) NOT NULL,
  `name` text,
  `surname` text,
  `email` varchar(250) NOT NULL DEFAULT '',
  `is_visible_email` int(1) NOT NULL DEFAULT '0',
  `username` text NOT NULL,
  `password` text NOT NULL,
  `description` text,
  `is_graphic_artist` int(1) NOT NULL DEFAULT '0',
  `works_limit` int(11) NOT NULL DEFAULT '6',
  `total_works_limit` int(11) NOT NULL DEFAULT '40',
  `blocked` tinyint(1) NOT NULL DEFAULT '0',
  `level` int(1) NOT NULL DEFAULT '0',
  `master_level` tinyint(1) NOT NULL DEFAULT '0',
  `is_avatar` int(1) NOT NULL DEFAULT '0',
  `is_photo` int(1) NOT NULL DEFAULT '0',
  `webpage` text,
  `gallery_views` int(11) NOT NULL DEFAULT '0',
  `is_activated` int(1) NOT NULL DEFAULT '1',
  `is_of_age` int(1) NOT NULL DEFAULT '0' COMMENT '0 brak wyboru 1 nie 2 tak',
  `last_visit` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `va_works` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `file_name` text NOT NULL,
  `w` int(11) NOT NULL DEFAULT '0',
  `h` int(11) NOT NULL DEFAULT '0',
  `w_m` int(11) NOT NULL DEFAULT '0',
  `h_m` int(11) NOT NULL DEFAULT '0',
  `w_sm` int(11) NOT NULL DEFAULT '0',
  `h_sm` int(11) NOT NULL DEFAULT '0',
  `title` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `gallery_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `date` date NOT NULL DEFAULT '0000-00-00',
  `time` time NOT NULL,
  `rate` float NOT NULL DEFAULT '0',
  `work_views` int(11) NOT NULL DEFAULT '0',
  `is_for_of_age` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `va_works_comments` (
  `id` int(11) NOT NULL,
  `c_text` text NOT NULL,
  `author_id` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `work_id` int(11) NOT NULL DEFAULT '0',
  `is_read` int(1) NOT NULL DEFAULT '0',
  `is_active` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `va_works_of_the_weeks` (
  `id` int(11) NOT NULL,
  `work_id` int(11) DEFAULT NULL,
  `week_id` int(11) DEFAULT NULL,
  `votes` int(11) NOT NULL DEFAULT '0',
  `voter_id` int(11) DEFAULT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `va_works_of_the_weeks_votes` (
  `id` int(11) NOT NULL,
  `work_id` int(11) DEFAULT NULL,
  `week_id` int(11) DEFAULT NULL,
  `votes` int(11) NOT NULL DEFAULT '0',
  `voter_id` int(11) DEFAULT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `va_works_of_the_weeks_weeks` (
  `id` int(11) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `va_categories`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `va_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_id_galerii` (`gallery_id`),
  ADD KEY `idx_szukanie` (`gallery_id`,`is_read`,`is_active`),
  ADD KEY `author_id` (`author_id`),
  ADD KEY `gallery_id` (`gallery_id`);

ALTER TABLE `va_dont_like_galleries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `dontlike_id` (`dontlike_id`);

ALTER TABLE `va_entrees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `moderator_id` (`moderator_id`),
  ADD KEY `work_id` (`work_id`);

ALTER TABLE `va_forums`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `va_like_galleries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `like_id` (`like_id`);

ALTER TABLE `va_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `idx_od_kogo_do_kogo` (`m_from`,`m_to`),
  ADD KEY `m_from` (`m_from`),
  ADD KEY `m_to` (`m_to`);

ALTER TABLE `va_news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`);

ALTER TABLE `va_news_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_id_news` (`news_id`),
  ADD KEY `author_id` (`author_id`),
  ADD KEY `news_id` (`news_id`);

ALTER TABLE `va_news_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_id` (`news_id`),
  ADD KEY `author_id` (`author_id`);

ALTER TABLE `va_new_works_in_like_galleries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `like_id` (`work_id`),
  ADD KEY `user_id` (`user_id`);

ALTER TABLE `va_posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `forum_id` (`forum_id`),
  ADD KEY `topic_id` (`topic_id`),
  ADD KEY `user_id` (`user_id`);

ALTER TABLE `va_register`
  ADD PRIMARY KEY (`id`),
  ADD KEY `moderator_id` (`moderator_id`);

ALTER TABLE `va_topics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `forum_id` (`forum_id`);

ALTER TABLE `va_users`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `va_works`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`);

ALTER TABLE `va_works_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_id_obrazka` (`work_id`),
  ADD KEY `idx_id_usera_id_obrazka` (`work_id`),
  ADD KEY `author_id` (`author_id`),
  ADD KEY `work_id` (`work_id`);

ALTER TABLE `va_works_of_the_weeks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `work_id` (`work_id`),
  ADD KEY `week_id` (`week_id`),
  ADD KEY `voter_id` (`voter_id`);

ALTER TABLE `va_works_of_the_weeks_votes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `work_id` (`work_id`),
  ADD KEY `week_id` (`week_id`),
  ADD KEY `voter_id` (`voter_id`);

ALTER TABLE `va_works_of_the_weeks_weeks`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `va_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `va_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `va_dont_like_galleries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `va_entrees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `va_forums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `va_like_galleries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `va_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `va_news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `va_news_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `va_news_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `va_new_works_in_like_galleries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `va_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `va_register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `va_topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `va_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `va_works`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `va_works_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `va_works_of_the_weeks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `va_works_of_the_weeks_votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `va_works_of_the_weeks_weeks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `va_comments`
  ADD CONSTRAINT `va_comments_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `va_users` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `va_comments_ibfk_2` FOREIGN KEY (`gallery_id`) REFERENCES `va_users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

ALTER TABLE `va_dont_like_galleries`
  ADD CONSTRAINT `va_dont_like_galleries_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `va_users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `va_dont_like_galleries_ibfk_2` FOREIGN KEY (`dontlike_id`) REFERENCES `va_users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

ALTER TABLE `va_entrees`
  ADD CONSTRAINT `va_entrees_ibfk_1` FOREIGN KEY (`moderator_id`) REFERENCES `va_users` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `va_entrees_ibfk_2` FOREIGN KEY (`work_id`) REFERENCES `va_works` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

ALTER TABLE `va_like_galleries`
  ADD CONSTRAINT `va_like_galleries_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `va_users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `va_like_galleries_ibfk_2` FOREIGN KEY (`like_id`) REFERENCES `va_users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

ALTER TABLE `va_messages`
  ADD CONSTRAINT `va_messages_ibfk_1` FOREIGN KEY (`m_from`) REFERENCES `va_users` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `va_messages_ibfk_2` FOREIGN KEY (`m_to`) REFERENCES `va_users` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;

ALTER TABLE `va_news`
  ADD CONSTRAINT `va_news_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `va_users` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;

ALTER TABLE `va_news_comments`
  ADD CONSTRAINT `va_news_comments_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `va_users` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `va_news_comments_ibfk_2` FOREIGN KEY (`news_id`) REFERENCES `va_news` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

ALTER TABLE `va_news_files`
  ADD CONSTRAINT `va_news_files_ibfk_1` FOREIGN KEY (`news_id`) REFERENCES `va_news` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `va_news_files_ibfk_2` FOREIGN KEY (`author_id`) REFERENCES `va_users` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;

ALTER TABLE `va_new_works_in_like_galleries`
  ADD CONSTRAINT `va_new_works_in_like_galleries_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `va_users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `va_new_works_in_like_galleries_ibfk_2` FOREIGN KEY (`work_id`) REFERENCES `va_works` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

ALTER TABLE `va_posts`
  ADD CONSTRAINT `va_posts_ibfk_1` FOREIGN KEY (`forum_id`) REFERENCES `va_forums` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `va_posts_ibfk_2` FOREIGN KEY (`topic_id`) REFERENCES `va_topics` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `va_posts_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `va_users` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;

ALTER TABLE `va_register`
  ADD CONSTRAINT `va_register_ibfk_1` FOREIGN KEY (`moderator_id`) REFERENCES `va_users` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;

ALTER TABLE `va_topics`
  ADD CONSTRAINT `va_topics_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `va_users` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `va_topics_ibfk_2` FOREIGN KEY (`forum_id`) REFERENCES `va_forums` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `va_works`
  ADD CONSTRAINT `va_works_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `va_users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `va_works_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `va_categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `va_works_comments`
  ADD CONSTRAINT `va_works_comments_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `va_users` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `va_works_comments_ibfk_2` FOREIGN KEY (`work_id`) REFERENCES `va_works` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

ALTER TABLE `va_works_of_the_weeks`
  ADD CONSTRAINT `va_works_of_the_weeks_ibfk_1` FOREIGN KEY (`work_id`) REFERENCES `va_works` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `va_works_of_the_weeks_ibfk_2` FOREIGN KEY (`week_id`) REFERENCES `va_works_of_the_weeks_weeks` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `va_works_of_the_weeks_ibfk_3` FOREIGN KEY (`voter_id`) REFERENCES `va_users` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
