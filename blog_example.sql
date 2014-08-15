CREATE DATABASE IF NOT EXISTS `blog_example` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `blog_example`;

CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `shorttext` text NOT NULL,
  `longtext` text,
  `created` datetime NOT NULL,
  `comments_allowed` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `author` varchar(255) NOT NULL DEFAULT '',
  `author_email` varchar(255) DEFAULT '',
  `comment_count` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `article` (`id`, `title`, `alias`, `shorttext`, `longtext`, `created`, `comments_allowed`, `author`, `author_email`, `comment_count`) VALUES
	(1, 'Example of a very simple blog-implementation', 'example-of-a-very-simple-blog-implementation', 'This Signature module is supposed to show you the basic functionality of the Signature MVC framework. You will see how to set up routes for article listing and detail views, handling of active record models and using the template system.', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh.</p>', '2014-08-11 08:59:37', 1, 'Sven', 'sven@signature-framework.com', 3),
	(2, 'Next steps', 'next-steps', 'What\'s up next? This blog-module is not a full featured blog-implementation. Instead it only shows the minimum implementation of such a blog: Listing up articles, displaying an article and make comments on an article. Here are some suggestions of features which can be added to the blog-module.', '<h2>Configuration options</h2>\r\n<p>Now a new comment is published at the moment it is created. You may want to create a configuration option to toggle this feature. You can achive this by extending the module\'s <tt>init()</tt>-method.\r\n<h2>RSS-feed</h2>\r\n<p>What about a RSS-feed of your articles? Just add another route to the existing ones and extend the <tt>ArticleController</tt> with a new action. Make sure, to remove the current layout of the view for this new action.</p>\r\n<h2>Sorting of articles &amp; comments</h2>\r\n<p>Articles and comments are now listed as they are served by the database. This is acually wrong because articles and comments should be sorted by their creation date. You can extend <tt>ArticleController::indexAction()</tt> and use <tt>findByQuery()</tt> instead of <tt>findAll()</tt> on the <tt>$article</tt> model.</p>', '2014-08-14 14:19:44', 1, 'Sven', 'sven@signature-framework.com', 0);


CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `article_id` int(11) unsigned NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) DEFAULT NULL,
  `comment` text,
  `created` datetime NOT NULL,
  `published` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

INSERT INTO `comment` (`id`, `article_id`, `name`, `email`, `comment`, `created`, `published`) VALUES
	(1, 1, 'Sven', 'sven@example.com', 'Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. ', '2014-08-12 08:16:07', 1),
	(2, 1, 'Rick', 'rick@example.com', 'Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel.', '2014-08-14 08:22:51', 1),
	(3, 1, 'Martin', 'martin@example.com', 'This is a comment with no further text.', '2014-08-14 14:39:42', 1);
