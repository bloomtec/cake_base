-- phpMyAdmin SQL Dump
-- version 3.3.10.4
-- http://www.phpmyadmin.net
--
-- Host: mysql.bloomweb.co
-- Generation Time: Sep 25, 2011 at 10:47 AM
-- Server version: 5.1.53
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bloomweb_fpt`
--

-- --------------------------------------------------------

--
-- Table structure for table `acos`
--

CREATE TABLE IF NOT EXISTS `acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=507 ;

--
-- Dumping data for table `acos`
--

INSERT INTO `acos` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`) VALUES
(1, NULL, NULL, NULL, 'controllers', 1, 1012),
(2, 1, NULL, NULL, 'Pages', 2, 35),
(3, 2, NULL, NULL, 'home', 3, 4),
(4, 2, NULL, NULL, 'ftp', 5, 6),
(5, 2, NULL, NULL, 'index', 7, 8),
(6, 2, NULL, NULL, 'view', 9, 10),
(7, 2, NULL, NULL, 'add', 11, 12),
(8, 2, NULL, NULL, 'edit', 13, 14),
(9, 2, NULL, NULL, 'delete', 15, 16),
(10, 2, NULL, NULL, 'setInactive', 17, 18),
(11, 2, NULL, NULL, 'setActive', 19, 20),
(12, 2, NULL, NULL, 'admin_index', 21, 22),
(13, 2, NULL, NULL, 'admin_view', 23, 24),
(14, 2, NULL, NULL, 'admin_add', 25, 26),
(15, 2, NULL, NULL, 'admin_edit', 27, 28),
(16, 2, NULL, NULL, 'admin_delete', 29, 30),
(17, 2, NULL, NULL, 'admin_setInactive', 31, 32),
(18, 2, NULL, NULL, 'admin_setActive', 33, 34),
(19, 1, NULL, NULL, 'Friendships', 36, 69),
(20, 19, NULL, NULL, 'index', 37, 38),
(21, 19, NULL, NULL, 'view', 39, 40),
(22, 19, NULL, NULL, 'add', 41, 42),
(23, 19, NULL, NULL, 'edit', 43, 44),
(24, 19, NULL, NULL, 'delete', 45, 46),
(25, 19, NULL, NULL, 'setInactive', 47, 48),
(26, 19, NULL, NULL, 'setActive', 49, 50),
(27, 19, NULL, NULL, 'requestFind', 51, 52),
(28, 19, NULL, NULL, 'admin_index', 53, 54),
(29, 19, NULL, NULL, 'admin_view', 55, 56),
(30, 19, NULL, NULL, 'admin_add', 57, 58),
(31, 19, NULL, NULL, 'admin_edit', 59, 60),
(32, 19, NULL, NULL, 'admin_delete', 61, 62),
(33, 19, NULL, NULL, 'admin_setInactive', 63, 64),
(34, 19, NULL, NULL, 'admin_setActive', 65, 66),
(35, 19, NULL, NULL, 'admin_requestFind', 67, 68),
(36, 1, NULL, NULL, 'MenuItems', 70, 83),
(37, 36, NULL, NULL, 'getMenuItems', 71, 72),
(38, 36, NULL, NULL, 'admin_index', 73, 74),
(39, 36, NULL, NULL, 'admin_view', 75, 76),
(40, 36, NULL, NULL, 'admin_add', 77, 78),
(41, 36, NULL, NULL, 'admin_edit', 79, 80),
(42, 36, NULL, NULL, 'admin_delete', 81, 82),
(43, 1, NULL, NULL, 'Matches', 84, 117),
(44, 43, NULL, NULL, 'index', 85, 86),
(45, 43, NULL, NULL, 'view', 87, 88),
(46, 43, NULL, NULL, 'add', 89, 90),
(47, 43, NULL, NULL, 'edit', 91, 92),
(48, 43, NULL, NULL, 'delete', 93, 94),
(49, 43, NULL, NULL, 'setInactive', 95, 96),
(50, 43, NULL, NULL, 'setActive', 97, 98),
(51, 43, NULL, NULL, 'requestFind', 99, 100),
(52, 43, NULL, NULL, 'admin_index', 101, 102),
(53, 43, NULL, NULL, 'admin_view', 103, 104),
(54, 43, NULL, NULL, 'admin_add', 105, 106),
(55, 43, NULL, NULL, 'admin_edit', 107, 108),
(56, 43, NULL, NULL, 'admin_delete', 109, 110),
(57, 43, NULL, NULL, 'admin_setInactive', 111, 112),
(58, 43, NULL, NULL, 'admin_setActive', 113, 114),
(59, 43, NULL, NULL, 'admin_requestFind', 115, 116),
(60, 1, NULL, NULL, 'Roles', 118, 151),
(61, 60, NULL, NULL, 'index', 119, 120),
(62, 60, NULL, NULL, 'view', 121, 122),
(63, 60, NULL, NULL, 'add', 123, 124),
(64, 60, NULL, NULL, 'edit', 125, 126),
(65, 60, NULL, NULL, 'delete', 127, 128),
(66, 60, NULL, NULL, 'setInactive', 129, 130),
(67, 60, NULL, NULL, 'setActive', 131, 132),
(68, 60, NULL, NULL, 'requestFind', 133, 134),
(69, 60, NULL, NULL, 'admin_index', 135, 136),
(70, 60, NULL, NULL, 'admin_view', 137, 138),
(71, 60, NULL, NULL, 'admin_add', 139, 140),
(72, 60, NULL, NULL, 'admin_edit', 141, 142),
(73, 60, NULL, NULL, 'admin_delete', 143, 144),
(74, 60, NULL, NULL, 'admin_setInactive', 145, 146),
(75, 60, NULL, NULL, 'admin_setActive', 147, 148),
(76, 60, NULL, NULL, 'admin_requestFind', 149, 150),
(77, 1, NULL, NULL, 'MatchStatuses', 152, 185),
(78, 77, NULL, NULL, 'index', 153, 154),
(79, 77, NULL, NULL, 'view', 155, 156),
(80, 77, NULL, NULL, 'add', 157, 158),
(81, 77, NULL, NULL, 'edit', 159, 160),
(82, 77, NULL, NULL, 'delete', 161, 162),
(83, 77, NULL, NULL, 'setInactive', 163, 164),
(84, 77, NULL, NULL, 'setActive', 165, 166),
(85, 77, NULL, NULL, 'requestFind', 167, 168),
(86, 77, NULL, NULL, 'admin_index', 169, 170),
(87, 77, NULL, NULL, 'admin_view', 171, 172),
(88, 77, NULL, NULL, 'admin_add', 173, 174),
(89, 77, NULL, NULL, 'admin_edit', 175, 176),
(90, 77, NULL, NULL, 'admin_delete', 177, 178),
(91, 77, NULL, NULL, 'admin_setInactive', 179, 180),
(92, 77, NULL, NULL, 'admin_setActive', 181, 182),
(93, 77, NULL, NULL, 'admin_requestFind', 183, 184),
(94, 1, NULL, NULL, 'UserTeamStatuses', 186, 219),
(95, 94, NULL, NULL, 'index', 187, 188),
(96, 94, NULL, NULL, 'view', 189, 190),
(97, 94, NULL, NULL, 'add', 191, 192),
(98, 94, NULL, NULL, 'edit', 193, 194),
(99, 94, NULL, NULL, 'delete', 195, 196),
(100, 94, NULL, NULL, 'setInactive', 197, 198),
(101, 94, NULL, NULL, 'setActive', 199, 200),
(102, 94, NULL, NULL, 'requestFind', 201, 202),
(103, 94, NULL, NULL, 'admin_index', 203, 204),
(104, 94, NULL, NULL, 'admin_view', 205, 206),
(105, 94, NULL, NULL, 'admin_add', 207, 208),
(106, 94, NULL, NULL, 'admin_edit', 209, 210),
(107, 94, NULL, NULL, 'admin_delete', 211, 212),
(108, 94, NULL, NULL, 'admin_setInactive', 213, 214),
(109, 94, NULL, NULL, 'admin_setActive', 215, 216),
(110, 94, NULL, NULL, 'admin_requestFind', 217, 218),
(111, 1, NULL, NULL, 'Leagues', 220, 261),
(112, 111, NULL, NULL, 'getClubs', 221, 222),
(113, 111, NULL, NULL, 'getClubsInOption', 223, 224),
(114, 111, NULL, NULL, 'ajax_getClubs', 225, 226),
(115, 111, NULL, NULL, 'getList', 227, 228),
(116, 111, NULL, NULL, 'index', 229, 230),
(117, 111, NULL, NULL, 'view', 231, 232),
(118, 111, NULL, NULL, 'add', 233, 234),
(119, 111, NULL, NULL, 'edit', 235, 236),
(120, 111, NULL, NULL, 'delete', 237, 238),
(121, 111, NULL, NULL, 'setInactive', 239, 240),
(122, 111, NULL, NULL, 'setActive', 241, 242),
(123, 111, NULL, NULL, 'requestFind', 243, 244),
(124, 111, NULL, NULL, 'admin_index', 245, 246),
(125, 111, NULL, NULL, 'admin_view', 247, 248),
(126, 111, NULL, NULL, 'admin_add', 249, 250),
(127, 111, NULL, NULL, 'admin_edit', 251, 252),
(128, 111, NULL, NULL, 'admin_delete', 253, 254),
(129, 111, NULL, NULL, 'admin_setInactive', 255, 256),
(130, 111, NULL, NULL, 'admin_setActive', 257, 258),
(131, 111, NULL, NULL, 'admin_requestFind', 259, 260),
(132, 1, NULL, NULL, 'UsersMatches', 262, 301),
(133, 132, NULL, NULL, 'getUsers', 263, 264),
(134, 132, NULL, NULL, 'createMatch', 265, 266),
(135, 132, NULL, NULL, 'getInvites', 267, 268),
(136, 132, NULL, NULL, 'index', 269, 270),
(137, 132, NULL, NULL, 'view', 271, 272),
(138, 132, NULL, NULL, 'add', 273, 274),
(139, 132, NULL, NULL, 'edit', 275, 276),
(140, 132, NULL, NULL, 'delete', 277, 278),
(141, 132, NULL, NULL, 'setInactive', 279, 280),
(142, 132, NULL, NULL, 'setActive', 281, 282),
(143, 132, NULL, NULL, 'requestFind', 283, 284),
(144, 132, NULL, NULL, 'admin_index', 285, 286),
(145, 132, NULL, NULL, 'admin_view', 287, 288),
(146, 132, NULL, NULL, 'admin_add', 289, 290),
(147, 132, NULL, NULL, 'admin_edit', 291, 292),
(148, 132, NULL, NULL, 'admin_delete', 293, 294),
(149, 132, NULL, NULL, 'admin_setInactive', 295, 296),
(150, 132, NULL, NULL, 'admin_setActive', 297, 298),
(151, 132, NULL, NULL, 'admin_requestFind', 299, 300),
(152, 1, NULL, NULL, 'PublicMessages', 302, 335),
(153, 152, NULL, NULL, 'index', 303, 304),
(154, 152, NULL, NULL, 'view', 305, 306),
(155, 152, NULL, NULL, 'add', 307, 308),
(156, 152, NULL, NULL, 'edit', 309, 310),
(157, 152, NULL, NULL, 'delete', 311, 312),
(158, 152, NULL, NULL, 'setInactive', 313, 314),
(159, 152, NULL, NULL, 'setActive', 315, 316),
(160, 152, NULL, NULL, 'requestFind', 317, 318),
(161, 152, NULL, NULL, 'admin_index', 319, 320),
(162, 152, NULL, NULL, 'admin_view', 321, 322),
(163, 152, NULL, NULL, 'admin_add', 323, 324),
(164, 152, NULL, NULL, 'admin_edit', 325, 326),
(165, 152, NULL, NULL, 'admin_delete', 327, 328),
(166, 152, NULL, NULL, 'admin_setInactive', 329, 330),
(167, 152, NULL, NULL, 'admin_setActive', 331, 332),
(168, 152, NULL, NULL, 'admin_requestFind', 333, 334),
(169, 1, NULL, NULL, 'Teams', 336, 373),
(170, 169, NULL, NULL, 'search', 337, 338),
(171, 169, NULL, NULL, 'ajax_delete', 339, 340),
(172, 169, NULL, NULL, 'index', 341, 342),
(173, 169, NULL, NULL, 'view', 343, 344),
(174, 169, NULL, NULL, 'add', 345, 346),
(175, 169, NULL, NULL, 'edit', 347, 348),
(176, 169, NULL, NULL, 'delete', 349, 350),
(177, 169, NULL, NULL, 'setInactive', 351, 352),
(178, 169, NULL, NULL, 'setActive', 353, 354),
(179, 169, NULL, NULL, 'requestFind', 355, 356),
(180, 169, NULL, NULL, 'admin_index', 357, 358),
(181, 169, NULL, NULL, 'admin_view', 359, 360),
(182, 169, NULL, NULL, 'admin_add', 361, 362),
(183, 169, NULL, NULL, 'admin_edit', 363, 364),
(184, 169, NULL, NULL, 'admin_delete', 365, 366),
(185, 169, NULL, NULL, 'admin_setInactive', 367, 368),
(186, 169, NULL, NULL, 'admin_setActive', 369, 370),
(187, 169, NULL, NULL, 'admin_requestFind', 371, 372),
(188, 1, NULL, NULL, 'UsersTeams', 374, 417),
(189, 188, NULL, NULL, 'getPayroll', 375, 376),
(190, 188, NULL, NULL, 'createInviteToTeam', 377, 378),
(191, 188, NULL, NULL, 'createRequestToTeam', 379, 380),
(192, 188, NULL, NULL, 'ajax_addUserToTeam', 381, 382),
(193, 188, NULL, NULL, 'ajax_deleteUserFromTeam', 383, 384),
(194, 188, NULL, NULL, 'index', 385, 386),
(195, 188, NULL, NULL, 'view', 387, 388),
(196, 188, NULL, NULL, 'add', 389, 390),
(197, 188, NULL, NULL, 'edit', 391, 392),
(198, 188, NULL, NULL, 'delete', 393, 394),
(199, 188, NULL, NULL, 'setInactive', 395, 396),
(200, 188, NULL, NULL, 'setActive', 397, 398),
(201, 188, NULL, NULL, 'requestFind', 399, 400),
(202, 188, NULL, NULL, 'admin_index', 401, 402),
(203, 188, NULL, NULL, 'admin_view', 403, 404),
(204, 188, NULL, NULL, 'admin_add', 405, 406),
(205, 188, NULL, NULL, 'admin_edit', 407, 408),
(206, 188, NULL, NULL, 'admin_delete', 409, 410),
(207, 188, NULL, NULL, 'admin_setInactive', 411, 412),
(208, 188, NULL, NULL, 'admin_setActive', 413, 414),
(209, 188, NULL, NULL, 'admin_requestFind', 415, 416),
(210, 1, NULL, NULL, 'Foots', 418, 451),
(211, 210, NULL, NULL, 'index', 419, 420),
(212, 210, NULL, NULL, 'view', 421, 422),
(213, 210, NULL, NULL, 'add', 423, 424),
(214, 210, NULL, NULL, 'edit', 425, 426),
(215, 210, NULL, NULL, 'delete', 427, 428),
(216, 210, NULL, NULL, 'setInactive', 429, 430),
(217, 210, NULL, NULL, 'setActive', 431, 432),
(218, 210, NULL, NULL, 'requestFind', 433, 434),
(219, 210, NULL, NULL, 'admin_index', 435, 436),
(220, 210, NULL, NULL, 'admin_view', 437, 438),
(221, 210, NULL, NULL, 'admin_add', 439, 440),
(222, 210, NULL, NULL, 'admin_edit', 441, 442),
(223, 210, NULL, NULL, 'admin_delete', 443, 444),
(224, 210, NULL, NULL, 'admin_setInactive', 445, 446),
(225, 210, NULL, NULL, 'admin_setActive', 447, 448),
(226, 210, NULL, NULL, 'admin_requestFind', 449, 450),
(227, 1, NULL, NULL, 'Images', 452, 457),
(228, 227, NULL, NULL, 'resizeImage', 453, 454),
(229, 227, NULL, NULL, 'deleteImage', 455, 456),
(230, 1, NULL, NULL, 'ClubsUsers', 458, 493),
(231, 230, NULL, NULL, 'addUserToClub', 459, 460),
(232, 230, NULL, NULL, 'index', 461, 462),
(233, 230, NULL, NULL, 'view', 463, 464),
(234, 230, NULL, NULL, 'add', 465, 466),
(235, 230, NULL, NULL, 'edit', 467, 468),
(236, 230, NULL, NULL, 'delete', 469, 470),
(237, 230, NULL, NULL, 'setInactive', 471, 472),
(238, 230, NULL, NULL, 'setActive', 473, 474),
(239, 230, NULL, NULL, 'requestFind', 475, 476),
(240, 230, NULL, NULL, 'admin_index', 477, 478),
(241, 230, NULL, NULL, 'admin_view', 479, 480),
(242, 230, NULL, NULL, 'admin_add', 481, 482),
(243, 230, NULL, NULL, 'admin_edit', 483, 484),
(244, 230, NULL, NULL, 'admin_delete', 485, 486),
(245, 230, NULL, NULL, 'admin_setInactive', 487, 488),
(246, 230, NULL, NULL, 'admin_setActive', 489, 490),
(247, 230, NULL, NULL, 'admin_requestFind', 491, 492),
(248, 1, NULL, NULL, 'TeamNotifications', 494, 529),
(249, 248, NULL, NULL, 'getTeamNotifications', 495, 496),
(250, 248, NULL, NULL, 'index', 497, 498),
(251, 248, NULL, NULL, 'view', 499, 500),
(252, 248, NULL, NULL, 'add', 501, 502),
(253, 248, NULL, NULL, 'edit', 503, 504),
(254, 248, NULL, NULL, 'delete', 505, 506),
(255, 248, NULL, NULL, 'setInactive', 507, 508),
(256, 248, NULL, NULL, 'setActive', 509, 510),
(257, 248, NULL, NULL, 'requestFind', 511, 512),
(258, 248, NULL, NULL, 'admin_index', 513, 514),
(259, 248, NULL, NULL, 'admin_view', 515, 516),
(260, 248, NULL, NULL, 'admin_add', 517, 518),
(261, 248, NULL, NULL, 'admin_edit', 519, 520),
(262, 248, NULL, NULL, 'admin_delete', 521, 522),
(263, 248, NULL, NULL, 'admin_setInactive', 523, 524),
(264, 248, NULL, NULL, 'admin_setActive', 525, 526),
(265, 248, NULL, NULL, 'admin_requestFind', 527, 528),
(266, 1, NULL, NULL, 'Menus', 530, 543),
(267, 266, NULL, NULL, 'getMenu', 531, 532),
(268, 266, NULL, NULL, 'admin_index', 533, 534),
(269, 266, NULL, NULL, 'admin_view', 535, 536),
(270, 266, NULL, NULL, 'admin_add', 537, 538),
(271, 266, NULL, NULL, 'admin_edit', 539, 540),
(272, 266, NULL, NULL, 'admin_delete', 541, 542),
(273, 1, NULL, NULL, 'CountrySquads', 544, 579),
(274, 273, NULL, NULL, 'index', 545, 546),
(275, 273, NULL, NULL, 'getList', 547, 548),
(276, 273, NULL, NULL, 'view', 549, 550),
(277, 273, NULL, NULL, 'add', 551, 552),
(278, 273, NULL, NULL, 'edit', 553, 554),
(279, 273, NULL, NULL, 'delete', 555, 556),
(280, 273, NULL, NULL, 'setInactive', 557, 558),
(281, 273, NULL, NULL, 'setActive', 559, 560),
(282, 273, NULL, NULL, 'requestFind', 561, 562),
(283, 273, NULL, NULL, 'admin_index', 563, 564),
(284, 273, NULL, NULL, 'admin_view', 565, 566),
(285, 273, NULL, NULL, 'admin_add', 567, 568),
(286, 273, NULL, NULL, 'admin_edit', 569, 570),
(287, 273, NULL, NULL, 'admin_delete', 571, 572),
(288, 273, NULL, NULL, 'admin_setInactive', 573, 574),
(289, 273, NULL, NULL, 'admin_setActive', 575, 576),
(290, 273, NULL, NULL, 'admin_requestFind', 577, 578),
(291, 1, NULL, NULL, 'Feets', 580, 613),
(292, 291, NULL, NULL, 'index', 581, 582),
(293, 291, NULL, NULL, 'view', 583, 584),
(294, 291, NULL, NULL, 'add', 585, 586),
(295, 291, NULL, NULL, 'edit', 587, 588),
(296, 291, NULL, NULL, 'delete', 589, 590),
(297, 291, NULL, NULL, 'setInactive', 591, 592),
(298, 291, NULL, NULL, 'setActive', 593, 594),
(299, 291, NULL, NULL, 'requestFind', 595, 596),
(300, 291, NULL, NULL, 'admin_index', 597, 598),
(301, 291, NULL, NULL, 'admin_view', 599, 600),
(302, 291, NULL, NULL, 'admin_add', 601, 602),
(303, 291, NULL, NULL, 'admin_edit', 603, 604),
(304, 291, NULL, NULL, 'admin_delete', 605, 606),
(305, 291, NULL, NULL, 'admin_setInactive', 607, 608),
(306, 291, NULL, NULL, 'admin_setActive', 609, 610),
(307, 291, NULL, NULL, 'admin_requestFind', 611, 612),
(308, 1, NULL, NULL, 'UserFields', 614, 647),
(309, 308, NULL, NULL, 'index', 615, 616),
(310, 308, NULL, NULL, 'view', 617, 618),
(311, 308, NULL, NULL, 'add', 619, 620),
(312, 308, NULL, NULL, 'edit', 621, 622),
(313, 308, NULL, NULL, 'delete', 623, 624),
(314, 308, NULL, NULL, 'setInactive', 625, 626),
(315, 308, NULL, NULL, 'setActive', 627, 628),
(316, 308, NULL, NULL, 'requestFind', 629, 630),
(317, 308, NULL, NULL, 'admin_index', 631, 632),
(318, 308, NULL, NULL, 'admin_view', 633, 634),
(319, 308, NULL, NULL, 'admin_add', 635, 636),
(320, 308, NULL, NULL, 'admin_edit', 637, 638),
(321, 308, NULL, NULL, 'admin_delete', 639, 640),
(322, 308, NULL, NULL, 'admin_setInactive', 641, 642),
(323, 308, NULL, NULL, 'admin_setActive', 643, 644),
(324, 308, NULL, NULL, 'admin_requestFind', 645, 646),
(325, 1, NULL, NULL, 'ChallengeStatuses', 648, 681),
(326, 325, NULL, NULL, 'index', 649, 650),
(327, 325, NULL, NULL, 'view', 651, 652),
(328, 325, NULL, NULL, 'add', 653, 654),
(329, 325, NULL, NULL, 'edit', 655, 656),
(330, 325, NULL, NULL, 'delete', 657, 658),
(331, 325, NULL, NULL, 'setInactive', 659, 660),
(332, 325, NULL, NULL, 'setActive', 661, 662),
(333, 325, NULL, NULL, 'requestFind', 663, 664),
(334, 325, NULL, NULL, 'admin_index', 665, 666),
(335, 325, NULL, NULL, 'admin_view', 667, 668),
(336, 325, NULL, NULL, 'admin_add', 669, 670),
(337, 325, NULL, NULL, 'admin_edit', 671, 672),
(338, 325, NULL, NULL, 'admin_delete', 673, 674),
(339, 325, NULL, NULL, 'admin_setInactive', 675, 676),
(340, 325, NULL, NULL, 'admin_setActive', 677, 678),
(341, 325, NULL, NULL, 'admin_requestFind', 679, 680),
(342, 1, NULL, NULL, 'PrivateMessages', 682, 715),
(343, 342, NULL, NULL, 'index', 683, 684),
(344, 342, NULL, NULL, 'view', 685, 686),
(345, 342, NULL, NULL, 'add', 687, 688),
(346, 342, NULL, NULL, 'edit', 689, 690),
(347, 342, NULL, NULL, 'delete', 691, 692),
(348, 342, NULL, NULL, 'setInactive', 693, 694),
(349, 342, NULL, NULL, 'setActive', 695, 696),
(350, 342, NULL, NULL, 'requestFind', 697, 698),
(351, 342, NULL, NULL, 'admin_index', 699, 700),
(352, 342, NULL, NULL, 'admin_view', 701, 702),
(353, 342, NULL, NULL, 'admin_add', 703, 704),
(354, 342, NULL, NULL, 'admin_edit', 705, 706),
(355, 342, NULL, NULL, 'admin_delete', 707, 708),
(356, 342, NULL, NULL, 'admin_setInactive', 709, 710),
(357, 342, NULL, NULL, 'admin_setActive', 711, 712),
(358, 342, NULL, NULL, 'admin_requestFind', 713, 714),
(359, 1, NULL, NULL, 'UserNotifications', 716, 751),
(360, 359, NULL, NULL, 'getUserNotifications', 717, 718),
(361, 359, NULL, NULL, 'index', 719, 720),
(362, 359, NULL, NULL, 'view', 721, 722),
(363, 359, NULL, NULL, 'add', 723, 724),
(364, 359, NULL, NULL, 'edit', 725, 726),
(365, 359, NULL, NULL, 'delete', 727, 728),
(366, 359, NULL, NULL, 'setInactive', 729, 730),
(367, 359, NULL, NULL, 'setActive', 731, 732),
(368, 359, NULL, NULL, 'requestFind', 733, 734),
(369, 359, NULL, NULL, 'admin_index', 735, 736),
(370, 359, NULL, NULL, 'admin_view', 737, 738),
(371, 359, NULL, NULL, 'admin_add', 739, 740),
(372, 359, NULL, NULL, 'admin_edit', 741, 742),
(373, 359, NULL, NULL, 'admin_delete', 743, 744),
(374, 359, NULL, NULL, 'admin_setInactive', 745, 746),
(375, 359, NULL, NULL, 'admin_setActive', 747, 748),
(376, 359, NULL, NULL, 'admin_requestFind', 749, 750),
(377, 1, NULL, NULL, 'Tests', 752, 781),
(378, 377, NULL, NULL, 'index', 753, 754),
(379, 377, NULL, NULL, 'view', 755, 756),
(380, 377, NULL, NULL, 'add', 757, 758),
(381, 377, NULL, NULL, 'edit', 759, 760),
(382, 377, NULL, NULL, 'delete', 761, 762),
(383, 377, NULL, NULL, 'setInactive', 763, 764),
(384, 377, NULL, NULL, 'setActive', 765, 766),
(385, 377, NULL, NULL, 'admin_index', 767, 768),
(386, 377, NULL, NULL, 'admin_view', 769, 770),
(387, 377, NULL, NULL, 'admin_add', 771, 772),
(388, 377, NULL, NULL, 'admin_edit', 773, 774),
(389, 377, NULL, NULL, 'admin_delete', 775, 776),
(390, 377, NULL, NULL, 'admin_setInactive', 777, 778),
(391, 377, NULL, NULL, 'admin_setActive', 779, 780),
(392, 1, NULL, NULL, 'CountrySquadsUsers', 782, 817),
(393, 392, NULL, NULL, 'addUserToCountrySquad', 783, 784),
(394, 392, NULL, NULL, 'index', 785, 786),
(395, 392, NULL, NULL, 'view', 787, 788),
(396, 392, NULL, NULL, 'add', 789, 790),
(397, 392, NULL, NULL, 'edit', 791, 792),
(398, 392, NULL, NULL, 'delete', 793, 794),
(399, 392, NULL, NULL, 'setInactive', 795, 796),
(400, 392, NULL, NULL, 'setActive', 797, 798),
(401, 392, NULL, NULL, 'requestFind', 799, 800),
(402, 392, NULL, NULL, 'admin_index', 801, 802),
(403, 392, NULL, NULL, 'admin_view', 803, 804),
(404, 392, NULL, NULL, 'admin_add', 805, 806),
(405, 392, NULL, NULL, 'admin_edit', 807, 808),
(406, 392, NULL, NULL, 'admin_delete', 809, 810),
(407, 392, NULL, NULL, 'admin_setInactive', 811, 812),
(408, 392, NULL, NULL, 'admin_setActive', 813, 814),
(409, 392, NULL, NULL, 'admin_requestFind', 815, 816),
(410, 1, NULL, NULL, 'Clubs', 818, 851),
(411, 410, NULL, NULL, 'index', 819, 820),
(412, 410, NULL, NULL, 'view', 821, 822),
(413, 410, NULL, NULL, 'add', 823, 824),
(414, 410, NULL, NULL, 'edit', 825, 826),
(415, 410, NULL, NULL, 'delete', 827, 828),
(416, 410, NULL, NULL, 'setInactive', 829, 830),
(417, 410, NULL, NULL, 'setActive', 831, 832),
(418, 410, NULL, NULL, 'requestFind', 833, 834),
(419, 410, NULL, NULL, 'admin_index', 835, 836),
(420, 410, NULL, NULL, 'admin_view', 837, 838),
(421, 410, NULL, NULL, 'admin_add', 839, 840),
(422, 410, NULL, NULL, 'admin_edit', 841, 842),
(423, 410, NULL, NULL, 'admin_delete', 843, 844),
(424, 410, NULL, NULL, 'admin_setInactive', 845, 846),
(425, 410, NULL, NULL, 'admin_setActive', 847, 848),
(426, 410, NULL, NULL, 'admin_requestFind', 849, 850),
(427, 1, NULL, NULL, 'Users', 852, 897),
(428, 427, NULL, NULL, 'search', 853, 854),
(429, 427, NULL, NULL, 'login', 855, 856),
(430, 427, NULL, NULL, 'admin_login', 857, 858),
(431, 427, NULL, NULL, 'logout', 859, 860),
(432, 427, NULL, NULL, 'changePassword', 861, 862),
(433, 427, NULL, NULL, 'register', 863, 864),
(434, 427, NULL, NULL, 'index', 865, 866),
(435, 427, NULL, NULL, 'view', 867, 868),
(436, 427, NULL, NULL, 'add', 869, 870),
(437, 427, NULL, NULL, 'edit', 871, 872),
(438, 427, NULL, NULL, 'delete', 873, 874),
(439, 427, NULL, NULL, 'setInactive', 875, 876),
(440, 427, NULL, NULL, 'setActive', 877, 878),
(441, 427, NULL, NULL, 'requestFind', 879, 880),
(442, 427, NULL, NULL, 'admin_index', 881, 882),
(443, 427, NULL, NULL, 'admin_view', 883, 884),
(444, 427, NULL, NULL, 'admin_add', 885, 886),
(445, 427, NULL, NULL, 'admin_edit', 887, 888),
(446, 427, NULL, NULL, 'admin_delete', 889, 890),
(447, 427, NULL, NULL, 'admin_setInactive', 891, 892),
(448, 427, NULL, NULL, 'admin_setActive', 893, 894),
(449, 427, NULL, NULL, 'admin_requestFind', 895, 896),
(450, 1, NULL, NULL, 'Challenges', 898, 941),
(451, 450, NULL, NULL, 'getChallengerUsers', 899, 900),
(452, 450, NULL, NULL, 'getChallengedUsers', 901, 902),
(453, 450, NULL, NULL, 'getAllUsers', 903, 904),
(454, 450, NULL, NULL, 'createChallenge', 905, 906),
(455, 450, NULL, NULL, 'getInvites', 907, 908),
(456, 450, NULL, NULL, 'index', 909, 910),
(457, 450, NULL, NULL, 'view', 911, 912),
(458, 450, NULL, NULL, 'add', 913, 914),
(459, 450, NULL, NULL, 'edit', 915, 916),
(460, 450, NULL, NULL, 'delete', 917, 918),
(461, 450, NULL, NULL, 'setInactive', 919, 920),
(462, 450, NULL, NULL, 'setActive', 921, 922),
(463, 450, NULL, NULL, 'requestFind', 923, 924),
(464, 450, NULL, NULL, 'admin_index', 925, 926),
(465, 450, NULL, NULL, 'admin_view', 927, 928),
(466, 450, NULL, NULL, 'admin_add', 929, 930),
(467, 450, NULL, NULL, 'admin_edit', 931, 932),
(468, 450, NULL, NULL, 'admin_delete', 933, 934),
(469, 450, NULL, NULL, 'admin_setInactive', 935, 936),
(470, 450, NULL, NULL, 'admin_setActive', 937, 938),
(471, 450, NULL, NULL, 'admin_requestFind', 939, 940),
(472, 1, NULL, NULL, 'TeamStyles', 942, 975),
(473, 472, NULL, NULL, 'index', 943, 944),
(474, 472, NULL, NULL, 'view', 945, 946),
(475, 472, NULL, NULL, 'add', 947, 948),
(476, 472, NULL, NULL, 'edit', 949, 950),
(477, 472, NULL, NULL, 'delete', 951, 952),
(478, 472, NULL, NULL, 'setInactive', 953, 954),
(479, 472, NULL, NULL, 'setActive', 955, 956),
(480, 472, NULL, NULL, 'requestFind', 957, 958),
(481, 472, NULL, NULL, 'admin_index', 959, 960),
(482, 472, NULL, NULL, 'admin_view', 961, 962),
(483, 472, NULL, NULL, 'admin_add', 963, 964),
(484, 472, NULL, NULL, 'admin_edit', 965, 966),
(485, 472, NULL, NULL, 'admin_delete', 967, 968),
(486, 472, NULL, NULL, 'admin_setInactive', 969, 970),
(487, 472, NULL, NULL, 'admin_setActive', 971, 972),
(488, 472, NULL, NULL, 'admin_requestFind', 973, 974),
(489, 1, NULL, NULL, 'UserMatchStatuses', 976, 1009),
(490, 489, NULL, NULL, 'index', 977, 978),
(491, 489, NULL, NULL, 'view', 979, 980),
(492, 489, NULL, NULL, 'add', 981, 982),
(493, 489, NULL, NULL, 'edit', 983, 984),
(494, 489, NULL, NULL, 'delete', 985, 986),
(495, 489, NULL, NULL, 'setInactive', 987, 988),
(496, 489, NULL, NULL, 'setActive', 989, 990),
(497, 489, NULL, NULL, 'requestFind', 991, 992),
(498, 489, NULL, NULL, 'admin_index', 993, 994),
(499, 489, NULL, NULL, 'admin_view', 995, 996),
(500, 489, NULL, NULL, 'admin_add', 997, 998),
(501, 489, NULL, NULL, 'admin_edit', 999, 1000),
(502, 489, NULL, NULL, 'admin_delete', 1001, 1002),
(503, 489, NULL, NULL, 'admin_setInactive', 1003, 1004),
(504, 489, NULL, NULL, 'admin_setActive', 1005, 1006),
(505, 489, NULL, NULL, 'admin_requestFind', 1007, 1008),
(506, 1, NULL, NULL, 'AclExtras', 1010, 1011);

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE IF NOT EXISTS `ads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `content` text NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `ads`
--


-- --------------------------------------------------------

--
-- Table structure for table `aros`
--

CREATE TABLE IF NOT EXISTS `aros` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `aros`
--

INSERT INTO `aros` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`) VALUES
(1, NULL, NULL, NULL, 'Roles', 1, 6),
(2, 1, 'Role', 1, NULL, 2, 3),
(3, 1, 'Role', 2, NULL, 4, 5),
(4, NULL, 'User', 10, NULL, 7, 8),
(5, NULL, 'User', 11, NULL, 9, 10),
(6, NULL, 'User', 12, NULL, 11, 12),
(7, NULL, 'User', 13, NULL, 13, 14),
(8, NULL, 'User', 14, NULL, 15, 16),
(9, NULL, 'User', 15, NULL, 17, 18),
(10, NULL, 'User', 16, NULL, 19, 20),
(11, NULL, 'User', 17, NULL, 21, 22),
(12, NULL, 'User', 18, NULL, 23, 24),
(13, NULL, 'User', 19, NULL, 25, 26),
(14, NULL, 'User', 20, NULL, 27, 28),
(15, NULL, 'User', 21, NULL, 29, 30),
(16, NULL, 'User', 22, NULL, 31, 32),
(17, NULL, 'User', 23, NULL, 33, 34),
(18, NULL, 'User', 24, NULL, 35, 36),
(19, NULL, 'User', 25, NULL, 37, 38),
(20, NULL, 'User', 26, NULL, 39, 40);

-- --------------------------------------------------------

--
-- Table structure for table `aros_acos`
--

CREATE TABLE IF NOT EXISTS `aros_acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `aro_id` int(10) NOT NULL,
  `aco_id` int(10) NOT NULL,
  `_create` varchar(2) NOT NULL DEFAULT '0',
  `_read` varchar(2) NOT NULL DEFAULT '0',
  `_update` varchar(2) NOT NULL DEFAULT '0',
  `_delete` varchar(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ARO_ACO_KEY` (`aro_id`,`aco_id`),
  KEY `fk_aros_acos_aros_INDEX` (`aro_id`),
  KEY `fk_aros_acos_acos_INDEX` (`aco_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `aros_acos`
--

INSERT INTO `aros_acos` (`id`, `aro_id`, `aco_id`, `_create`, `_read`, `_update`, `_delete`) VALUES
(1, 2, 1, '1', '1', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `challenges`
--

CREATE TABLE IF NOT EXISTS `challenges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `challenge_status_id` int(11) NOT NULL,
  `team_challenger_id` int(11) NOT NULL,
  `team_challenged_id` int(11) NOT NULL,
  `user_challenger_id` int(11) NOT NULL,
  `user_decided_id` int(11) DEFAULT NULL,
  `date` datetime NOT NULL,
  `place` varchar(100) NOT NULL,
  `bet` varchar(45) DEFAULT NULL,
  `title` varchar(45) NOT NULL,
  `message` text,
  PRIMARY KEY (`id`),
  KEY `fk_challenges_challenges_status_INDEX` (`challenge_status_id`),
  KEY `fk_challenges_teams_1_INDEX` (`team_challenger_id`),
  KEY `fk_challenges_teams_2_INDEX` (`team_challenged_id`),
  KEY `fk_challenges_users_1_INDEX` (`user_challenger_id`),
  KEY `fk_challenges_users_2_INDEX` (`user_decided_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `challenges`
--


-- --------------------------------------------------------

--
-- Table structure for table `challenge_statuses`
--

CREATE TABLE IF NOT EXISTS `challenge_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `challenge_statuses`
--

INSERT INTO `challenge_statuses` (`id`, `name`, `description`) VALUES
(1, 'aceptado', NULL),
(2, 'rechazado', NULL),
(3, 'en_espera', NULL),
(4, 'concluido', NULL),
(5, 'cancelado', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `clubs`
--

CREATE TABLE IF NOT EXISTS `clubs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `league_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_clubs_leagues_INDEX` (`league_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `clubs`
--

INSERT INTO `clubs` (`id`, `league_id`, `name`, `image`) VALUES
(1, 1, 'Atletico Nacional', NULL),
(2, 1, 'Deportivo Cali', NULL),
(3, 1, 'America de Cali', NULL),
(4, 1, 'Independiente Medellin', NULL),
(5, 1, 'Millonarios', NULL),
(6, 2, 'Barcelona FC', NULL),
(7, 2, 'Real Madrid', NULL),
(8, 2, 'Atletico de Madrid', NULL),
(9, 2, 'Villareal', NULL),
(10, 2, 'Valencia', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `clubs_users`
--

CREATE TABLE IF NOT EXISTS `clubs_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `club_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_clubs_users_users_INDEX` (`user_id`),
  KEY `fk_clubs_users_clubs_INDEX` (`club_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `clubs_users`
--

INSERT INTO `clubs_users` (`id`, `club_id`, `user_id`) VALUES
(1, 3, 11),
(2, 6, 11),
(3, 1, 11),
(4, 3, 15),
(5, 6, 15),
(6, 3, 15),
(7, 6, 16),
(8, 2, 16),
(9, 1, 16),
(10, 3, 17),
(11, 7, 17),
(12, 3, 18),
(13, 8, 18),
(14, 7, 18),
(15, 3, 19),
(16, 7, 19),
(17, 7, 20),
(18, 8, 20),
(19, 7, 21),
(20, 3, 21),
(21, 3, 22),
(25, 2, 23),
(28, 2, 24),
(29, 7, 24),
(30, 1, 25);

-- --------------------------------------------------------

--
-- Table structure for table `country_squads`
--

CREATE TABLE IF NOT EXISTS `country_squads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `image` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `country_squads`
--

INSERT INTO `country_squads` (`id`, `name`, `image`) VALUES
(1, 'Colombia', NULL),
(2, 'Brasil', NULL),
(3, 'Argentina', NULL),
(4, 'Holanda', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `country_squads_users`
--

CREATE TABLE IF NOT EXISTS `country_squads_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_squad_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_country_squads_users_users_INDEX` (`user_id`),
  KEY `fk_country_squads_users_country_squads_INDEX` (`country_squad_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `country_squads_users`
--

INSERT INTO `country_squads_users` (`id`, `country_squad_id`, `user_id`) VALUES
(1, 1, 11),
(2, 2, 11),
(3, 3, 11),
(4, 1, 13),
(5, 1, 14),
(6, 2, 14),
(7, 3, 14),
(8, 1, 15),
(9, 1, 15),
(10, 1, 15),
(11, 1, 16),
(12, 2, 16),
(13, 3, 16),
(14, 1, 17),
(15, 2, 17),
(16, 3, 17),
(17, 1, 18),
(18, 2, 18),
(19, 4, 18),
(20, 1, 19),
(21, 1, 20),
(22, 2, 20),
(23, 1, 21),
(24, 1, 22),
(29, 1, 23),
(30, 4, 23),
(32, 2, 24),
(33, 1, 25),
(34, 2, 25),
(35, 4, 25);

-- --------------------------------------------------------

--
-- Table structure for table `feet`
--

CREATE TABLE IF NOT EXISTS `feet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `image` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `feet`
--

INSERT INTO `feet` (`id`, `name`, `image`) VALUES
(1, 'Izquierdo', NULL),
(2, 'Derecho', NULL),
(3, 'Ambidiestro', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `friendships`
--

CREATE TABLE IF NOT EXISTS `friendships` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_a_id` int(11) NOT NULL,
  `user_b_id` int(11) NOT NULL,
  `is_accepted` tinyint(1) NOT NULL DEFAULT '0',
  `is_blocked` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_friendships_users_1_INDEX` (`user_a_id`),
  KEY `fk_friendships_users_2_INDEX` (`user_b_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='user_a invita, user_b acepta' AUTO_INCREMENT=4 ;

--
-- Dumping data for table `friendships`
--

INSERT INTO `friendships` (`id`, `user_a_id`, `user_b_id`, `is_accepted`, `is_blocked`, `created`, `updated`) VALUES
(1, 20, 18, 0, 0, '2011-09-23 09:17:01', '2011-09-23 09:17:01'),
(2, 20, 2, 0, 0, '2011-09-23 09:22:32', '2011-09-23 09:22:32'),
(3, 22, 18, 0, 0, '2011-09-23 10:54:27', '2011-09-23 10:54:27');

-- --------------------------------------------------------

--
-- Table structure for table `leagues`
--

CREATE TABLE IF NOT EXISTS `leagues` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `leagues`
--

INSERT INTO `leagues` (`id`, `name`, `image`) VALUES
(1, 'Liga Postobon', NULL),
(2, 'Liga BBVA', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `matches`
--

CREATE TABLE IF NOT EXISTS `matches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `match_status_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `date` datetime NOT NULL,
  `place` varchar(100) NOT NULL,
  `bet` varchar(45) DEFAULT NULL,
  `message` text,
  `user_creator_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_matches_match_status_INDEX` (`match_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `matches`
--


-- --------------------------------------------------------

--
-- Table structure for table `match_statuses`
--

CREATE TABLE IF NOT EXISTS `match_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `match_statuses`
--


-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `created`, `updated`) VALUES
(1, 'ez_cms', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE IF NOT EXISTS `menu_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `lft` int(11) DEFAULT NULL,
  `rght` int(11) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_menu_items_menu_INDEX` (`menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `menu_items`
--


-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `description` text,
  `keywords` text,
  `active` tinyint(1) DEFAULT NULL,
  `wysiwyg_content` longtext,
  `slug` varchar(45) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title_UNIQUE` (`title`),
  UNIQUE KEY `slug_UNIQUE` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `pages`
--


-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE IF NOT EXISTS `positions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `positions` varchar(45) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `positions`, `image`) VALUES
(1, 'Arquero', 'arquero.png'),
(2, 'Defensa', 'defensa.png'),
(3, 'Volante', 'volante.png'),
(4, 'Delantero', 'delantero.png');

-- --------------------------------------------------------

--
-- Table structure for table `private_messages`
--

CREATE TABLE IF NOT EXISTS `private_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `to_user_id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `subject` varchar(145) NOT NULL,
  `content` text NOT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_private_messages_users_1_INDEX` (`to_user_id`),
  KEY `fk_private_messages_users_2_INDEX` (`from_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `private_messages`
--

INSERT INTO `private_messages` (`id`, `to_user_id`, `from_user_id`, `subject`, `content`, `created`) VALUES
(1, 1, 2, 'a', 'asdf', '1982-06-09 00:00:00'),
(2, 2, 1, 'b', 'asdfa', '1983-06-09 00:00:00'),
(3, 3, 1, 'c', 'asf', '1984-06-09 00:00:00'),
(4, 1, 5, 'd', 'asdf', '1985-06-09 00:00:00'),
(5, 3, 4, 'e', 'asdf', '1986-06-09 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `public_messages`
--

CREATE TABLE IF NOT EXISTS `public_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `to_user_id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `subject` varchar(145) NOT NULL,
  `content` text NOT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_public_messages_users_1_INDEX` (`to_user_id`),
  KEY `fk_public_messages_users_2_INDEX` (`from_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `public_messages`
--

INSERT INTO `public_messages` (`id`, `to_user_id`, `from_user_id`, `subject`, `content`, `created`) VALUES
(1, 1, 2, 'Hola', 'asfda', '1982-06-09 00:00:00'),
(2, 2, 1, 'Que tal?', 'asfa', '1983-06-09 00:00:00'),
(3, 3, 1, 'bn o no?', 'asdfas', '1984-06-09 00:00:00'),
(4, 1, 5, 'estas?', 'dfa', '1985-06-09 00:00:00'),
(5, 3, 4, 'saludos', 'dfasdfa', '1986-06-09 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'Usuario');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE IF NOT EXISTS `teams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `team_style_id` int(11) NOT NULL,
  `name` varchar(145) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre_UNIQUE` (`name`),
  KEY `fk_teams_team_styles_INDEX` (`team_style_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `team_style_id`, `name`, `image`, `created`, `updated`) VALUES
(1, 1, 'FPT', NULL, NULL, NULL),
(2, 2, 'Bloom', NULL, NULL, NULL),
(3, 2, 'Gesta', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `team_notifications`
--

CREATE TABLE IF NOT EXISTS `team_notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `team_id` int(11) NOT NULL,
  `player_id` int(11) DEFAULT NULL,
  `other_team_id` int(11) DEFAULT NULL,
  `match_id` int(11) DEFAULT NULL,
  `subject` varchar(145) NOT NULL,
  `content` text NOT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_team_notifications_teams_1_INDEX` (`team_id`),
  KEY `fk_team_notifications_users_INDEX` (`player_id`),
  KEY `fk_team_notifications_teams_2_INDEX` (`other_team_id`),
  KEY `fk_team_notifications_matches_INDEX` (`match_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `team_notifications`
--


-- --------------------------------------------------------

--
-- Table structure for table `team_styles`
--

CREATE TABLE IF NOT EXISTS `team_styles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `team_styles`
--

INSERT INTO `team_styles` (`id`, `name`) VALUES
(1, 'Futbol 11'),
(2, 'Futbol 6');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `fk_users_roles_INDEX` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `role_id`, `created`, `updated`) VALUES
(1, 'juliodominguez@gmail.com', 'b92e5e088048b068100a08ba77403ef54cb340cc', 1, NULL, NULL),
(2, 'ricardopandales@gmail.com', 'b92e5e088048b068100a08ba77403ef54cb340cc', 2, NULL, NULL),
(3, 'juansebas07126@hotmail.com', 'b92e5e088048b068100a08ba77403ef54cb340cc', 2, NULL, NULL),
(4, 'antonio@gesta.com', 'b92e5e088048b068100a08ba77403ef54cb340cc', 2, NULL, NULL),
(5, 'andres@gesta.com', 'b92e5e088048b068100a08ba77403ef54cb340cc', 2, NULL, NULL),
(6, 'martin@futbolparatodos.co', 'b92e5e088048b068100a08ba77403ef54cb340cc', 2, NULL, NULL),
(7, 'jair@futbolparatodos.co', 'b92e5e088048b068100a08ba77403ef54cb340cc', 2, NULL, NULL),
(8, 'raul@gmail.com', 'b92e5e088048b068100a08ba77403ef54cb340cc', 2, NULL, NULL),
(9, 'lina@gesta.com', 'b92e5e088048b068100a08ba77403ef54cb340cc', 2, NULL, NULL),
(10, 'jairlenis@gmail.com', 'c2957c2f3aba98178166002db82402ce6e828752', 2, '2011-09-13 16:53:22', '2011-09-13 16:53:22'),
(11, 'neili_k@hotmail.com', '260ef40e96067c8e46753680ceca9afbbfe75b48', 2, '2011-09-14 07:35:24', '2011-09-14 07:35:24'),
(12, 'j.c.gamo@hotmail.com', '56e38a9667c1baf7f94387ecdd8480d1fff49b63', 2, '2011-09-14 07:41:38', '2011-09-14 07:41:38'),
(13, 'juliopo@gmail.com', 'fc2b5cf61adcfd169a758a18a08f30ec724f151d', 2, '2011-09-14 14:10:59', '2011-09-14 14:10:59'),
(14, 'natica_2_3@hotmail.com', '9d0b67c4ad4e68e776c8bda345c4e522cfa07e0d', 2, '2011-09-14 15:19:20', '2011-09-14 15:19:20'),
(15, 'frank_alx@hotmail.com', '9d7af064c4af63e3301dc9786a8b1fcaca28ba11', 2, '2011-09-15 11:36:53', '2011-09-15 11:36:53'),
(16, 'ma-duo@hotmail.com', 'f17a868f99c08792b63b4f91acd8f374e9a4730f', 2, '2011-09-16 11:21:29', '2011-09-16 11:21:29'),
(17, 'pipearango2@hotmail.com', 'ccd6401496b99899ccb57aa38cb470ae9a24c387', 2, '2011-09-18 11:06:48', '2011-09-18 11:06:48'),
(18, 'raulquinterod@hotmail.com', 'a65a7998ea0fde66d26ff72b8fa28102cd72f118', 2, '2011-09-23 08:29:32', '2011-09-23 08:29:32'),
(19, 'gabriel_munoz@live.com', 'af32e770e8385c877a151a33ff394d04817565bf', 2, '2011-09-23 08:31:45', '2011-09-23 08:31:45'),
(20, 'jala29@hotmail.com', 'c2957c2f3aba98178166002db82402ce6e828752', 2, '2011-09-23 09:15:47', '2011-09-23 09:15:47'),
(21, 'juan_cardonach@hotmail.com', 'e0d5b86907f2d74cc9b053e48778181e7737533c', 2, '2011-09-23 09:55:20', '2011-09-23 09:55:20'),
(22, 'mcaviedes89@hotmail.com', 'f2d25381f108a30bbbcbd0ecf0f30886d0e2d7c7', 2, '2011-09-23 10:35:43', '2011-09-23 10:35:43'),
(23, 'lau_esguerra@hotmail.com', '714305e118a52c23a50bb31282eb6d154e1ed178', 2, '2011-09-23 10:44:26', '2011-09-23 10:47:42'),
(24, 'l_sarria064@hotmail.com', '045626f349a6786af1e89951375bbf9b864c102e', 2, '2011-09-23 20:51:37', '2011-09-23 20:57:28'),
(25, 'anak898@hotmail.com', '1e606f77a263cd1d889ad389aa9365c6a9d453e6', 2, '2011-09-24 13:10:24', '2011-09-24 13:10:24'),
(26, 'mariale113@hotmail.com', '322eadf42f3019974347a9b45558f5d5b3825cbe', 2, '2011-09-25 09:47:07', '2011-09-25 09:47:07');

-- --------------------------------------------------------

--
-- Table structure for table `users_matches`
--

CREATE TABLE IF NOT EXISTS `users_matches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `match_id` int(11) NOT NULL,
  `user_match_status_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_users_matches_matches_INDEX` (`match_id`),
  KEY `fk_users_matches_users_INDEX` (`user_id`),
  KEY `fk_users_matches_user_match_statuses_INDEX` (`user_match_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `users_matches`
--


-- --------------------------------------------------------

--
-- Table structure for table `users_teams`
--

CREATE TABLE IF NOT EXISTS `users_teams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `is_captain` tinyint(1) NOT NULL DEFAULT '0',
  `user_team_status_id` int(11) NOT NULL,
  `caller_user_id` int(11) DEFAULT NULL COMMENT 'si es nul el user_id solicito, sino es invitado por coller user',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_users_teams_teams_INDEX` (`team_id`),
  KEY `fk_users_teams_users_1_INDEX` (`user_id`),
  KEY `fk_users_teams_user_team_status_INDEX` (`user_team_status_id`),
  KEY `fk_users_teams_users_2_INDEX` (`caller_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `users_teams`
--

INSERT INTO `users_teams` (`id`, `user_id`, `team_id`, `is_captain`, `user_team_status_id`, `caller_user_id`, `created`, `updated`) VALUES
(1, 1, 2, 0, 1, NULL, NULL, NULL),
(2, 2, 2, 0, 2, 1, NULL, NULL),
(3, 3, 2, 0, 3, NULL, NULL, NULL),
(4, 4, 3, 0, 1, NULL, NULL, NULL),
(5, 5, 3, 0, 4, NULL, NULL, NULL),
(6, 6, 1, 0, 1, NULL, NULL, NULL),
(7, 7, 1, 0, 1, NULL, NULL, NULL),
(8, 8, 1, 0, 1, NULL, NULL, NULL),
(9, 9, 3, 0, 2, NULL, NULL, NULL),
(10, 1, 1, 0, 1, NULL, NULL, NULL),
(11, 2, 1, 0, 1, NULL, NULL, NULL),
(12, 3, 1, 0, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_fields`
--

CREATE TABLE IF NOT EXISTS `user_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `birthday` date NOT NULL,
  `gender` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL,
  `foot_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_fields_feet_INDEX` (`foot_id`),
  KEY `fk_user_fields_users_INDEX` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `user_fields`
--

INSERT INTO `user_fields` (`id`, `user_id`, `name`, `surname`, `birthday`, `gender`, `image`, `foot_id`, `created`, `updated`) VALUES
(1, 1, 'Julio', 'Dominguez', '1982-06-09', 'm', 'arquero.png', 2, NULL, NULL),
(2, 2, 'Ricardo', 'Pandales', '1987-06-09', 'm', 'defensa.png', 2, NULL, NULL),
(3, 3, 'Juan', 'Aparicio', '1988-06-09', 'm', 'volante.png', 1, NULL, NULL),
(4, 4, 'Antonio', 'Ramirez', '1984-06-09', 'm', 'delantero.png', 2, NULL, NULL),
(5, 5, 'Andres', 'Hurtado', '1978-06-09', 'm', 'arquero.png', 1, NULL, NULL),
(6, 6, 'Martin', 'Duran', '1990-06-09', 'm', 'defensa.png', 3, NULL, NULL),
(7, 7, 'Jair', 'Lenis', '1991-06-09', 'm', 'volante.png', 2, NULL, NULL),
(8, 9, 'Lina', 'Patiño', '1992-06-09', 'f', 'delantero.png', 2, NULL, NULL),
(9, 8, 'Raul', 'Quintero', '1980-06-09', 'm', 'arquero.png', 2, NULL, NULL),
(10, 10, 'Jair', 'Lenis', '1991-07-02', '', 'defaul-image-profile.jpg', 2, '2011-09-13 16:53:22', '2011-09-13 16:53:22'),
(11, 11, 'Carolina ', 'BermÃºdez', '1991-04-22', '', 'defaul-image-profile.jpg', 2, '2011-09-14 07:35:24', '2011-09-14 07:35:24'),
(12, 12, 'juan', 'gamo', '2000-01-01', '', 'defaul-image-profile.jpg', 2, '2011-09-14 07:41:38', '2011-09-14 07:41:38'),
(13, 13, 'Julio', 'Jaramillo', '1991-01-16', '', 'defaul-image-profile.jpg', 2, '2011-09-14 14:11:00', '2011-09-14 14:11:00'),
(14, 14, 'Natalia', 'Hidalgo', '1991-08-08', '', 'defaul-image-profile.jpg', 2, '2011-09-14 15:19:20', '2011-09-14 15:19:20'),
(15, 15, 'alexander', 'aguirre', '1993-01-08', '', '259754_1945048784544_1192244979_31889853_2267067_o', 2, '2011-09-15 11:36:54', '2011-09-15 11:36:54'),
(16, 16, 'Martin', 'Duran Ochoa', '1989-10-12', '', 'defaul-image-profile.jpg', 2, '2011-09-16 11:21:29', '2011-09-16 11:21:29'),
(17, 17, 'juan', 'arango', '1992-05-21', '', 'defaul-image-profile.jpg', 2, '2011-09-18 11:06:49', '2011-09-18 11:06:49'),
(18, 18, 'Raul', 'Quintero', '1990-06-26', 'm', '37340_10150198233210599_634175598_13363617_56182_n (1).jpg', 2, '2011-09-23 08:29:32', '2011-09-23 08:29:32'),
(19, 19, 'Gabriel', 'MuÃ±oz Arias', '1988-06-28', 'Masculino', 'defaul-image-profile.jpg', 2, '2011-09-23 08:31:45', '2011-09-23 08:31:45'),
(20, 20, 'Jair', 'Lenis', '2011-09-23', 'm', 'la foto.PNG', 2, '2011-09-23 09:15:47', '2011-09-23 09:15:47'),
(21, 21, 'Juan Pablo', 'Cardona Herrera', '1989-05-01', 'm', 'defaul-image-profile.jpg', 2, '2011-09-23 09:55:20', '2011-09-23 09:55:20'),
(22, 22, 'Mari', 'Caviedes', '1989-12-26', 'Femenino', 'jhjkh.jpg', 2, '2011-09-23 10:35:43', '2011-09-23 10:35:43'),
(23, 23, 'Laura Marcela', 'Esguerra Restrepo', '1988-09-04', 'Femenino', 'Yey!! P.jpg', 2, '2011-09-23 10:44:27', '2011-09-23 10:48:22'),
(24, 24, 'Lina ', 'Sarria Duarte', '1990-06-04', 'Femenino', 'defaul-image-profile.jpg', 2, '2011-09-23 20:51:37', '2011-09-23 20:51:37'),
(25, 25, 'ana camila', 'herrer', '1989-12-15', 'Femenino', 'defaul-image-profile.jpg', 2, '2011-09-24 13:10:25', '2011-09-24 13:10:25'),
(26, 26, 'Maria Alejandra', 'DurÃ¡n MelÃ©ndez', '2010-06-15', 'Femenino', 'defaul-image-profile.jpg', 2, '2011-09-25 09:47:08', '2011-09-25 09:47:08');

-- --------------------------------------------------------

--
-- Table structure for table `user_fields_positions`
--

CREATE TABLE IF NOT EXISTS `user_fields_positions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_field_id` int(11) DEFAULT NULL,
  `position_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_fields_positions_user_fields1_INDEX` (`user_field_id`),
  KEY `fk_user_fields_positions_positions1_INDEX` (`position_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `user_fields_positions`
--

INSERT INTO `user_fields_positions` (`id`, `user_field_id`, `position_id`) VALUES
(1, 18, 3),
(2, 19, 4),
(3, 20, 1),
(4, 21, 3),
(5, 22, 2),
(6, 23, 4),
(7, 24, 4),
(8, 25, 1),
(9, 26, 3);

-- --------------------------------------------------------

--
-- Table structure for table `user_match_statuses`
--

CREATE TABLE IF NOT EXISTS `user_match_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user_match_statuses`
--

INSERT INTO `user_match_statuses` (`id`, `name`, `description`) VALUES
(1, 'En Espera', NULL),
(2, 'Aceptado', NULL),
(3, 'Rechazado', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_notifications`
--

CREATE TABLE IF NOT EXISTS `user_notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `friend_id` int(11) DEFAULT NULL,
  `match_id` int(11) DEFAULT NULL,
  `team_id` int(11) DEFAULT NULL,
  `subject` varchar(150) NOT NULL,
  `content` text NOT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_notifications_users_1_INDEX` (`user_id`),
  KEY `fk_user_notifications_users_2_INDEX` (`friend_id`),
  KEY `fk_user_notifications_matches_INDEX` (`match_id`),
  KEY `fk_user_notifications_teams_INDEX` (`team_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `user_notifications`
--

INSERT INTO `user_notifications` (`id`, `user_id`, `friend_id`, `match_id`, `team_id`, `subject`, `content`, `created`) VALUES
(7, 18, 20, NULL, NULL, 'Solicitud de amistad de :: Jair Lenis', '<div class="notificacion-usuario"><a class="overlay" href="/friendships/viewFriendshipRequest/20/18/">Ver mÃ¡s</a></div>', '2011-09-23 09:17:01'),
(8, 2, 20, NULL, NULL, 'Solicitud de amistad de :: Jair Lenis', '<div class="notificacion-usuario"><a class="overlay" href="/friendships/viewFriendshipRequest/20/2/">Ver mÃ¡s</a></div>', '2011-09-23 09:22:32'),
(9, 18, 22, NULL, NULL, 'Solicitud de amistad de :: Mari Caviedes', '<div class="notificacion-usuario"><a class="overlay" href="/friendships/viewFriendshipRequest/22/18/Raul esta super esto">Ver mÃ¡s</a></div>', '2011-09-23 10:54:27');

-- --------------------------------------------------------

--
-- Table structure for table `user_team_statuses`
--

CREATE TABLE IF NOT EXISTS `user_team_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user_team_statuses`
--

INSERT INTO `user_team_statuses` (`id`, `name`, `description`, `created`, `updated`) VALUES
(1, 'En Espera', NULL, NULL, NULL),
(2, 'Aceptada', NULL, NULL, NULL),
(3, 'Rechazada', NULL, NULL, NULL),
(4, '', NULL, NULL, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aros_acos`
--
ALTER TABLE `aros_acos`
  ADD CONSTRAINT `fk_aros_acos_aros` FOREIGN KEY (`aro_id`) REFERENCES `aros` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_aros_acos_acos` FOREIGN KEY (`aco_id`) REFERENCES `acos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `challenges`
--
ALTER TABLE `challenges`
  ADD CONSTRAINT `fk_challenges_challenges_status` FOREIGN KEY (`challenge_status_id`) REFERENCES `challenge_statuses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_challenges_teams_1` FOREIGN KEY (`team_challenger_id`) REFERENCES `teams` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_challenges_teams_2` FOREIGN KEY (`team_challenged_id`) REFERENCES `leagues` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_challenges_users_1` FOREIGN KEY (`user_challenger_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_challenges_users_2` FOREIGN KEY (`user_decided_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `clubs`
--
ALTER TABLE `clubs`
  ADD CONSTRAINT `fk_clubs_leagues` FOREIGN KEY (`league_id`) REFERENCES `leagues` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `clubs_users`
--
ALTER TABLE `clubs_users`
  ADD CONSTRAINT `fk_clubs_has_users_clubs1` FOREIGN KEY (`club_id`) REFERENCES `clubs` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_clubs_has_users_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `country_squads_users`
--
ALTER TABLE `country_squads_users`
  ADD CONSTRAINT `fk_country_squads_users_country_squads` FOREIGN KEY (`country_squad_id`) REFERENCES `country_squads` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_country_squads_users_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `friendships`
--
ALTER TABLE `friendships`
  ADD CONSTRAINT `fk_friendships_users_1` FOREIGN KEY (`user_a_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_friendships_users_2` FOREIGN KEY (`user_b_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `matches`
--
ALTER TABLE `matches`
  ADD CONSTRAINT `fk_matches_match_status1` FOREIGN KEY (`match_status_id`) REFERENCES `match_statuses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD CONSTRAINT `fk_menu_items_menu` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `private_messages`
--
ALTER TABLE `private_messages`
  ADD CONSTRAINT `fk_private_messages_users_1` FOREIGN KEY (`to_user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_private_messages_users_2` FOREIGN KEY (`from_user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `public_messages`
--
ALTER TABLE `public_messages`
  ADD CONSTRAINT `fk_public_messages_users_1` FOREIGN KEY (`to_user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_public_messages_users_2` FOREIGN KEY (`from_user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `teams`
--
ALTER TABLE `teams`
  ADD CONSTRAINT `fk_teams_team_styles` FOREIGN KEY (`team_style_id`) REFERENCES `team_styles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `team_notifications`
--
ALTER TABLE `team_notifications`
  ADD CONSTRAINT `fk_team_notifications_teams_1` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_team_notifications_users` FOREIGN KEY (`player_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_team_notifications_teams_2` FOREIGN KEY (`other_team_id`) REFERENCES `teams` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_team_notifications_matches` FOREIGN KEY (`match_id`) REFERENCES `users_matches` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_roles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users_matches`
--
ALTER TABLE `users_matches`
  ADD CONSTRAINT `fk_users_matches_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_matches_matches` FOREIGN KEY (`match_id`) REFERENCES `matches` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_matches_user_match_statuses` FOREIGN KEY (`user_match_status_id`) REFERENCES `user_match_statuses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users_teams`
--
ALTER TABLE `users_teams`
  ADD CONSTRAINT `fk_users_teams_users_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_teams_user_team_statuses` FOREIGN KEY (`user_team_status_id`) REFERENCES `user_team_statuses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_teams_teams` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_teams_users_2` FOREIGN KEY (`caller_user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_fields`
--
ALTER TABLE `user_fields`
  ADD CONSTRAINT `fk_user_fields_feet` FOREIGN KEY (`foot_id`) REFERENCES `feet` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_fields_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_fields_positions`
--
ALTER TABLE `user_fields_positions`
  ADD CONSTRAINT `fk_user_fields_positions_user_fields1` FOREIGN KEY (`user_field_id`) REFERENCES `user_fields` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_fields_positions_positions1` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_notifications`
--
ALTER TABLE `user_notifications`
  ADD CONSTRAINT `fk_user_notifications_users_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_notifications_users_2` FOREIGN KEY (`friend_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_notifications_matches` FOREIGN KEY (`match_id`) REFERENCES `matches` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_notifications_teams` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
