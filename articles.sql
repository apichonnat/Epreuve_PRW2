--
-- Structure de la table `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(10) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Contenu de la table `articles`
--

INSERT INTO `articles` (`id`, `category_id`, `title`, `description`) VALUES
(1, 7, 'Toute la pneumatique', 'La société SMC a été créée au Japon par Yoshiyuki Takada le 27 avril 1950. A l’âge de 89 ans, il est encore et toujours président de l’entreprise qu’il a créée. SMC signifie en fait «Sintered Material Corporation», en relation avec l’un des premiers développements (des préparateurs d’air efficaces avec filtre à corpuscules sintérisées). Actuellement, cette société est la plus importante au niveau mondial dans le domaine des équipements pneumatiques, avec notamment des parts de marché de 65 % au Japon et 20 % en Europe. Ce fabricant propose la gamme complète des composants et systèmes pneumatiques (valves, vérins, automatismes industriels, unités de traitement, vide, etc.).'),
(2, 5, 'Une ligne de montage pour les États-Unis', 'Le marché de l’automobile est très concurrentiel. Diverses marques rivalisent pour obtenir les faveurs des acheteurs. Les prix baissent en conséquence. Non seulement les constructeurs, mais également les sous-traitants subissent la pression des coûts. Malgré tout, aux États-Unis, beaucoup de choses sont encore réalisées manuellement. Afin de garantir des produits sans faille, les différentes étapes de la fabrication sont surveillées.'),
(3, 3, 'Des concentrateurs de capteurs hautement intégrés', 'Les concentrateurs de capteurs actuels offrent jusqu’à neuf degrés de liberté. En y ajoutant des capteurs externes, il est possible de réaliser dix degrés de liberté, voire davantage. Ils permettent ainsi de nouvelles fonctions dans de nombreuses applications industrielles, médicales, ainsi que dans les jeux. Le summum de l’intégration revient aux combinaisons de capteurs déjà équipées du logiciel correspondant.'),
(4, 8, 'Des oscilloscopes haute définition', 'Le mode à haute définition fait passer jusqu’à 16 bits la résolution verticale de deux nouveaux modèles d’oscilloscopes, soit un gain de 256 par rapport aux 8 bits du mode standard. Les courbes visualisées sont donc plus nettes et font ressortir des détails sinon noyés dans le bruit. L’utilisateur bénéficie ainsi de résultats d’analyse encore plus précis.'),
(5, 4, 'Eléments de régulation pour la domotique', 'Lors de la dernière Ineltec à Bâle, Saia-Bugess Control a présenté plusieurs produits ayant trait à l’automatisation et à la régulation, notamment dans le domaine de la domotique. Voici quelques descriptions de produits exposés.'),
(6, 8, 'Un multimètre numérique à échantillonnage graphique', 'Keithley Instruments, un leader mondial des instruments et systèmes de tests électriques avancés, a annoncé l’introduction du multimètre à échantillonnage graphique de 7½ chiffres DMM7510, premier d’une nouvelle classe de multimètres numériques.'),
(7, 2, 'Des progrès dans le développement des petits réacteurs', 'Une douzaine de pays font progresser le développement des petits réacteurs nucléaires modulaires (Small Modular Reactors, SMR). Selon l’Agence internationale de l’énergie atomique, cette catégorie de centrales électriques a le potentiel d’améliorer l’approvisionnement énergétique mondial.'),
(8, 6, 'Puissance de calcul', 'ABB Turbo Systems produit les aubes de turbine destinées aux turbocompresseurs, de manière rapide et précise, grâce à des centres d’usinage performants et à la solution numérique de Rexroth.'),
(9, 9, 'Le gaz et l’eau à l’honneur à Genève', 'La Société Suisse de l’Industrie du Gaz et des Eaux (SSIGE) a organisé sa journée technique le 17 septembre 2015 à l’hôtel Crowne Plaza à Genève. De nombreux orateurs ont présenté des exposés sur les dernières avancées dans le secteur de l’approvisionnement du gaz et de l’eau potable.'),
(10, 12, 'Usinage de moules complexes', 'Au vu du développement continu que connaît le secteur de la production en Espagne, certaines entreprises futées ont compris qu’investir dans un équipement de production adéquat pouvait leur procurer un réel avantage concurrentiel. Parmi ces sociétés, RS Moldes et RECA, deux firmes catalanes qui ont récemment acquis des centres d’usinage Haas auprès de leur HFO (Haas Factory Outlet) local HITEC Máquinas et qui ont réalisé un saut opportun de performance.'),
(11, 9, 'Le CRPP devient le Swiss Plasma Center', 'Le Centre de recherches en physique des plasmas (CRPP) de l’EPFL change de nom et devient le Swiss Plasma Center (SPC). Derrière ce changement se cache une extension de ses activités liée à un renouvellement des équipements, plaçant notamment le tokamak lausannois parmi les trois installations de recherche retenues par le consortium EUROfusion pour développer la fusion nucléaire dans le cadre du projet international ITER.'),
(12, 10, 'Nouvelle interface compacte avec fonctionnalités avancées', 'En ajoutant une nouvelle interface couleur compacte à sa gamme GOT2000, Mitsubishi Electric offre une visualisation de qualité supérieure et de meilleures fonctionnalités grâce à un large éventail d’applications. Le terminal GT2104 est doté d’un affichage TFT haute résolution de 4,3’’ avec un format grand écran, capable d’afficher plus de 65’000 couleurs. '),
(13, 11, 'Une connectivité optimisée', 'Depuis 60 ans, la société Fischer Connectors crée, en partenariat avec des fabricants d’équipements d’origine dans le monde entier, une multitude de solutions d’interconnexion pour tous types d’applications. L’entreprise a récemment lancé des connecteurs à performances accrues dans chacune de ses quatre gammes de produits: Fischer Core Series, UltiMateTM, MiniMaxTM et Fiber Optic. Tous sont fabriqués selon des critères de qualité stricts et testés pour répondre aux normes ISO et CEI.'),
(14, 2, 'Une nouvelle école labellisée Minergie', 'En 2012, Sierre s’est dotée d’une nouvelle école labellisée Minergie. Les quelques années de recul montrent que c’était une excellente décision. La ventilation double flux et le chauffage au gaz à condensation – qui en sont les principales caractéristiques – fonctionnent à la satisfaction de tous.');

-- --------------------------------------------------------

--
-- Structure de la table `articlescategories`
--

CREATE TABLE IF NOT EXISTS `articlescategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `articlescategories`
--

INSERT INTO `articlescategories` (`id`, `category`) VALUES
(1, 'Optoélectronique'),
(2, 'Énergie'),
(3, 'Sensorique'),
(4, 'Automatisation'),
(5, 'Productique'),
(6, 'Entraînement'),
(7, 'Pneumatique'),
(8, 'Technique de mesure'),
(9, 'Vie des sociétés'),
(10, 'Électronique'),
(11, 'Connectique'),
(12, 'Machines-outils');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `articlescategories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
