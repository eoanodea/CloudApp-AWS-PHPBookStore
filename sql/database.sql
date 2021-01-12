CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 NOT NULL,
  `author` varchar(50) CHARACTER SET utf8 NOT NULL,
  `isbn` varchar(15) CHARACTER SET utf8 NOT NULL,
  `year` int(4) UNSIGNED NOT NULL,
  `price` decimal(7,2) NOT NULL,
  `cover` varchar(50) NOT NULL DEFAULT 'book_default.png',
  `publisher_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

INSERT INTO `books` (`id`, `title`, `author`, `isbn`, `year`, `price`, `cover`, `publisher_id`) VALUES
(1, 'Learning PHP: A Gentle Introduction to the Web\'s Most Popular Language', 'David Sklar', '9781491933572', 2016, '41.99', 'uploads/book_default.png', 1),
(2, 'Beginning PHP 5.3', 'Matt Doyle', '9780470413968', 2009, '36.40', 'uploads/book_default.png', 2),
(3, 'Beginning JavaScript, 5th Edition', 'Jeremy McPeak', '9781118903339', 2015, '40.90', 'uploads/book_default.png', 2),
(4, 'Learning JavaScript, 3rd Edition', 'Ethan Brown', '9781491914915', 2016, '39.99', 'uploads/book_default.png', 1),
(5, '100 Things Every Designer Needs to Know About People', 'Susan Weinschenk', '9780321767530', 2011, '26.31', 'uploads/book_default.png', 3),
(6, 'Smashing CSS: Professional Techniques for Modern L', 'Eric Meyer', '9780470684160', 2010, '28.90', 'uploads/book_default.png', 2),
(7, 'HTML5: The Missing Manual, 2nd Edition', 'Matthew MacDonald', '9781449363260', 2014, '34.99', 'uploads/book_default.png', 1),
(8, 'Stylin\' with CSS: A Designer\'s Guide, 3rd Edition', 'Charles Wyke-Smith', '9780321858474', 2012, '25.76', 'uploads/book_default.png', 3),
(9, 'Introducing HTML5, 2nd Edition', 'Bruce Lawson', '9780321784421', 2011, '17.95', 'uploads/book_default.png', 3),
(10, 'CSS: The Missing Manual, 4th Edition', 'David Sawyer McFarland', '9781491918050', 2015, '35.72', 'uploads/book_default.png', 1),
(11, 'HTML5 Foundations', 'Matt West', '9781118356555', 2012, '36.50', 'uploads/book_default.png', 2);

CREATE TABLE `publishers` (
  `id` int(11) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `address` varchar(250) CHARACTER SET utf8 NOT NULL,
  `phone` varchar(50) CHARACTER SET utf8 NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 NOT NULL,
  `website` varchar(50) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dumping data for table `publishers`
--

INSERT INTO `publishers` (`id`, `name`, `address`, `phone`, `email`, `website`) VALUES
(1, 'O Reilly Media', '5 St George\'s Rd, Farnham GU9 7LW, UK', '+441252721284', 'information@oreilly.com', 'https://www.oreilly.com'),
(2, 'John Wiley and Sons', 'Baffins Lane, Chichester, West Sussex PO 19 1UD, UK', '+441243779777', 'customer@wiley.com', 'http://www.wiley.com'),
(3, 'Pearson Education', '80 Strand London WC2R 0RL, UK', '+442070102000', 'enquiries@pearson.com', 'https://www.pearson.com/');

ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_publisher_id` (`publisher_id`);

ALTER TABLE `publishers`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

ALTER TABLE `publishers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `books`
  ADD CONSTRAINT `book_publisher_fk` FOREIGN KEY (`publisher_id`) REFERENCES `publishers` (`id`);
