CREATE TABLE `product` (
  `productid` int(11) NOT NULL,
  `naam` varchar(30) NOT NULL,
  `plaatje` text NOT NULL,
  `prijs` double(10,2) NOT NULL,
  `categorie` varchar(40) NOT NULL,
  `kleur` varchar(30) NOT NULL,
  `beschrijving` varchar(400) DEFAULT NULL,
  `voorraad` int(11) NOT NULL);

ALTER TABLE `product`
  ADD PRIMARY KEY (`productid`);
COMMIT;

INSERT INTO `product` (`productid`, `naam`, `plaatje`, `prijs`, `categorie`, `kleur`, `beschrijving`, `voorraad`) VALUES
(0, 'Groene knijper', 'product-images/groeneknijper.jpg', 2.00, '', '', 'Groener dan het gras.', 0),
(1, 'Gele Knijper', 'product-images/geleknijper.jpg', 1.50, '', '', 'Een mooie gele knijper.', 0),
(2, 'Roze Knijper', 'product-images/rozeknijper.jpg', 1500.00, '', '', 'Dit is misschien wel de mooiste knijper in de wereld. Koop hem nu, nu hij nog in het assortiment zit!', 0),
(3, 'Paarse Knijper', 'product-images/paarseknijper.jpg', 2.20, '', '', 'Pimpelpaars.', 0),
(4, 'Blauwe Knijper', 'product-images/blauweknijper.jpg', 1.75, '', '', 'Blauw.', 0);