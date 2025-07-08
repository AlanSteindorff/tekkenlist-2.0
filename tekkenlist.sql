-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30/06/2025 às 09:35
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `tekkenlist`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `alansteindorff_golpe`
--

CREATE TABLE `alansteindorff_golpe` (
  `golpe_id` int(11) NOT NULL,
  `personagem_id` int(11) NOT NULL,
  `golpe_nome` varchar(100) NOT NULL,
  `golpe_tipo` varchar(100) DEFAULT NULL,
  `golpe_qtdhit` varchar(20) DEFAULT NULL,
  `golpe_comando` varchar(255) NOT NULL,
  `golpe_hitlvl` varchar(100) DEFAULT NULL,
  `golpe_dano` int(11) DEFAULT NULL,
  `golpe_startf` varchar(10) DEFAULT NULL,
  `golpe_blockf` varchar(10) DEFAULT NULL,
  `golpe_hitf` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `alansteindorff_golpe`
--

INSERT INTO `alansteindorff_golpe` (`golpe_id`, `personagem_id`, `golpe_nome`, `golpe_tipo`, `golpe_qtdhit`, `golpe_comando`, `golpe_hitlvl`, `golpe_dano`, `golpe_startf`, `golpe_blockf`, `golpe_hitf`) VALUES
(1, 14, 'heat burst', 'power crush', '1 hit', 'When Heat activation available, 2+3', 'mid[force crouch]', 12, '16F', '+1', '+2'),
(2, 14, 'Rumh al-Muzaffar', NULL, '3 hits', 'During Heat and Stealth Step,2+3', 'low[wall break]', 40, '20F', '-14', '0'),
(3, 14, 'Najm Alshamal', 'chip', '5 Hits', 'During Rage, df, 1+2', 'mid[power crush]', 55, '20F', '-15', '0'),
(4, 14, 'Spica', NULL, '2 hits', '1,2', 'high, high', 14, '10F', '-3', '+8'),
(5, 14, 'Spica Gut Punch', NULL, '3 hits', '1,2,2', 'high, high, mid', 31, '10F', '-11', '+3'),
(6, 14, 'Spica Blinding Sands', NULL, '3 hits', '1,2,3', 'high, high, high', 32, '10F', '-8', '+3'),
(7, 14, 'Spica Wheel Spin', 'tornado', '3 hits', '1,2,4', 'high, high, mid[tornado]', 34, '10F', '-13', '+33'),
(8, 14, 'Cut In', NULL, '2 hits', '2,1', 'high, mid', 17, '10F', '-4', '+2'),
(9, 14, 'Porrima Blinding Sands', NULL, '2 hits', '2,3', 'high, high', 23, '10F', '-8', '+3'),
(10, 14, 'Blinding Sands', NULL, '1 hit', '3', 'high', 18, '14F', '-8', '+3'),
(11, 14, 'Hallux Kick > Algenib', '', '2 hits', '4,1', 'high, high', 30, '13F', '-5', '+5'),
(12, 14, 'Hallux Kick > High Slashing Kick', NULL, '2 hits', '4,3', 'high, high[wall break]', 37, '13F', '-1', '+26'),
(13, 14, 'Hallux Kick > Ra\'d', NULL, '2 hits', '4,4', 'high, mid', 41, '13F', '-13', '+21'),
(14, 14, 'Silent Sting', 'tornado', '2 hits', 'f,2,3', 'high, high[tornado]', 33, '12F', '-12', '+2'),
(15, 14, 'Silent Flow', NULL, '3 hits', 'f,2,4,4', 'high, low, high[wall break]', 47, '12F', '-7', '+10'),
(16, 14, 'Crescent Moon', NULL, '1 hit', 'f,3', 'mid', 17, '20F', '-5', '+6'),
(17, 14, 'Piercing Talon', 'homing', '1 hit', 'f,4', 'high[wall break]', 24, '15F', '0', '+13'),
(18, 14, 'Skyline', NULL, '2 hits', 'f,3+4', 'mid, mid[force crouch]', 20, '22F', '+3', '+11'),
(19, 14, 'Rising Falcon', NULL, '1 hit', 'df,2', 'mid', 13, '15F', '-7', '+34'),
(20, 14, 'Whirlwind Kick', 'homing', '1 hit', 'df,3', 'mid[wall break]', 20, '17F', '-13', '+21'),
(21, 14, 'Al-Faras', NULL, '3 hits', 'df,4,1,3', 'mid, mid, mid[wall break]', 51, '14F', '-13', '+19'),
(22, 14, 'Al-Fard ak-Shuja', NULL, '2 hits', 'df,4,3', 'mid, high[wall break]', 36, '14F', '-4', '+23'),
(23, 14, 'Stealth Step', NULL, NULL, 'df,3+4', NULL, NULL, NULL, NULL, NULL),
(24, 14, 'Hermit Needle', '', '1 hit', 'd,1', 'low', 16, '20F', '-13', '+4'),
(25, 14, 'Gut Impact', NULL, '1 hit', 'd,2', 'mid', 15, '18F', '-6', '+8'),
(26, 14, 'Silent Rigel', NULL, '1 hit', 'd,3', 'low', 12, '16F', '-14', '0'),
(27, 14, 'Vicious Stomp', NULL, '1 hit', 'd,4', 'low', 10, '19F', '+1', '-12'),
(28, 14, 'Rapid Strikes', 'heat', '2 hits', 'db,2,1', 'mid, high[wall break]', 35, '14F', '-11', '+9'),
(29, 14, 'Snake\'s Bite > Rising Scimitar', 'tornado', '2 hits', 'db,3,4', 'low,high[tornado]', 32, '20F', '-13', '+68'),
(30, 14, 'Rising Scimitar', 'tornado', '1 hit', 'db,4', 'high[tornado]', 23, '20F', '-13', '+28'),
(31, 14, 'Shaula', '', '1 hit', 'db,1+2', 'unblockable mid', 40, '64F', '', '+42'),
(32, 14, 'Achernar', 'heat', '1 hit', 'b,1', 'mid[force crouch]', 20, '19F', '0', '+9'),
(33, 14, 'Dust Storm ', 'chip', '2 hits', 'b,2', 'mid[chip]', 30, '14F', '-9', '-2'),
(34, 14, 'Heel Strike', NULL, '1 hit', 'b,3', 'mid[force crouch]', 17, '19F', '+1', '+3'),
(35, 14, 'Broken Mirage', NULL, '1 hit', 'b,4', 'mid', 23, '17F', '-15', '+4'),
(36, 14, 'Elnath', 'power crush', '1 hit', 'b,3+4', 'high[wall break]', 25, '16F', '-9', '+19'),
(37, 14, 'Vega', 'heat', '1 hit', 'uf,1', 'mid[wall break]', 25, '24F', '+1', '+9'),
(38, 14, 'Crescent Cleaver', NULL, '1 hit', 'uf,3', 'mid', 22, '25F', '-7', '+24'),
(39, 14, 'Altair', NULL, '1 hit', 'uf,4', 'mid', 13, '15F', '-13', '+33'),
(40, 14, 'Delayed Rising Toe Kick', NULL, '1 hit', 'uf,n,4', 'mid', 20, '23F', '-13', '+32'),
(41, 14, 'Hunting Falcon Dive', 'tornado', '2 hits', 'f,f hold, 3', 'mid', 23, '17F', '-12', '+63'),
(42, 14, 'Hornet', 'chip, tornado', '2 hits', 'f,b,2', 'high[tornado]', 42, '14F', '-4', '0'),
(43, 14, 'Hornet', 'chip,tornado', '2 hits', 'f,b,2,(quick input)', 'high[tornado]', 42, '13F', '-4', '0'),
(44, 14, 'Antares', NULL, '1 hit', 'f,f,f hold,2', 'mid[wall break]', 30, '17F', '+5', '+13'),
(45, 14, 'Al-Ghul', 'tornado', '1 hit', 'd hold,(hold input),u,2', 'high[tornado]', 30, '18F', '+6', '+30'),
(46, 14, '10 Hit Combo', NULL, '10 hits', '2,1,4,1,3,3,3,3+4,4', 'high,mid,high,high,mid,mid[force crouch],low,mid,,mid,mid', 78, '10F', '-18', '+29'),
(47, 14, 'Ki Charge', NULL, NULL, '1+2+3+4', NULL, NULL, NULL, NULL, NULL),
(48, 14, 'Albireo', NULL, '1 hit', 'While Standing,1', 'mid', 17, '14F', '-2', '+4'),
(49, 14, 'hawk edge', NULL, '1 hit', 'while standing,2', 'mid', 21, '16F', '-17', '+57'),
(50, 14, 'Double Scorpion', 'tornado', '2 hits', 'While Standing,3,3', 'mid, mid[wall break]', 34, '13F', '-13', '+11'),
(51, 14, 'Jaw Smash', NULL, '1 hit', 'While Standing,4', 'mid', 16, '11F', '-6', '+5'),
(52, 14, 'Janbiya', NULL, '1 hit', 'Full Crouch,df,2', 'mid[wall break]', 21, '18F', '-9', '+17'),
(53, 14, 'Serpens', NULL, '2 hits', 'Full Crouch,df,4,1', 'low,high[wall break]', 36, '16F', '-2', '+24'),
(54, 14, 'Slide Step', NULL, NULL, 'Full Crouch,df,d,df hold', NULL, NULL, NULL, NULL, NULL),
(55, 14, 'Sand Storm', NULL, '1 hit', 'Full Crouch,df,d,df hold,3', 'low', 17, '16F', '-23', '+7'),
(56, 14, 'Nisf Kamar', NULL, '1 hit', 'During Sidestep,2', 'low[force crouch]', 14, '20F', '-12', '+1'),
(57, 14, 'Haboob', NULL, '1 hit', 'During Sidestep,1+2', 'mid', 23, '19F', '+3', '+22'),
(58, 14, 'Reverse Edge', '', '1 hit', 'Back facing opponent,2', 'mid', 20, '14F', '-3', '+42'),
(59, 14, 'Stealth Step', '', '', 'df,3+4,;etc.', '', 0, '', '', NULL),
(60, 14, 'Blinding Snake', NULL, '1 hit', 'During Stealth Step,1', 'high', 10, '12F', '-1', '+5'),
(61, 14, 'Crimson Tempest', NULL, '1 hit', 'During Stealth Step,2', 'mid', 17, '15', '-9', '+8'),
(62, 14, 'Hunting Falcon Dive', 'tornado', '2 hits', 'During Stealth Step,3', 'mid', 23, '20F', '-12', '+63'),
(63, 14, 'Sliding Shave', NULL, '1 hit', 'During Stealth Step,4', 'low[force crouch]', 20, '20F', '-14', '+3'),
(64, 14, 'Al-Sayf', 'heat', '1 hit', 'During Stealth Step,1+2', 'mid', 21, '19F', '+4', '+9'),
(65, 14, 'Flash Hornet', 'chip,tornado', '3 hits', 'During Stealth Step,df,1,2', 'mid, high[tornado]', 52, '15F', '-4', '0'),
(66, 14, 'Flash Deneb', 'heat', '2 hits', 'During Stealth Step,df,1,3', 'mid, mid[wall break]', 40, '15F', '-13', '+9'),
(67, 14, 'Desert Fang', 'homing', '', 'Approach opponent,1+3', 'high throw', 35, '12F', '', '0'),
(68, 14, 'Aldebaran', 'homing', '', 'Approach opponent,2+4', 'high throw[floor break]', 35, '12F', '', '0'),
(69, 14, 'Chasm Drop', 'homing', '', 'Approach opponent from left side,1+3,(or,2+4,)', 'high throw', 40, '12F', '', '0'),
(70, 14, 'Axel Spinner', 'chip,homing', NULL, 'Approach opponent from right side,1+3,(or,2+4,)', 'high throw [chip]', 40, '12F', NULL, '0'),
(71, 14, 'Silent Death', 'chip,homing', NULL, 'Approach opponent from behind,1+3,(or,2+4,)', 'high throw[chip]', 50, '12F', NULL, '0'),
(72, 14, 'Wezen', NULL, NULL, 'Approach opponent,df,1+2', 'high throw[floor break]', 40, '12F', NULL, '0'),
(73, 14, 'Silent Death Trap', 'chip', NULL, 'Time with opponent punch,b,1+3,(or,b,2+4,)', 'throw[chip]', 15, NULL, NULL, '0');

-- --------------------------------------------------------

--
-- Estrutura para tabela `alansteindorff_log`
--

CREATE TABLE `alansteindorff_log` (
  `log_id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `entrada` datetime DEFAULT NULL,
  `saida` varchar(30) DEFAULT NULL,
  `status` varchar(10) DEFAULT 'ativo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `alansteindorff_personagem`
--

CREATE TABLE `alansteindorff_personagem` (
  `personagem_id` int(11) NOT NULL,
  `personagem_nome` varchar(100) NOT NULL,
  `personagem_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `alansteindorff_personagem`
--

INSERT INTO `alansteindorff_personagem` (`personagem_id`, `personagem_nome`, `personagem_img`) VALUES
(1, 'Alisa Bosconovitch', 'alisa.png'),
(2, 'Anna Williams', 'tk8-fighter-dlc-5.webp'),
(3, 'Asuka Kazama', 'Asuka_Kazama_Tekken_8_Render.webp'),
(4, 'Azucena Ortiz', 'Azucena_Ortiz.webp'),
(5, 'Bryan Fury', 'Bryan_Fury_8.webp'),
(6, 'Claudio Serafino', 'claudio-serafino-character-art-lrg.webp'),
(7, 'Clive Rosfield', 'tk8-fighter-clive-rosfield-full@.5x.webp'),
(8, 'Devil Jin', 'Devil_Jin_29.webp'),
(9, 'Heihachi Mishima', 'Heihachi.webp'),
(10, 'Jin Kazama', 'jin-kazama-character-wall-art-sm.webp'),
(11, 'Kazuya Mishima', 'tekken8-kazuya-mishima-render-144591982.png'),
(12, 'Leroy Smith', 'Leroy_Smith_Tekken_8_Render.webp'),
(13, 'Lili Rochefort', 'Emilie_De_Rochefort_29.webp'),
(14, 'Shaheen', 'Shaheen-character-art-lrg.webp'),
(15, 'Victor Chevalier', 'victor-chevalier-fighter-800px.webp');

-- --------------------------------------------------------

--
-- Estrutura para tabela `alansteindorff_report`
--

CREATE TABLE `alansteindorff_report` (
  `id` int(11) NOT NULL,
  `golpe_id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `mensagem` text NOT NULL,
  `data_envio` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `alansteindorff_usuario`
--

CREATE TABLE `alansteindorff_usuario` (
  `usuario_id` int(11) NOT NULL,
  `usuario_nome` varchar(40) NOT NULL,
  `usuario_email` varchar(40) NOT NULL,
  `usuario_senha` varchar(255) NOT NULL,
  `usuario_nivelacesso` varchar(1) NOT NULL,
  `usuario_ativo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `alansteindorff_usuario`
--

INSERT INTO `alansteindorff_usuario` (`usuario_id`, `usuario_nome`, `usuario_email`, `usuario_senha`, `usuario_nivelacesso`, `usuario_ativo`) VALUES
(10, 'ADM', 'adm@gmail.com', '$2y$10$HdX9QBrZfqhkrj4iaMqNLOnkXZWdP/vL2nCXVpFZWAccUtNKxdhmG', '2', 1),
(11, 'alan', 'alan@gmail.com', '$2y$10$XsVRarZVj2M4kFVCbbfD8OsU2.Dh6d4IHikXOPqb9/BsJBqDy1piS', '0', 1),
(12, 'gerente', 'gerente@gmail.com', '$2y$10$qEmgowmYwivFJ6S7ecb1Zuh.AhI5M2DlXqSuYkxFLy2nhcVV8wNe6', '1', 1),
(13, 'arstrokezz', 'arstrokezz@gmail.com', '$2y$10$XbVmTtbpwoV8jaZhkg3YG.ZunIUIBzKyjwH7A0nTpyM/zgEJ9Sbi.', '0', 1),
(14, 'bad', 'bad@gmail.com', '$2y$10$bHkfhIeungkigDcT4IsY7.HhKHVA0EGY4L4Dp1U9YgxX9k4QBOL0.', '0', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `alansteindorff_golpe`
--
ALTER TABLE `alansteindorff_golpe`
  ADD PRIMARY KEY (`golpe_id`),
  ADD KEY `personagem_id` (`personagem_id`);

--
-- Índices de tabela `alansteindorff_log`
--
ALTER TABLE `alansteindorff_log`
  ADD PRIMARY KEY (`log_id`);

--
-- Índices de tabela `alansteindorff_personagem`
--
ALTER TABLE `alansteindorff_personagem`
  ADD PRIMARY KEY (`personagem_id`);

--
-- Índices de tabela `alansteindorff_report`
--
ALTER TABLE `alansteindorff_report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_golpe` (`golpe_id`),
  ADD KEY `fk_usuario` (`usuario_id`);

--
-- Índices de tabela `alansteindorff_usuario`
--
ALTER TABLE `alansteindorff_usuario`
  ADD PRIMARY KEY (`usuario_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `alansteindorff_golpe`
--
ALTER TABLE `alansteindorff_golpe`
  MODIFY `golpe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT de tabela `alansteindorff_log`
--
ALTER TABLE `alansteindorff_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `alansteindorff_personagem`
--
ALTER TABLE `alansteindorff_personagem`
  MODIFY `personagem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `alansteindorff_report`
--
ALTER TABLE `alansteindorff_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `alansteindorff_usuario`
--
ALTER TABLE `alansteindorff_usuario`
  MODIFY `usuario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `alansteindorff_golpe`
--
ALTER TABLE `alansteindorff_golpe`
  ADD CONSTRAINT `alansteindorff_golpe_ibfk_1` FOREIGN KEY (`personagem_id`) REFERENCES `alansteindorff_personagem` (`personagem_id`);

--
-- Restrições para tabelas `alansteindorff_report`
--
ALTER TABLE `alansteindorff_report`
  ADD CONSTRAINT `fk_golpe` FOREIGN KEY (`golpe_id`) REFERENCES `alansteindorff_golpe` (`golpe_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `alansteindorff_usuario` (`usuario_id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
