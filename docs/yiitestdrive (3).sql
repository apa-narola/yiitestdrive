-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 29, 2014 at 01:51 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `yiitestdrive`
--
CREATE DATABASE IF NOT EXISTS `yiitestdrive` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `yiitestdrive`;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `short_description` text COLLATE utf8_bin,
  `long_description` longtext COLLATE utf8_bin,
  `parent_id` int(11) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `slug`, `short_description`, `long_description`, `parent_id`, `created`, `modified`) VALUES
(1, 'Furniture', NULL, 'This is desc', 'this is long desc', 0, '2014-04-29 16:47:07', '2014-04-29 16:47:26'),
(2, 'Chair', NULL, 'Chair desc', 'Chair long desc', 3, '2014-04-29 16:48:05', '2014-04-29 18:07:37'),
(3, 'Clothes', NULL, 'desc ', 'test', 0, '2014-04-29 16:49:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_title` varchar(255) NOT NULL,
  `page_content` text NOT NULL,
  `menu_option` enum('headmenu','footmenu') NOT NULL,
  `sitemap_visibility` enum('yes','no') NOT NULL,
  `seo_title` varchar(255) NOT NULL,
  `focus_keywords` varchar(255) NOT NULL,
  `meta_desc` varchar(255) NOT NULL,
  `meta_url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `page_title`, `page_content`, `menu_option`, `sitemap_visibility`, `seo_title`, `focus_keywords`, `meta_desc`, `meta_url`) VALUES
(1, 'Page 1', '<p style="text-align: justify;">\r\n	But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete acco<em><strong>unt of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happines</strong></em>s.</p>\r\n<p style="text-align: justify;">\r\n	No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful.</p>\r\n<p style="text-align: justify;">\r\n	Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure.</p>\r\n<p style="text-align: justify;">\r\n	To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it?</p>\r\n<p style="text-align: justify;">\r\n	But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?</p>\r\n<p style="text-align: justify;">\r\n	On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee</p>\r\n', 'headmenu', 'no', 'narola infotech contact page', 'contact', 'This is the contact page of narola infotech ', 'narola/contact'),
(2, 'Page 2', '<p>\r\n	Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>\r\n<p>\r\n	Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>\r\n<p>\r\n	It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>\r\n<p>\r\n	Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.</p>\r\n<p>\r\n	The Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn&rsquo;t listen. She packed her seven versalia, put her initial into the belt and made herself on the way.</p>\r\n<p>\r\n	When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane. Pityful a rethoric question ran over her cheek, then</p>\r\n', 'headmenu', 'yes', 'narola infotech about page', 'contact, about', 'This is the narola infotech private limited''s about page', 'narola/about'),
(3, 'Page 3', '<p>\r\n	Li Europan lingues es membres del sam familie.</p>\r\n<p>\r\n	Lor separat existentie es un myth.</p>\r\n<p>\r\n	Por scientie, musica, sport etc, litot Europa usa li sam vocabular.</p>\r\n<p>\r\n	Li lingues differe solmen in li grammatica, li pro</p>\r\n', 'footmenu', 'no', 'sitemap', 'sitemap', 'This is best plugin', 'sitemap'),
(4, 'Page 4', '<p>\r\n	The quick, brown fox jumps over a lazy dog. DJs flock by when MTV ax quiz prog. Junk MTV quiz graced by fox whelps. Bawds jog, flick quartz, vex nymphs.</p>\r\n<p>\r\n	Waltz, bad nymph, for quick jigs vex! Fox nymphs grab quick-jived waltz. Brick quiz whangs jumpy veldt fox. Bright vixens jump; dozy fowl quack.</p>\r\n<p>\r\n	Quick wafting zephyrs vex bold Jim. Quick zephyrs blow, vexing daft Jim. Sex-charged fop blew my junk TV quiz. How quickly daft jumping zebras vex.</p>\r\n<p>\r\n	Two driven jocks help fax my big quiz. Quick, Baz, get my woven flax jodhpurs! &quot;Now fax quiz Jack! &quot; my brave ghost pled. Five quacking zephyrs jolt my wax bed.</p>\r\n<p>\r\n	Flummoxed by job, kvetching W. zaps Iraq. Cozy sphinx waves quart jug of bad milk. A very bad quack might jinx zippy fowls. Few quips galvanized the mock jury box.</p>\r\n<p>\r\n	Quick brown dogs jump over the lazy fox. The jay, pig, fox, zebra, and my wolves quack! Blowzy red vixens fight for a quick jump. Joaquin Phoenix was gazed by MTV for luck. A wizard&rsquo;s job is to vex chumps quickly in fog. Watch &quot;Jeopardy! &quot;, Alex Trebek&#39;s fun TV quiz game. Woven silk pyjamas exchanged for blue quartz. Brawny gods just</p>\r\n', 'headmenu', 'no', 'blog', 'blog blogging', 'stes', 'narola/blog'),
(5, 'Page 5', '<p>\r\n	Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>\r\n<p>\r\n	Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.</p>\r\n<p>\r\n	In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus.</p>\r\n<p>\r\n	Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum.</p>\r\n<p>\r\n	Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum.</p>\r\n<p>\r\n	Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</p>\r\n', 'footmenu', 'yes', 'home,index', 'contact, about', 'metsdlfjdklk l', ''),
(6, 'Page 6', '<p>\r\n	The quick, brown fox jumps over a lazy dog. DJs flock by when MTV ax quiz prog. Junk MTV quiz graced by fox whelps. Bawds jog, flick quartz, vex nymphs.</p>\r\n<p>\r\n	Waltz, bad nymph, for quick jigs vex! Fox nymphs grab quick-jived waltz. Brick quiz whangs jumpy veldt fox. Bright vixens jump; dozy fowl quack.</p>\r\n<p>\r\n	Quick wafting zephyrs vex bold Jim. Quick zephyrs blow, vexing daft Jim. Sex-charged fop blew my junk TV quiz. How quickly daft jumping zebras vex.</p>\r\n<p>\r\n	Two driven jocks help fax my big quiz. Quick, Baz, get my woven flax jodhpurs! &quot;Now fax quiz Jack! &quot; my brave ghost pled. Five quacking zephyrs jolt my wax bed.</p>\r\n<p>\r\n	Flummoxed by job, kvetching W. zaps Iraq. Cozy sphinx waves quart jug of bad milk. A very bad quack might jinx zippy fowls. Few quips galvanized the mock jury box.</p>\r\n<p>\r\n	Quick brown dogs jump over the lazy fox. The jay, pig, fox, zebra, and my wolves quack! Blowzy red vixens fight for a quick jump. Joaquin Phoenix was gazed by MTV for luck. A wizard&rsquo;s job is to vex chumps quickly in fog. Watch &quot;Jeopardy! &quot;, Alex Trebek&#39;s fun TV quiz game. Woven silk pyjamas exchanged for blue quartz. Brawny gods just</p>\r\n', 'footmenu', 'yes', 'contact', 'contact, about', 'metsdlfjdklk l', ''),
(7, 'Page 7', '<p>\r\n	Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>\r\n<p>\r\n	Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>\r\n<p>\r\n	It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>\r\n<p>\r\n	<span style="background-color:#ffff00;"><span style="font-size:16px;"><span style="font-family:comic sans ms,cursive;">Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.</span></span></span></p>\r\n<p>\r\n	The Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn&rsquo;t listen. She packed her seven versalia, put her initial into the belt and made herself on the way.</p>\r\n<p>\r\n	When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane. Pityful a rethoric question ran over her cheek, then</p>\r\n', 'headmenu', 'yes', 'dipa has no mind but still she is working amaizing', 'cakephp seo plugin', 'This plugin is one of the most', 'cakephp/seo'),
(8, 'Page 8', '<p>\r\n	The European languages are members of the same family. Their separate existence is a myth. For science, music, sport, etc, Europe uses the same vocabulary.</p>\r\n<p>\r\n	<span style="background-color:#ffd700;"><span style="font-size:36px;"><strike><em>The languages only differ in their grammar, their pronunciation and their most common words. Everyone realizes why a new common language would be desirable: one could refuse to pay expensive translators.</em></strike></span></span></p>\r\n<p>\r\n	To achieve this, it would be necessary to have uniform grammar, pronunciation and more common words.</p>\r\n<p>\r\n	If several languages coalesce, the grammar of the resulting language is more simple and regular than that of the individual languages. The new common language will be more simple and regular than the existing European languages.</p>\r\n<p>\r\n	It will be as simple as Occidental; in fact, it will be Occidental. To an English person, it will seem like simplified English, as a skeptical Cambridge friend of mine told me what Occidental is. The European languages are members of the same family.</p>\r\n<p>\r\n	Their separate existence is a myth. For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ in their grammar, their pronunciation and their most common words. Everyone realizes why a new common language would be desirable: one could refuse to pay expensive translators. To</p>\r\n', 'headmenu', 'yes', 'maulik is somewhat like a mad', 'maulik', 'Narola infotech is one of the most growing IT companies in Surat', '/cakephp/dev'),
(9, 'New page', '<p>\r\n	test</p>\r\n', 'headmenu', 'yes', 'simple page - narolainfotech.com', 'simple', 'This is the meta information', 'narolainfotech/form');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`) VALUES
(1, 'First post title', 'The content of first post'),
(2, 'First post title', 'dfgdfgdfggdfdfgdf');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `password` char(64) COLLATE utf8_bin NOT NULL,
  `firstName` varchar(255) COLLATE utf8_bin NOT NULL,
  `lastName` varchar(255) COLLATE utf8_bin NOT NULL,
  `language` varchar(10) COLLATE utf8_bin NOT NULL DEFAULT 'nl_nl',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=16 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `firstName`, `lastName`, `language`, `created`, `updated`) VALUES
(14, 'ashish', 'wilma.meinds@verhuurbase.nl', '$2a$13$i6uGhBmpktwQ3JWW3Gyk6.3RYTDh7NPy0dZDL8VuhOLCekAAHkXJa', 'Wilma', 'Meinds', 'nl_nl', '2014-03-31 14:37:04', '2014-03-31 14:37:04'),
(15, 'admin', 'admin', '$2a$13$nX6qJ4WAf2CuTaHLFQLILOuf2WHKKgG7sHHl8DayJFp1I/JwkMaIO', 'Administrator', '', 'nl_nl', NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
