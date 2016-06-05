
--
-- База данных: `joe_alone`
--

-- --------------------------------------------------------

--
-- Структура таблицы `chat`
--

CREATE TABLE IF NOT EXISTS `chat` (
  `msg_id` int(11) unsigned NOT NULL,
  `msg_date` int(11) unsigned NOT NULL DEFAULT '0',
  `msg_author` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `msg_color` varchar(7) COLLATE utf8_unicode_ci NOT NULL DEFAULT '000000',
  `msg_address` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `msg_canal` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `msg_clan_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `msg_text` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Чат архив';

--
-- Дамп данных таблицы `chat`
--

INSERT INTO `chat` (`msg_id`, `msg_date`, `msg_author`, `msg_color`, `msg_address`, `msg_canal`, `msg_clan_id`, `msg_text`) VALUES
(1, 0, 'Joe', '000000', '', 0, '', 'Тест');

-- --------------------------------------------------------

--
-- Структура таблицы `clan_main`
--

CREATE TABLE IF NOT EXISTS `clan_main` (
  `clan_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `clan_boss_id` int(11) unsigned NOT NULL DEFAULT '0',
  `clan_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Список кланов сервера';

--
-- Дамп данных таблицы `clan_main`
--

INSERT INTO `clan_main` (`clan_id`, `clan_boss_id`, `clan_name`) VALUES
('dt', 1, 'DreamTeam');

-- --------------------------------------------------------

--
-- Структура таблицы `player_auth_log`
--

CREATE TABLE IF NOT EXISTS `player_auth_log` (
  `uid` int(11) unsigned NOT NULL,
  `date` int(11) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1-успех, 2-ложпасс',
  `user_ip` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Лог авторизации пользователя';

--
-- Дамп данных таблицы `player_auth_log`
--

INSERT INTO `player_auth_log` (`uid`, `date`, `status`, `user_ip`) VALUES
(1, 0, 1, '127.0.0.1');

-- --------------------------------------------------------

--
-- Структура таблицы `player_info`
--

CREATE TABLE IF NOT EXISTS `player_info` (
  `uid` int(11) unsigned NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `birth_date` int(11) unsigned NOT NULL DEFAULT '0',
  `reg_date` int(11) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Информация о персонаже';

--
-- Дамп данных таблицы `player_info`
--

INSERT INTO `player_info` (`uid`, `name`, `birth_date`, `reg_date`) VALUES
(1, 'Владимир', 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `player_main`
--

CREATE TABLE IF NOT EXISTS `player_main` (
  `uid` int(11) unsigned NOT NULL,
  `login` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `passwd` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `banned` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `online` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `last_action` int(11) unsigned NOT NULL DEFAULT '0',
  `last_chat_id` int(11) unsigned NOT NULL DEFAULT '0',
  `money` decimal(17,2) NOT NULL DEFAULT '0.00',
  `dmoney` decimal(17,2) NOT NULL DEFAULT '0.00',
  `access` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `clan_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'not',
  `exp` int(11) unsigned NOT NULL DEFAULT '0',
  `soul` int(11) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Основная таблица персонажей';

--
-- Дамп данных таблицы `player_main`
--

INSERT INTO `player_main` (`uid`, `login`, `email`, `passwd`, `token`, `banned`, `online`, `last_action`, `last_chat_id`, `money`, `dmoney`, `access`, `clan_id`, `exp`, `soul`) VALUES
(1, 'Joe', 'joe@joe.com', '---', '---', 0, 1, 0, 291, '0.00', '0.00', 1, 'dt', 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `player_stats`
--

CREATE TABLE IF NOT EXISTS `player_stats` (
  `uid` int(11) unsigned NOT NULL,
  `level` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `hp` mediumint(6) unsigned NOT NULL DEFAULT '5',
  `mp` mediumint(6) unsigned NOT NULL DEFAULT '7',
  `ahp` mediumint(6) unsigned NOT NULL DEFAULT '5',
  `amp` mediumint(6) unsigned NOT NULL DEFAULT '7'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Характеристики персонажа';

--
-- Дамп данных таблицы `player_stats`
--

INSERT INTO `player_stats` (`uid`, `level`, `hp`, `mp`, `ahp`, `amp`) VALUES
(1, 100, 5, 7, 5, 7);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`msg_id`),
  ADD KEY `canal` (`msg_canal`),
  ADD KEY `clan_id` (`msg_clan_id`);

--
-- Индексы таблицы `clan_main`
--
ALTER TABLE `clan_main`
  ADD PRIMARY KEY (`clan_id`);

--
-- Индексы таблицы `player_auth_log`
--
ALTER TABLE `player_auth_log`
  ADD PRIMARY KEY (`uid`,`date`),
  ADD KEY `uid` (`uid`);

--
-- Индексы таблицы `player_info`
--
ALTER TABLE `player_info`
  ADD PRIMARY KEY (`uid`);

--
-- Индексы таблицы `player_main`
--
ALTER TABLE `player_main`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `token` (`token`),
  ADD KEY `online` (`online`),
  ADD KEY `clan_id` (`clan_id`);

--
-- Индексы таблицы `player_stats`
--
ALTER TABLE `player_stats`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `chat`
--
ALTER TABLE `chat`
  MODIFY `msg_id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `player_main`
--
ALTER TABLE `player_main`
  MODIFY `uid` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;

