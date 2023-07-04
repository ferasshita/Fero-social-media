-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mar. 04 juil. 2023 à 14:48
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `wallstants`
--

-- --------------------------------------------------------

--
-- Structure de la table `answ_ques`
--

CREATE TABLE `answ_ques` (
  `ans_id` bigint(11) NOT NULL,
  `author_id` bigint(11) NOT NULL,
  `his_id` bigint(11) NOT NULL,
  `id` int(11) NOT NULL,
  `answer` varchar(100) NOT NULL,
  `story_id` bigint(11) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `block_m`
--

CREATE TABLE `block_m` (
  `id` int(11) NOT NULL,
  `my_id` bigint(11) NOT NULL,
  `blocken_id` bigint(11) NOT NULL,
  `ty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `buy`
--

CREATE TABLE `buy` (
  `id` int(11) NOT NULL,
  `author_id` bigint(11) NOT NULL,
  `accept` int(11) NOT NULL,
  `lat` varchar(100) DEFAULT NULL,
  `longi` varchar(100) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `post_id` bigint(11) NOT NULL,
  `quan` varchar(100) DEFAULT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `c_id` int(11) NOT NULL,
  `c_author` bigint(11) NOT NULL,
  `c_content` text NOT NULL,
  `c_edited` int(11) NOT NULL,
  `c_post_id` bigint(11) NOT NULL,
  `w_photo_v` varchar(100) NOT NULL,
  `c_time` int(11) NOT NULL,
  `c_time_edited` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `corona`
--

CREATE TABLE `corona` (
  `id` int(11) NOT NULL,
  `region` varchar(100) DEFAULT NULL,
  `ty_cas` varchar(100) DEFAULT NULL,
  `ty_dea` varchar(100) DEFAULT NULL,
  `ty_hea` varchar(100) DEFAULT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `follow`
--

CREATE TABLE `follow` (
  `id` int(11) NOT NULL,
  `uf_one` bigint(11) NOT NULL,
  `uf_two` bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `liker` bigint(11) NOT NULL,
  `post_id` bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `meesage_inser`
--

CREATE TABLE `meesage_inser` (
  `id` int(11) NOT NULL,
  `mi_from` bigint(11) NOT NULL,
  `mi_to` bigint(11) NOT NULL,
  `m_id` bigint(11) NOT NULL,
  `seen_from` int(11) NOT NULL,
  `seen_to` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `img` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `m_from` bigint(11) NOT NULL,
  `m_hide` int(11) NOT NULL,
  `m_id` bigint(11) NOT NULL,
  `m_like` int(11) NOT NULL,
  `m_seen` int(11) NOT NULL,
  `m_time` int(11) NOT NULL,
  `m_to` bigint(11) NOT NULL,
  `post_id` bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `mynotepad`
--

CREATE TABLE `mynotepad` (
  `id` int(11) NOT NULL,
  `author_id` bigint(11) NOT NULL,
  `main_id` bigint(11) NOT NULL,
  `note_content` text NOT NULL,
  `note_title` varchar(100) NOT NULL,
  `note_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `news_ab`
--

CREATE TABLE `news_ab` (
  `id` int(11) NOT NULL,
  `newsab_fi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `for_id` bigint(11) NOT NULL,
  `from_id` bigint(11) NOT NULL,
  `notifyType` varchar(100) NOT NULL,
  `notifyType_id` varchar(100) NOT NULL,
  `n_id` int(11) NOT NULL,
  `seen` int(11) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `out_in_words`
--

CREATE TABLE `out_in_words` (
  `id` int(11) NOT NULL,
  `for_au` bigint(11) NOT NULL,
  `in_word` varchar(100) NOT NULL,
  `out_word` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `polls`
--

CREATE TABLE `polls` (
  `id` int(11) NOT NULL,
  `no` varchar(100) NOT NULL,
  `poller` varchar(100) NOT NULL,
  `post_id` bigint(11) NOT NULL,
  `yes` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `postcom`
--

CREATE TABLE `postcom` (
  `id` int(11) NOT NULL,
  `link` varchar(100) NOT NULL,
  `linktext` varchar(100) NOT NULL,
  `post_id` bigint(11) NOT NULL,
  `p_content` text NOT NULL,
  `time` int(100) NOT NULL,
  `uimage` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `r_star`
--

CREATE TABLE `r_star` (
  `id` int(11) NOT NULL,
  `p_id` bigint(11) NOT NULL,
  `u_id` bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `saved`
--

CREATE TABLE `saved` (
  `id` int(11) NOT NULL,
  `main_id` bigint(11) NOT NULL,
  `post_id` bigint(11) NOT NULL,
  `saved_time` int(11) NOT NULL,
  `user_saved_id` bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `saved_story`
--

CREATE TABLE `saved_story` (
  `id` int(11) NOT NULL,
  `author_id` bigint(11) NOT NULL,
  `img_id` bigint(11) NOT NULL,
  `img_opacity` varchar(100) NOT NULL,
  `img_sty` varchar(100) NOT NULL,
  `saved_id` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `user_id` bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `signup`
--

CREATE TABLE `signup` (
  `id` int(11) NOT NULL,
  `main_id` bigint(11) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `accou_typ` varchar(100) NOT NULL,
  `addres1` varchar(100) DEFAULT NULL,
  `addres2` varchar(100) DEFAULT NULL,
  `admin` int(11) NOT NULL,
  `aSetup` int(11) NOT NULL,
  `bio` text NOT NULL,
  `birthday` varchar(100) DEFAULT NULL,
  `bussinesstypr` varchar(100) DEFAULT NULL,
  `bussiness_ty` varchar(100) DEFAULT NULL,
  `bussins_des` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `Email` varchar(100) NOT NULL,
  `em_pub` varchar(100) DEFAULT NULL,
  `followers` int(11) NOT NULL,
  `Fullname` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `language` varchar(100) NOT NULL,
  `lata` varchar(100) DEFAULT NULL,
  `longa` varchar(100) DEFAULT NULL,
  `login_attempts` int(11) NOT NULL,
  `mob_no1` varchar(100) DEFAULT NULL,
  `mob_no2` varchar(100) DEFAULT NULL,
  `online` int(11) NOT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `school` varchar(100) DEFAULT NULL,
  `Userphoto` varchar(100) DEFAULT NULL,
  `user_cover_photo` varchar(100) DEFAULT NULL,
  `verify` int(11) NOT NULL,
  `website` varchar(100) DEFAULT NULL,
  `work` varchar(100) DEFAULT NULL,
  `work0` varchar(100) DEFAULT NULL,
  `work_detail` varchar(100) DEFAULT NULL,
  `work_free` varchar(100) DEFAULT NULL,
  `work_price` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `story`
--

CREATE TABLE `story` (
  `id` int(11) NOT NULL,
  `author_id` bigint(11) NOT NULL,
  `aligf` varchar(100) DEFAULT NULL,
  `ch_co` varchar(100) DEFAULT NULL,
  `color` varchar(100) DEFAULT NULL,
  `img_opacity` varchar(100) DEFAULT NULL,
  `img_sty` varchar(100) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `mention` varchar(100) DEFAULT NULL,
  `no_poll` varchar(100) DEFAULT NULL,
  `op1` varchar(100) DEFAULT NULL,
  `op2` varchar(100) DEFAULT NULL,
  `op3` varchar(100) DEFAULT NULL,
  `poll_ques` varchar(100) DEFAULT NULL,
  `p_likes` varchar(100) DEFAULT NULL,
  `p_privacy` varchar(100) DEFAULT NULL,
  `p_write` varchar(100) DEFAULT NULL,
  `quesoe` varchar(100) DEFAULT NULL,
  `question` varchar(100) DEFAULT NULL,
  `shareauthor` varchar(100) DEFAULT NULL,
  `story_content` varchar(100) DEFAULT NULL,
  `story_id` bigint(11) NOT NULL,
  `story_img` varchar(100) DEFAULT NULL,
  `story_time` varchar(100) DEFAULT NULL,
  `time_ch` varchar(100) DEFAULT NULL,
  `time_fu` varchar(100) DEFAULT NULL,
  `title` int(11) DEFAULT NULL,
  `ye_poll` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `story_watch`
--

CREATE TABLE `story_watch` (
  `id` int(11) NOT NULL,
  `story_id` bigint(20) NOT NULL,
  `watcher_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `supportbox`
--

CREATE TABLE `supportbox` (
  `id` int(11) NOT NULL,
  `for_id` bigint(11) NOT NULL,
  `from_id` bigint(11) NOT NULL,
  `report` text NOT NULL,
  `r_id` int(11) NOT NULL,
  `r_replay` varchar(100) NOT NULL,
  `r_replay_time` int(11) NOT NULL,
  `r_time` int(11) NOT NULL,
  `r_type` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `subject` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `typing_m`
--

CREATE TABLE `typing_m` (
  `id` int(11) NOT NULL,
  `t_from` bigint(20) NOT NULL,
  `t_to` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `wpost`
--

CREATE TABLE `wpost` (
  `post_id` bigint(11) NOT NULL,
  `author_id` bigint(11) NOT NULL,
  `ch_co` varchar(100) DEFAULT NULL,
  `color` varchar(100) DEFAULT NULL,
  `dis_co` varchar(100) DEFAULT NULL,
  `font` varchar(100) DEFAULT NULL,
  `hea_wr` varchar(100) DEFAULT NULL,
  `hea_wrm` varchar(100) DEFAULT NULL,
  `imgtext` varchar(100) DEFAULT NULL,
  `img_opacity` varchar(100) DEFAULT NULL,
  `img_sty` varchar(100) DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `movie` varchar(100) DEFAULT NULL,
  `no_poll` varchar(100) DEFAULT NULL,
  `no_pull_nu` varchar(100) DEFAULT NULL,
  `op1` varchar(100) DEFAULT NULL,
  `op2` varchar(100) DEFAULT NULL,
  `op3` varchar(100) DEFAULT NULL,
  `phone_no` varchar(100) DEFAULT NULL,
  `photomov` varchar(100) DEFAULT NULL,
  `poll_ques` varchar(100) DEFAULT NULL,
  `post_content` text NOT NULL,
  `post_img` varchar(100) DEFAULT NULL,
  `post_time` int(11) NOT NULL,
  `pr_buss` varchar(100) NOT NULL,
  `p_likes` varchar(100) NOT NULL,
  `p_privacy` varchar(100) NOT NULL,
  `p_title` varchar(100) DEFAULT NULL,
  `p_write` text DEFAULT NULL,
  `question` varchar(100) DEFAULT NULL,
  `shared` varchar(100) DEFAULT NULL,
  `s_bt` varchar(100) DEFAULT NULL,
  `s_op` varchar(100) DEFAULT NULL,
  `s_wr` varchar(100) DEFAULT NULL,
  `w_photo_v` varchar(100) DEFAULT NULL,
  `ye_poll` varchar(100) DEFAULT NULL,
  `ye_poll_nu` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `answ_ques`
--
ALTER TABLE `answ_ques`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `block_m`
--
ALTER TABLE `block_m`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `buy`
--
ALTER TABLE `buy`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`c_id`);

--
-- Index pour la table `corona`
--
ALTER TABLE `corona`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `meesage_inser`
--
ALTER TABLE `meesage_inser`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `mynotepad`
--
ALTER TABLE `mynotepad`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `news_ab`
--
ALTER TABLE `news_ab`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `out_in_words`
--
ALTER TABLE `out_in_words`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `polls`
--
ALTER TABLE `polls`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `postcom`
--
ALTER TABLE `postcom`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `r_star`
--
ALTER TABLE `r_star`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `saved`
--
ALTER TABLE `saved`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `saved_story`
--
ALTER TABLE `saved_story`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `signup`
--
ALTER TABLE `signup`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `story`
--
ALTER TABLE `story`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `story_watch`
--
ALTER TABLE `story_watch`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `supportbox`
--
ALTER TABLE `supportbox`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `typing_m`
--
ALTER TABLE `typing_m`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `wpost`
--
ALTER TABLE `wpost`
  ADD PRIMARY KEY (`post_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `answ_ques`
--
ALTER TABLE `answ_ques`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `block_m`
--
ALTER TABLE `block_m`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `buy`
--
ALTER TABLE `buy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `corona`
--
ALTER TABLE `corona`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `follow`
--
ALTER TABLE `follow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `meesage_inser`
--
ALTER TABLE `meesage_inser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `mynotepad`
--
ALTER TABLE `mynotepad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `news_ab`
--
ALTER TABLE `news_ab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `out_in_words`
--
ALTER TABLE `out_in_words`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `polls`
--
ALTER TABLE `polls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `postcom`
--
ALTER TABLE `postcom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `r_star`
--
ALTER TABLE `r_star`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `saved`
--
ALTER TABLE `saved`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `saved_story`
--
ALTER TABLE `saved_story`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `signup`
--
ALTER TABLE `signup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `story`
--
ALTER TABLE `story`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `story_watch`
--
ALTER TABLE `story_watch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `supportbox`
--
ALTER TABLE `supportbox`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `typing_m`
--
ALTER TABLE `typing_m`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
