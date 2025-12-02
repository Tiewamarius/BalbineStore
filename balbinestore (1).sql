-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 03 déc. 2025 à 00:19
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `balbinestore`
--

-- --------------------------------------------------------

--
-- Structure de la table `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'shipping',
  `street` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `postal_code` varchar(255) DEFAULT NULL,
  `country` varchar(255) NOT NULL DEFAULT 'Côte d’Ivoire',
  `phone` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `description`, `logo`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Balbine Beauty', 'balbine-beauty', NULL, NULL, 1, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(2, 'Oshun Pro', 'oshun-pro', NULL, NULL, 1, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(3, 'Floralis', 'floralis', NULL, NULL, 1, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(4, 'PROMASTER', 'promaster', 'Marque PROMASTER', 'images/brands/promaster.png', 1, '2025-12-02 11:57:35', '2025-12-02 11:57:35'),
(5, 'CALIVOIR', 'calivoir', 'Marque CALIVOIR', 'images/brands/calivoir.png', 1, '2025-12-02 11:57:35', '2025-12-02 11:57:35'),
(6, 'A2P', 'a2p', 'Marque A2P', 'images/brands/a2p.png', 1, '2025-12-02 11:57:35', '2025-12-02 11:57:35'),
(7, 'ALMAO', 'almao', 'Marque ALMAO', 'images/brands/almao.png', 1, '2025-12-02 11:57:35', '2025-12-02 11:57:35'),
(8, 'NDS', 'nds', 'Marque NDS', 'images/brands/nds.png', 1, '2025-12-02 11:57:35', '2025-12-02 11:57:35');

-- --------------------------------------------------------

--
-- Structure de la table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('tiewamarius@gmail.com|127.0.0.1', 'i:1;', 1764251953),
('tiewamarius@gmail.com|127.0.0.1:timer', 'i:1764251953;', 1764251953);

-- --------------------------------------------------------

--
-- Structure de la table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(8, 11, 'active', '2025-11-28 11:55:26', '2025-11-28 11:55:26');

-- --------------------------------------------------------

--
-- Structure de la table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cart_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_variant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `unit_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `cart_items`
--

INSERT INTO `cart_items` (`id`, `cart_id`, `product_id`, `product_variant_id`, `quantity`, `unit_price`, `created_at`, `updated_at`) VALUES
(15, 8, 7, NULL, 2, 9809.00, '2025-11-28 11:55:26', '2025-11-28 11:55:30'),
(16, 8, 1, NULL, 2, 5893.00, '2025-11-28 11:55:40', '2025-11-28 13:44:25');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `banner_image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `banner_image`, `description`, `parent_id`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Nettoyages & Entretiens Locaux', 'categories/images/products/des-produits-dentretien.jpg', NULL, NULL, NULL, 1, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(2, 'Traitement Phytosanitaire', 'categories/images/products/modul-de-aplicare-a-erbicidelor.jpg', NULL, NULL, NULL, 1, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(3, 'Paysagisme & Jardinage', 'categories/images/products/bsi-engrais-pour-bio-haie.webp', NULL, NULL, NULL, 1, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(4, 'Parfumage d\'Espace', 'categories/images/products/Sans-titre-2-copie-8.jpg', NULL, NULL, NULL, 1, '2025-11-22 17:53:39', '2025-11-22 17:53:39');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_10_21_111615_create_personal_access_tokens_table', 1),
(5, '2025_10_22_171136_create_roles_table', 1),
(6, '2025_10_22_171300_create_role_users_table', 1),
(7, '2025_10_22_171431_create_addresses_table', 1),
(8, '2025_10_22_171652_create_categories_table', 1),
(9, '2025_10_22_171810_create_brands_table', 1),
(10, '2025_10_22_171901_create_products_table', 1),
(11, '2025_10_22_172041_create_product_images_table', 1),
(12, '2025_10_22_172144_create_product_variants_table', 1),
(13, '2025_10_22_172509_create_carts_table', 1),
(14, '2025_10_22_172612_create_cart_items_table', 1),
(15, '2025_10_22_172838_create_orders_table', 1),
(16, '2025_10_22_173039_create_order_items_table', 1),
(17, '2025_10_22_173154_create_payments_table', 1),
(18, '2025_10_22_173331_create_shippings_table', 1),
(19, '2025_10_22_173447_create_notifications_table', 1),
(20, '2025_10_22_173557_create_reviews_table', 1),
(21, '2025_10_22_173645_create_wishlists_table', 1),
(22, '2025_11_04_100435_create_wishlists_products_table', 1),
(23, '2025_11_11_150221_add_unit_to_products_table', 1),
(24, '2025_11_24_111014_add_columns_to_users_table', 2);

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'info',
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `address_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order_number` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `payment_method` varchar(255) DEFAULT NULL,
  `payment_status` varchar(255) NOT NULL DEFAULT 'unpaid',
  `subtotal` decimal(10,2) NOT NULL,
  `shipping_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_variant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('tiewamaruis@gmail.com', '$2y$12$K.FMrNmZHlz9s3qRDVQ/6eKxrwb.brWlRrue7neQ/y6lNbsf1ghVK', '2025-11-27 14:04:26');

-- --------------------------------------------------------

--
-- Structure de la table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `method` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `transaction_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `categories_id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount_price` decimal(10,2) DEFAULT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `unit` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id`, `categories_id`, `brand_id`, `name`, `slug`, `description`, `price`, `discount_price`, `stock`, `unit`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Produit 1 - Nettoyages & Entretiens Locaux', 'produit-1-nettoyages-entretiens-locaux-6921f8a35c67d', 'Description de Produit 1 - Nettoyages & Entretiens Locaux', 5893.00, NULL, 7, 'ml', 1, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(2, 1, 1, 'Produit 2 - Nettoyages & Entretiens Locaux', 'produit-2-nettoyages-entretiens-locaux-6921f8a3684d6', 'Description de Produit 2 - Nettoyages & Entretiens Locaux', 9883.00, 8545.00, 15, 'ml', 1, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(3, 1, 1, 'Produit 3 - Nettoyages & Entretiens Locaux', 'produit-3-nettoyages-entretiens-locaux-6921f8a370b5f', 'Description de Produit 3 - Nettoyages & Entretiens Locaux', 18032.00, NULL, 30, 'ml', 1, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(4, 1, 1, 'Produit 4 - Nettoyages & Entretiens Locaux', 'produit-4-nettoyages-entretiens-locaux-6921f8a375961', 'Description de Produit 4 - Nettoyages & Entretiens Locaux', 18091.00, 9890.00, 11, 'ml', 1, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(5, 1, 1, 'Produit 5 - Nettoyages & Entretiens Locaux', 'produit-5-nettoyages-entretiens-locaux-6921f8a37ad33', 'Description de Produit 5 - Nettoyages & Entretiens Locaux', 17226.00, NULL, 6, 'ml', 1, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(6, 1, 1, 'Produit 6 - Nettoyages & Entretiens Locaux', 'produit-6-nettoyages-entretiens-locaux-6921f8a3800af', 'Description de Produit 6 - Nettoyages & Entretiens Locaux', 9537.00, NULL, 21, 'ml', 1, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(7, 1, 1, 'Produit 7 - Nettoyages & Entretiens Locaux', 'produit-7-nettoyages-entretiens-locaux-6921f8a3852f9', 'Description de Produit 7 - Nettoyages & Entretiens Locaux', 9809.00, NULL, 20, 'ml', 1, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(8, 1, 1, 'Produit 8 - Nettoyages & Entretiens Locaux', 'produit-8-nettoyages-entretiens-locaux-6921f8a38ba85', 'Description de Produit 8 - Nettoyages & Entretiens Locaux', 18311.00, NULL, 19, 'ml', 1, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(9, 1, 1, 'Produit 9 - Nettoyages & Entretiens Locaux', 'produit-9-nettoyages-entretiens-locaux-6921f8a399a6b', 'Description de Produit 9 - Nettoyages & Entretiens Locaux', 19317.00, 10252.00, 21, 'ml', 1, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(10, 1, 1, 'Produit 10 - Nettoyages & Entretiens Locaux', 'produit-10-nettoyages-entretiens-locaux-6921f8a3a0aae', 'Description de Produit 10 - Nettoyages & Entretiens Locaux', 12848.00, 3780.00, 5, 'ml', 1, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(11, 2, 1, 'Produit 1 - Traitement Phytosanitaire', 'produit-1-traitement-phytosanitaire-6921f8a3a6e22', 'Description de Produit 1 - Traitement Phytosanitaire', 16715.00, 10054.00, 17, 'ml', 1, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(12, 2, 1, 'Produit 2 - Traitement Phytosanitaire', 'produit-2-traitement-phytosanitaire-6921f8a3acfcc', 'Description de Produit 2 - Traitement Phytosanitaire', 5929.00, 13260.00, 17, 'ml', 1, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(13, 2, 1, 'Produit 3 - Traitement Phytosanitaire', 'produit-3-traitement-phytosanitaire-6921f8a3b293c', 'Description de Produit 3 - Traitement Phytosanitaire', 11854.00, 5711.00, 10, 'ml', 1, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(14, 2, 1, 'Produit 4 - Traitement Phytosanitaire', 'produit-4-traitement-phytosanitaire-6921f8a3b89b7', 'Description de Produit 4 - Traitement Phytosanitaire', 12189.00, NULL, 17, 'ml', 1, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(15, 2, 1, 'Produit 5 - Traitement Phytosanitaire', 'produit-5-traitement-phytosanitaire-6921f8a3beebf', 'Description de Produit 5 - Traitement Phytosanitaire', 8468.00, 6701.00, 16, 'ml', 1, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(16, 2, 1, 'Produit 6 - Traitement Phytosanitaire', 'produit-6-traitement-phytosanitaire-6921f8a3c4837', 'Description de Produit 6 - Traitement Phytosanitaire', 9855.00, 7953.00, 9, 'ml', 1, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(17, 2, 1, 'Produit 7 - Traitement Phytosanitaire', 'produit-7-traitement-phytosanitaire-6921f8a3cb133', 'Description de Produit 7 - Traitement Phytosanitaire', 13034.00, 4633.00, 24, 'ml', 1, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(18, 2, 1, 'Produit 8 - Traitement Phytosanitaire', 'produit-8-traitement-phytosanitaire-6921f8a3d10e8', 'Description de Produit 8 - Traitement Phytosanitaire', 10872.00, 4360.00, 10, 'ml', 1, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(19, 2, 1, 'Produit 9 - Traitement Phytosanitaire', 'produit-9-traitement-phytosanitaire-6921f8a3d6e3e', 'Description de Produit 9 - Traitement Phytosanitaire', 15609.00, NULL, 23, 'ml', 1, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(20, 2, 1, 'Produit 10 - Traitement Phytosanitaire', 'produit-10-traitement-phytosanitaire-6921f8a3dc9eb', 'Description de Produit 10 - Traitement Phytosanitaire', 8782.00, 13261.00, 26, 'ml', 1, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(21, 3, 1, 'Produit 1 - Paysagisme & Jardinage', 'produit-1-paysagisme-jardinage-6921f8a3e3196', 'Description de Produit 1 - Paysagisme & Jardinage', 10473.00, NULL, 24, 'ml', 1, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(22, 3, 1, 'Produit 2 - Paysagisme & Jardinage', 'produit-2-paysagisme-jardinage-6921f8a3e93c2', 'Description de Produit 2 - Paysagisme & Jardinage', 19830.00, 7911.00, 23, 'ml', 1, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(23, 3, 1, 'Produit 3 - Paysagisme & Jardinage', 'produit-3-paysagisme-jardinage-6921f8a3ef5f1', 'Description de Produit 3 - Paysagisme & Jardinage', 7099.00, NULL, 13, 'ml', 1, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(24, 3, 1, 'Produit 4 - Paysagisme & Jardinage', 'produit-4-paysagisme-jardinage-6921f8a400ac1', 'Description de Produit 4 - Paysagisme & Jardinage', 15774.00, NULL, 24, 'ml', 1, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(25, 3, 1, 'Produit 5 - Paysagisme & Jardinage', 'produit-5-paysagisme-jardinage-6921f8a407e42', 'Description de Produit 5 - Paysagisme & Jardinage', 13373.00, NULL, 15, 'ml', 1, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(26, 3, 1, 'Produit 6 - Paysagisme & Jardinage', 'produit-6-paysagisme-jardinage-6921f8a40d503', 'Description de Produit 6 - Paysagisme & Jardinage', 17423.00, NULL, 29, 'ml', 1, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(27, 3, 1, 'Produit 7 - Paysagisme & Jardinage', 'produit-7-paysagisme-jardinage-6921f8a41e4c1', 'Description de Produit 7 - Paysagisme & Jardinage', 13455.00, NULL, 7, 'ml', 1, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(28, 3, 1, 'Produit 8 - Paysagisme & Jardinage', 'produit-8-paysagisme-jardinage-6921f8a424efa', 'Description de Produit 8 - Paysagisme & Jardinage', 19443.00, NULL, 9, 'ml', 1, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(29, 3, 1, 'Produit 9 - Paysagisme & Jardinage', 'produit-9-paysagisme-jardinage-6921f8a42bb6f', 'Description de Produit 9 - Paysagisme & Jardinage', 6898.00, NULL, 28, 'ml', 1, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(30, 3, 1, 'Produit 10 - Paysagisme & Jardinage', 'produit-10-paysagisme-jardinage-6921f8a47e2ce', 'Description de Produit 10 - Paysagisme & Jardinage', 13234.00, 5274.00, 5, 'ml', 1, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(31, 4, 1, 'Produit 1 - Parfumage d\'Espace', 'produit-1-parfumage-despace-6921f8a484f17', 'Description de Produit 1 - Parfumage d\'Espace', 13357.00, 6091.00, 30, 'ml', 1, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(32, 4, 1, 'Produit 2 - Parfumage d\'Espace', 'produit-2-parfumage-despace-6921f8a48df67', 'Description de Produit 2 - Parfumage d\'Espace', 11717.00, NULL, 14, 'ml', 1, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(33, 4, 1, 'Produit 3 - Parfumage d\'Espace', 'produit-3-parfumage-despace-6921f8a49b1b4', 'Description de Produit 3 - Parfumage d\'Espace', 13660.00, NULL, 5, 'ml', 1, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(34, 4, 1, 'Produit 4 - Parfumage d\'Espace', 'produit-4-parfumage-despace-6921f8a4a29c2', 'Description de Produit 4 - Parfumage d\'Espace', 14344.00, NULL, 24, 'ml', 1, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(35, 4, 1, 'Produit 5 - Parfumage d\'Espace', 'produit-5-parfumage-despace-6921f8a4aa3b8', 'Description de Produit 5 - Parfumage d\'Espace', 11539.00, 8331.00, 19, 'ml', 1, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(36, 4, 1, 'Produit 6 - Parfumage d\'Espace', 'produit-6-parfumage-despace-6921f8a4b1bbb', 'Description de Produit 6 - Parfumage d\'Espace', 11878.00, NULL, 29, 'ml', 1, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(37, 4, 1, 'Produit 7 - Parfumage d\'Espace', 'produit-7-parfumage-despace-6921f8a4b803c', 'Description de Produit 7 - Parfumage d\'Espace', 13794.00, NULL, 21, 'ml', 1, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(38, 4, 1, 'Produit 8 - Parfumage d\'Espace', 'produit-8-parfumage-despace-6921f8a4bdadf', 'Description de Produit 8 - Parfumage d\'Espace', 7385.00, NULL, 6, 'ml', 1, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(39, 4, 1, 'Produit 9 - Parfumage d\'Espace', 'produit-9-parfumage-despace-6921f8a4c4b9e', 'Description de Produit 9 - Parfumage d\'Espace', 15918.00, NULL, 14, 'ml', 1, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(40, 4, 1, 'Produit 10 - Parfumage d\'Espace', 'produit-10-parfumage-despace-6921f8a4cc79a', 'Description de Produit 10 - Parfumage d\'Espace', 19147.00, 9081.00, 7, 'ml', 1, '2025-11-22 17:53:40', '2025-11-22 17:53:40');

-- --------------------------------------------------------

--
-- Structure de la table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `is_main` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image_path`, `is_main`, `created_at`, `updated_at`) VALUES
(1, 1, 'images/products/nettoyages/37761-19573-1696839788.png', 1, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(2, 1, 'images/products/nettoyages/37761-19573-1696839788.png', 0, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(3, 1, 'images/products/nettoyages/37761-19573-1696839788.png', 0, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(4, 2, 'images/products/nettoyages/Actellic.jpg', 1, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(5, 2, 'images/products/nettoyages/nettoyants.jpg', 0, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(6, 2, 'images/products/nettoyages/nettoyants.jpg', 0, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(7, 3, 'images/products/nettoyages/ECT-SURF-SPRAY.png', 1, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(8, 3, 'images/products/nettoyages/ECT-SURF-SPRAY.png', 0, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(9, 3, 'images/products/nettoyages/ECT-SURF-SPRAY.png', 0, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(10, 4, 'images/products/nettoyages/disincrostante_gell2.webp', 1, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(11, 4, 'images/products/nettoyages/disincrostante_gell2.webp', 0, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(12, 4, 'images/products/nettoyages/disincrostante_gell2.webp', 0, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(13, 5, 'images/products/nettoyages/81aCbNyROFL._AC_SL1500.jpg', 1, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(14, 5, 'images/products/nettoyages/81aCbNyROFL._AC_SL1500.jpg', 0, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(15, 5, 'images/products/nettoyages/81aCbNyROFL._AC_SL1500.jpg', 0, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(16, 6, 'images/products/nettoyages/81aCbNyROFL._AC_SL1500.jpg', 1, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(17, 6, 'images/products/nettoyages/81aCbNyROFL._AC_SL1500.jpg', 0, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(18, 6, 'images/products/nettoyages/81aCbNyROFL._AC_SL1500.jpg', 0, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(19, 7, 'images/products/nettoyages/Liquid-Toilet-Detergent-Cleaner.avif', 1, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(20, 7, 'images/products/nettoyages/Liquid-Toilet-Detergent-Cleaner.avif', 0, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(21, 7, 'images/products/nettoyages/Liquid-Toilet-Detergent-Cleaner.avif', 0, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(22, 8, 'images/products/nettoyages/disincrostante_gel.webp', 1, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(23, 8, 'images/products/nettoyages/disincrostante_gel.webp', 0, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(24, 8, 'images/products/nettoyages/disincrostante_gel.webp', 0, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(25, 9, 'images/products/nettoyages/disincrostante_gel.webp', 1, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(26, 9, 'images/products/nettoyages/disincrostante_gel.webp', 0, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(27, 9, 'images/products/nettoyages/disincrostante_gel.webp', 0, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(28, 10, 'images/products/nettoyages/OIP.webp', 1, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(29, 10, 'images/products/nettoyages/OIP.webp', 0, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(30, 10, 'images/products/nettoyages/OIP.webp', 0, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(31, 11, 'images/products/default1.jpg', 1, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(32, 11, 'images/products/default2.jpg', 0, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(33, 11, 'images/products/default3.jpg', 0, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(34, 12, 'images/products/default1.jpg', 1, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(35, 12, 'images/products/default2.jpg', 0, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(36, 12, 'images/products/default3.jpg', 0, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(37, 13, 'images/products/default1.jpg', 1, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(38, 13, 'images/products/default2.jpg', 0, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(39, 13, 'images/products/default3.jpg', 0, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(40, 14, 'images/products/default1.jpg', 1, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(41, 14, 'images/products/default2.jpg', 0, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(42, 14, 'images/products/default3.jpg', 0, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(43, 15, 'images/products/default1.jpg', 1, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(44, 15, 'images/products/default2.jpg', 0, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(45, 15, 'images/products/default3.jpg', 0, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(46, 16, 'images/products/default1.jpg', 1, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(47, 16, 'images/products/default2.jpg', 0, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(48, 16, 'images/products/default3.jpg', 0, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(49, 17, 'images/products/default1.jpg', 1, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(50, 17, 'images/products/default2.jpg', 0, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(51, 17, 'images/products/default3.jpg', 0, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(52, 18, 'images/products/default1.jpg', 1, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(53, 18, 'images/products/default2.jpg', 0, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(54, 18, 'images/products/default3.jpg', 0, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(55, 19, 'images/products/default1.jpg', 1, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(56, 19, 'images/products/default2.jpg', 0, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(57, 19, 'images/products/default3.jpg', 0, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(58, 20, 'images/products/default1.jpg', 1, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(59, 20, 'images/products/default2.jpg', 0, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(60, 20, 'images/products/default3.jpg', 0, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(61, 21, 'images/products/default1.jpg', 1, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(62, 21, 'images/products/default2.jpg', 0, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(63, 21, 'images/products/default3.jpg', 0, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(64, 22, 'images/products/default1.jpg', 1, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(65, 22, 'images/products/default2.jpg', 0, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(66, 22, 'images/products/default3.jpg', 0, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(67, 23, 'images/products/default1.jpg', 1, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(68, 23, 'images/products/default2.jpg', 0, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(69, 23, 'images/products/default3.jpg', 0, '2025-11-22 17:53:39', '2025-11-22 17:53:39'),
(70, 24, 'images/products/default1.jpg', 1, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(71, 24, 'images/products/default2.jpg', 0, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(72, 24, 'images/products/default3.jpg', 0, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(73, 25, 'images/products/default1.jpg', 1, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(74, 25, 'images/products/default2.jpg', 0, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(75, 25, 'images/products/default3.jpg', 0, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(76, 26, 'images/products/default1.jpg', 1, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(77, 26, 'images/products/default2.jpg', 0, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(78, 26, 'images/products/default3.jpg', 0, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(79, 27, 'images/products/default1.jpg', 1, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(80, 27, 'images/products/default2.jpg', 0, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(81, 27, 'images/products/default3.jpg', 0, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(82, 28, 'images/products/default1.jpg', 1, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(83, 28, 'images/products/default2.jpg', 0, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(84, 28, 'images/products/default3.jpg', 0, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(85, 29, 'images/products/default1.jpg', 1, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(86, 29, 'images/products/default2.jpg', 0, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(87, 29, 'images/products/default3.jpg', 0, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(88, 30, 'images/products/default1.jpg', 1, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(89, 30, 'images/products/default2.jpg', 0, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(90, 30, 'images/products/default3.jpg', 0, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(91, 31, 'images/products/parfumages/FRESHNER-AL-AQMAR-300-ML.webp', 1, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(92, 31, 'images/products/parfumages/FRESHNER-AL-AQMAR-300-ML.webp', 0, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(93, 31, 'images/products/parfumages/FRESHNER-AL-AQMAR-300-ML.webp', 0, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(94, 32, 'images/products/default1.jpg', 1, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(95, 32, 'images/products/default2.jpg', 0, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(96, 32, 'images/products/default3.jpg', 0, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(97, 33, 'images/products/default1.jpg', 1, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(98, 33, 'images/products/default2.jpg', 0, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(99, 33, 'images/products/default3.jpg', 0, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(100, 34, 'images/products/default1.jpg', 1, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(101, 34, 'images/products/default2.jpg', 0, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(102, 34, 'images/products/default3.jpg', 0, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(103, 35, 'images/products/parfumages/ANGIE-100-ML.jpg', 1, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(104, 35, 'images/products/parfumages/ANGIE-100-ML.jpg', 0, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(105, 35, 'images/products/parfumages/ANGIE-100-ML.jpg', 0, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(106, 36, 'images/products/default1.jpg', 1, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(107, 36, 'images/products/default2.jpg', 0, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(108, 36, 'images/products/default3.jpg', 0, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(109, 37, 'images/products/default1.jpg', 1, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(110, 37, 'images/products/default2.jpg', 0, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(111, 37, 'images/products/default3.jpg', 0, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(112, 38, 'images/products/default1.jpg', 1, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(113, 38, 'images/products/default2.jpg', 0, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(114, 38, 'images/products/default3.jpg', 0, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(115, 39, 'images/products/default1.jpg', 1, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(116, 39, 'images/products/default2.jpg', 0, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(117, 39, 'images/products/default3.jpg', 0, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(118, 40, 'images/products/default1.jpg', 1, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(119, 40, 'images/products/default2.jpg', 0, '2025-11-22 17:53:40', '2025-11-22 17:53:40'),
(120, 40, 'images/products/default3.jpg', 0, '2025-11-22 17:53:40', '2025-11-22 17:53:40');

-- --------------------------------------------------------

--
-- Structure de la table `product_variants`
--

CREATE TABLE `product_variants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `attributes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`attributes`)),
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `product_variants`
--

INSERT INTO `product_variants` (`id`, `product_id`, `name`, `sku`, `price`, `stock`, `attributes`, `is_active`, `created_at`, `updated_at`) VALUES
(170, 1, '500 ml', 'PRODUI-500ML-752', 4393.00, 19, '\"{\\\"size\\\":\\\"500ml\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(171, 1, '1 Litre', 'PRODUI-1L-794', 5893.00, 20, '\"{\\\"size\\\":\\\"1L\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(172, 1, '5 Litres', 'PRODUI-5L-724', 10893.00, 28, '\"{\\\"size\\\":\\\"5L\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(173, 2, '500 ml', 'PRODUI-500ML-294', 8383.00, 5, '\"{\\\"size\\\":\\\"500ml\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(174, 2, '1 Litre', 'PRODUI-1L-747', 9883.00, 7, '\"{\\\"size\\\":\\\"1L\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(175, 2, '5 Litres', 'PRODUI-5L-242', 14883.00, 29, '\"{\\\"size\\\":\\\"5L\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(176, 3, '500 ml', 'PRODUI-500ML-393', 16532.00, 38, '\"{\\\"size\\\":\\\"500ml\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(177, 3, '1 Litre', 'PRODUI-1L-780', 18032.00, 30, '\"{\\\"size\\\":\\\"1L\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(178, 3, '5 Litres', 'PRODUI-5L-622', 23032.00, 14, '\"{\\\"size\\\":\\\"5L\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(179, 4, '500 ml', 'PRODUI-500ML-232', 16591.00, 6, '\"{\\\"size\\\":\\\"500ml\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(180, 4, '1 Litre', 'PRODUI-1L-960', 18091.00, 34, '\"{\\\"size\\\":\\\"1L\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(181, 4, '5 Litres', 'PRODUI-5L-668', 23091.00, 8, '\"{\\\"size\\\":\\\"5L\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(182, 5, '500 ml', 'PRODUI-500ML-913', 15726.00, 10, '\"{\\\"size\\\":\\\"500ml\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(183, 5, '1 Litre', 'PRODUI-1L-425', 17226.00, 5, '\"{\\\"size\\\":\\\"1L\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(184, 5, '5 Litres', 'PRODUI-5L-821', 22226.00, 24, '\"{\\\"size\\\":\\\"5L\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(185, 6, '500 ml', 'PRODUI-500ML-132', 8037.00, 39, '\"{\\\"size\\\":\\\"500ml\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(186, 6, '1 Litre', 'PRODUI-1L-478', 9537.00, 27, '\"{\\\"size\\\":\\\"1L\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(187, 6, '5 Litres', 'PRODUI-5L-549', 14537.00, 26, '\"{\\\"size\\\":\\\"5L\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(188, 7, '500 ml', 'PRODUI-500ML-698', 8309.00, 39, '\"{\\\"size\\\":\\\"500ml\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(189, 7, '1 Litre', 'PRODUI-1L-737', 9809.00, 35, '\"{\\\"size\\\":\\\"1L\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(190, 7, '5 Litres', 'PRODUI-5L-828', 14809.00, 18, '\"{\\\"size\\\":\\\"5L\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(191, 8, '500 ml', 'PRODUI-500ML-895', 16811.00, 8, '\"{\\\"size\\\":\\\"500ml\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(192, 8, '1 Litre', 'PRODUI-1L-536', 18311.00, 14, '\"{\\\"size\\\":\\\"1L\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(193, 8, '5 Litres', 'PRODUI-5L-853', 23311.00, 29, '\"{\\\"size\\\":\\\"5L\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(194, 9, '500 ml', 'PRODUI-500ML-440', 17817.00, 40, '\"{\\\"size\\\":\\\"500ml\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(195, 9, '1 Litre', 'PRODUI-1L-230', 19317.00, 39, '\"{\\\"size\\\":\\\"1L\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(196, 9, '5 Litres', 'PRODUI-5L-988', 24317.00, 10, '\"{\\\"size\\\":\\\"5L\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(197, 10, '500 ml', 'PRODUI-500ML-647', 11348.00, 27, '\"{\\\"size\\\":\\\"500ml\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(198, 10, '1 Litre', 'PRODUI-1L-529', 12848.00, 37, '\"{\\\"size\\\":\\\"1L\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(199, 10, '5 Litres', 'PRODUI-5L-937', 17848.00, 33, '\"{\\\"size\\\":\\\"5L\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(200, 11, 'Dose 25%', 'PRODUI-25%-540', 16715.00, 25, '\"{\\\"size\\\":\\\"25%\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(201, 11, 'Dose 50%', 'PRODUI-50%-437', 19715.00, 16, '\"{\\\"size\\\":\\\"50%\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(202, 11, 'Dose 75%', 'PRODUI-75%-147', 22715.00, 14, '\"{\\\"size\\\":\\\"75%\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(203, 12, 'Dose 25%', 'PRODUI-25%-930', 5929.00, 9, '\"{\\\"size\\\":\\\"25%\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(204, 12, 'Dose 50%', 'PRODUI-50%-580', 8929.00, 12, '\"{\\\"size\\\":\\\"50%\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(205, 12, 'Dose 75%', 'PRODUI-75%-729', 11929.00, 14, '\"{\\\"size\\\":\\\"75%\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(206, 13, 'Dose 25%', 'PRODUI-25%-863', 11854.00, 14, '\"{\\\"size\\\":\\\"25%\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(207, 13, 'Dose 50%', 'PRODUI-50%-446', 14854.00, 30, '\"{\\\"size\\\":\\\"50%\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(208, 13, 'Dose 75%', 'PRODUI-75%-282', 17854.00, 11, '\"{\\\"size\\\":\\\"75%\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(209, 14, 'Dose 25%', 'PRODUI-25%-251', 12189.00, 8, '\"{\\\"size\\\":\\\"25%\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(210, 14, 'Dose 50%', 'PRODUI-50%-320', 15189.00, 25, '\"{\\\"size\\\":\\\"50%\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(211, 14, 'Dose 75%', 'PRODUI-75%-155', 18189.00, 15, '\"{\\\"size\\\":\\\"75%\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(212, 15, 'Dose 25%', 'PRODUI-25%-222', 8468.00, 26, '\"{\\\"size\\\":\\\"25%\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(213, 15, 'Dose 50%', 'PRODUI-50%-301', 11468.00, 29, '\"{\\\"size\\\":\\\"50%\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(214, 15, 'Dose 75%', 'PRODUI-75%-377', 14468.00, 24, '\"{\\\"size\\\":\\\"75%\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(215, 16, 'Dose 25%', 'PRODUI-25%-252', 9855.00, 9, '\"{\\\"size\\\":\\\"25%\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(216, 16, 'Dose 50%', 'PRODUI-50%-527', 12855.00, 11, '\"{\\\"size\\\":\\\"50%\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(217, 16, 'Dose 75%', 'PRODUI-75%-592', 15855.00, 9, '\"{\\\"size\\\":\\\"75%\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(218, 17, 'Dose 25%', 'PRODUI-25%-846', 13034.00, 27, '\"{\\\"size\\\":\\\"25%\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(219, 17, 'Dose 50%', 'PRODUI-50%-156', 16034.00, 13, '\"{\\\"size\\\":\\\"50%\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(220, 17, 'Dose 75%', 'PRODUI-75%-106', 19034.00, 20, '\"{\\\"size\\\":\\\"75%\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(221, 18, 'Dose 25%', 'PRODUI-25%-176', 10872.00, 12, '\"{\\\"size\\\":\\\"25%\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(222, 18, 'Dose 50%', 'PRODUI-50%-682', 13872.00, 28, '\"{\\\"size\\\":\\\"50%\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(223, 18, 'Dose 75%', 'PRODUI-75%-834', 16872.00, 16, '\"{\\\"size\\\":\\\"75%\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(224, 19, 'Dose 25%', 'PRODUI-25%-202', 15609.00, 20, '\"{\\\"size\\\":\\\"25%\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(225, 19, 'Dose 50%', 'PRODUI-50%-912', 18609.00, 16, '\"{\\\"size\\\":\\\"50%\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(226, 19, 'Dose 75%', 'PRODUI-75%-835', 21609.00, 9, '\"{\\\"size\\\":\\\"75%\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(227, 20, 'Dose 25%', 'PRODUI-25%-725', 8782.00, 24, '\"{\\\"size\\\":\\\"25%\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(228, 20, 'Dose 50%', 'PRODUI-50%-429', 11782.00, 18, '\"{\\\"size\\\":\\\"50%\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(229, 20, 'Dose 75%', 'PRODUI-75%-846', 14782.00, 10, '\"{\\\"size\\\":\\\"75%\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(230, 21, 'Petit modèle', 'PRODUI-S-109', 8473.00, 20, '\"{\\\"size\\\":\\\"S\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(231, 21, 'Moyen modèle', 'PRODUI-M-790', 10473.00, 20, '\"{\\\"size\\\":\\\"M\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(232, 21, 'Grand modèle', 'PRODUI-L-400', 13473.00, 14, '\"{\\\"size\\\":\\\"L\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(233, 22, 'Petit modèle', 'PRODUI-S-825', 17830.00, 17, '\"{\\\"size\\\":\\\"S\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(234, 22, 'Moyen modèle', 'PRODUI-M-540', 19830.00, 18, '\"{\\\"size\\\":\\\"M\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(235, 22, 'Grand modèle', 'PRODUI-L-986', 22830.00, 23, '\"{\\\"size\\\":\\\"L\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(236, 23, 'Petit modèle', 'PRODUI-S-581', 5099.00, 21, '\"{\\\"size\\\":\\\"S\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(237, 23, 'Moyen modèle', 'PRODUI-M-722', 7099.00, 16, '\"{\\\"size\\\":\\\"M\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(238, 23, 'Grand modèle', 'PRODUI-L-948', 10099.00, 7, '\"{\\\"size\\\":\\\"L\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(239, 24, 'Petit modèle', 'PRODUI-S-373', 13774.00, 5, '\"{\\\"size\\\":\\\"S\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(240, 24, 'Moyen modèle', 'PRODUI-M-967', 15774.00, 24, '\"{\\\"size\\\":\\\"M\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(241, 24, 'Grand modèle', 'PRODUI-L-962', 18774.00, 15, '\"{\\\"size\\\":\\\"L\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(242, 25, 'Petit modèle', 'PRODUI-S-844', 11373.00, 9, '\"{\\\"size\\\":\\\"S\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(243, 25, 'Moyen modèle', 'PRODUI-M-147', 13373.00, 7, '\"{\\\"size\\\":\\\"M\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(244, 25, 'Grand modèle', 'PRODUI-L-555', 16373.00, 23, '\"{\\\"size\\\":\\\"L\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(245, 26, 'Petit modèle', 'PRODUI-S-412', 15423.00, 24, '\"{\\\"size\\\":\\\"S\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(246, 26, 'Moyen modèle', 'PRODUI-M-855', 17423.00, 23, '\"{\\\"size\\\":\\\"M\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(247, 26, 'Grand modèle', 'PRODUI-L-159', 20423.00, 20, '\"{\\\"size\\\":\\\"L\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(248, 27, 'Petit modèle', 'PRODUI-S-218', 11455.00, 9, '\"{\\\"size\\\":\\\"S\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(249, 27, 'Moyen modèle', 'PRODUI-M-630', 13455.00, 5, '\"{\\\"size\\\":\\\"M\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(250, 27, 'Grand modèle', 'PRODUI-L-350', 16455.00, 9, '\"{\\\"size\\\":\\\"L\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(251, 28, 'Petit modèle', 'PRODUI-S-657', 17443.00, 16, '\"{\\\"size\\\":\\\"S\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(252, 28, 'Moyen modèle', 'PRODUI-M-363', 19443.00, 25, '\"{\\\"size\\\":\\\"M\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(253, 28, 'Grand modèle', 'PRODUI-L-691', 22443.00, 25, '\"{\\\"size\\\":\\\"L\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(254, 29, 'Petit modèle', 'PRODUI-S-196', 4898.00, 19, '\"{\\\"size\\\":\\\"S\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(255, 29, 'Moyen modèle', 'PRODUI-M-330', 6898.00, 9, '\"{\\\"size\\\":\\\"M\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(256, 29, 'Grand modèle', 'PRODUI-L-620', 9898.00, 24, '\"{\\\"size\\\":\\\"L\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(257, 30, 'Petit modèle', 'PRODUI-S-160', 11234.00, 10, '\"{\\\"size\\\":\\\"S\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(258, 30, 'Moyen modèle', 'PRODUI-M-224', 13234.00, 7, '\"{\\\"size\\\":\\\"M\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(259, 30, 'Grand modèle', 'PRODUI-L-176', 16234.00, 15, '\"{\\\"size\\\":\\\"L\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(260, 31, '100 ml', 'PRODUI-100ML-443', 11857.00, 34, '\"{\\\"size\\\":\\\"100ml\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(261, 31, '250 ml', 'PRODUI-250ML-861', 13357.00, 26, '\"{\\\"size\\\":\\\"250ml\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(262, 31, '500 ml', 'PRODUI-500ML-889', 16357.00, 21, '\"{\\\"size\\\":\\\"500ml\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(263, 32, '100 ml', 'PRODUI-100ML-189', 10217.00, 20, '\"{\\\"size\\\":\\\"100ml\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(264, 32, '250 ml', 'PRODUI-250ML-810', 11717.00, 32, '\"{\\\"size\\\":\\\"250ml\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(265, 32, '500 ml', 'PRODUI-500ML-141', 14717.00, 12, '\"{\\\"size\\\":\\\"500ml\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(266, 33, '100 ml', 'PRODUI-100ML-869', 12160.00, 34, '\"{\\\"size\\\":\\\"100ml\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(267, 33, '250 ml', 'PRODUI-250ML-656', 13660.00, 24, '\"{\\\"size\\\":\\\"250ml\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(268, 33, '500 ml', 'PRODUI-500ML-704', 16660.00, 31, '\"{\\\"size\\\":\\\"500ml\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(269, 34, '100 ml', 'PRODUI-100ML-623', 12844.00, 12, '\"{\\\"size\\\":\\\"100ml\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(270, 34, '250 ml', 'PRODUI-250ML-714', 14344.00, 22, '\"{\\\"size\\\":\\\"250ml\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(271, 34, '500 ml', 'PRODUI-500ML-868', 17344.00, 17, '\"{\\\"size\\\":\\\"500ml\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(272, 35, '100 ml', 'PRODUI-100ML-607', 10039.00, 19, '\"{\\\"size\\\":\\\"100ml\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(273, 35, '250 ml', 'PRODUI-250ML-570', 11539.00, 32, '\"{\\\"size\\\":\\\"250ml\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(274, 35, '500 ml', 'PRODUI-500ML-435', 14539.00, 22, '\"{\\\"size\\\":\\\"500ml\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(275, 36, '100 ml', 'PRODUI-100ML-565', 10378.00, 12, '\"{\\\"size\\\":\\\"100ml\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(276, 36, '250 ml', 'PRODUI-250ML-972', 11878.00, 25, '\"{\\\"size\\\":\\\"250ml\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(277, 36, '500 ml', 'PRODUI-500ML-880', 14878.00, 14, '\"{\\\"size\\\":\\\"500ml\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(278, 37, '100 ml', 'PRODUI-100ML-686', 12294.00, 10, '\"{\\\"size\\\":\\\"100ml\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(279, 37, '250 ml', 'PRODUI-250ML-641', 13794.00, 25, '\"{\\\"size\\\":\\\"250ml\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(280, 37, '500 ml', 'PRODUI-500ML-790', 16794.00, 17, '\"{\\\"size\\\":\\\"500ml\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(281, 38, '100 ml', 'PRODUI-100ML-541', 5885.00, 21, '\"{\\\"size\\\":\\\"100ml\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(282, 38, '250 ml', 'PRODUI-250ML-973', 7385.00, 30, '\"{\\\"size\\\":\\\"250ml\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:15', '2025-12-02 15:05:15'),
(283, 38, '500 ml', 'PRODUI-500ML-480', 10385.00, 19, '\"{\\\"size\\\":\\\"500ml\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:16', '2025-12-02 15:05:16'),
(284, 39, '100 ml', 'PRODUI-100ML-416', 14418.00, 32, '\"{\\\"size\\\":\\\"100ml\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:16', '2025-12-02 15:05:16'),
(285, 39, '250 ml', 'PRODUI-250ML-994', 15918.00, 10, '\"{\\\"size\\\":\\\"250ml\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:16', '2025-12-02 15:05:16'),
(286, 39, '500 ml', 'PRODUI-500ML-111', 18918.00, 32, '\"{\\\"size\\\":\\\"500ml\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:16', '2025-12-02 15:05:16'),
(287, 40, '100 ml', 'PRODUI-100ML-450', 17647.00, 26, '\"{\\\"size\\\":\\\"100ml\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:16', '2025-12-02 15:05:16'),
(288, 40, '250 ml', 'PRODUI-250ML-328', 19147.00, 30, '\"{\\\"size\\\":\\\"250ml\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:16', '2025-12-02 15:05:16'),
(289, 40, '500 ml', 'PRODUI-500ML-131', 22147.00, 22, '\"{\\\"size\\\":\\\"500ml\\\",\\\"color\\\":null}\"', 1, '2025-12-02 15:05:16', '2025-12-02 15:05:16');

-- --------------------------------------------------------

--
-- Structure de la table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `comment` text DEFAULT NULL,
  `is_visible` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `role_user`
--

CREATE TABLE `role_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('avoGKzJ6OvEKseWoTLBAiLq2Aw8qj3bExdisXuVD', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiUjlWNm8wcGxhRTh0dENwSkRmZDB5TlpuSjJvaFd0VXN5Z215MHRwTiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NDoiY2FydCI7YToxOntpOjI7YTo0OntzOjQ6Im5hbWUiO3M6NDI6IlByb2R1aXQgMiAtIE5ldHRveWFnZXMgJiBFbnRyZXRpZW5zIExvY2F1eCI7czo1OiJwcmljZSI7czo3OiI5ODgzLjAwIjtzOjg6InF1YW50aXR5IjtpOjI7czo1OiJpbWFnZSI7Tjt9fXM6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6Mzg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kZXRhaWxzUHJvZHVjdC8yIjt9fQ==', 1764698165);

-- --------------------------------------------------------

--
-- Structure de la table `shippings`
--

CREATE TABLE `shippings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `carrier` varchar(255) NOT NULL,
  `tracking_number` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'processing',
  `shipping_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `imageProfil` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `imageProfil`, `email_verified_at`, `password`, `is_active`, `remember_token`, `created_at`, `updated_at`) VALUES
(11, 'YOBOUE', 'tiewamaruis@gmail.com', '0143633011', NULL, NULL, '$2y$12$0b47J7XWakbkWGsEMU2q4unbFQfO5nbs.tPqX0FX/GvYyMkLQBr4G', 1, NULL, '2025-11-28 11:54:57', '2025-11-28 11:54:57');

-- --------------------------------------------------------

--
-- Structure de la table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `wishlist_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `wishlists_products`
--

CREATE TABLE `wishlists_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `wishlist_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `addresses_user_id_foreign` (`user_id`);

--
-- Index pour la table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_slug_unique` (`slug`);

--
-- Index pour la table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Index pour la table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Index pour la table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`);

--
-- Index pour la table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_items_cart_id_foreign` (`cart_id`),
  ADD KEY `cart_items_product_id_foreign` (`product_id`),
  ADD KEY `cart_items_product_variant_id_foreign` (`product_variant_id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`),
  ADD KEY `categories_parent_id_foreign` (`parent_id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Index pour la table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_number_unique` (`order_number`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_address_id_foreign` (`address_id`);

--
-- Index pour la table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`),
  ADD KEY `order_items_product_variant_id_foreign` (`product_variant_id`);

--
-- Index pour la table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_order_id_foreign` (`order_id`);

--
-- Index pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_categories_id_foreign` (`categories_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`);

--
-- Index pour la table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Index pour la table `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_variants_sku_unique` (`sku`),
  ADD KEY `product_variants_product_id_foreign` (`product_id`);

--
-- Index pour la table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_product_id_foreign` (`product_id`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role_user_user_id_role_id_unique` (`user_id`,`role_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Index pour la table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Index pour la table `shippings`
--
ALTER TABLE `shippings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shippings_order_id_foreign` (`order_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Index pour la table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `wishlists_wishlist_id_product_id_unique` (`wishlist_id`,`product_id`),
  ADD KEY `wishlists_product_id_foreign` (`product_id`);

--
-- Index pour la table `wishlists_products`
--
ALTER TABLE `wishlists_products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `wishlists_products_wishlist_id_product_id_unique` (`wishlist_id`,`product_id`),
  ADD KEY `wishlists_products_product_id_foreign` (`product_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT pour la table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT pour la table `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=290;

--
-- AUTO_INCREMENT pour la table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `shippings`
--
ALTER TABLE `shippings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `wishlists_products`
--
ALTER TABLE `wishlists_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_product_variant_id_foreign` FOREIGN KEY (`product_variant_id`) REFERENCES `product_variants` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_address_id_foreign` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_variant_id_foreign` FOREIGN KEY (`product_variant_id`) REFERENCES `product_variants` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `products_categories_id_foreign` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `product_variants`
--
ALTER TABLE `product_variants`
  ADD CONSTRAINT `product_variants_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `shippings`
--
ALTER TABLE `shippings`
  ADD CONSTRAINT `shippings_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlists_wishlist_id_foreign` FOREIGN KEY (`wishlist_id`) REFERENCES `wishlists` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `wishlists_products`
--
ALTER TABLE `wishlists_products`
  ADD CONSTRAINT `wishlists_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlists_products_wishlist_id_foreign` FOREIGN KEY (`wishlist_id`) REFERENCES `wishlists` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
