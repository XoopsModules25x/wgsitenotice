<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/
/**
 * wgSitenotice module for xoops
 *
 * @copyright       XOOPS Project (https://xoops.org)
 * @license         GPL 2.0 or later
 * @package         wgsitenotice
 * @since           1.0
 * @min_xoops       2.5.11
 * @author          Goffy (xoops.wedega.com) - Email:<webmaster@wedega.com> - Website:<https://xoops.wedega.com>
 * @version         $Id: 1.0 modinfo.php 1 Fri 2015/02/20 12:43:29Z Goffy / wedega.com / XOOPS Development Team $
 */
// ---------------- Admin Main ----------------
\define('_MI_WGSITENOTICE_NAME', "Notification du site");
\define('_MI_WGSITENOTICE_DESC', "Ce module créé un site avec mentions légales (marque, vie privée, protection de données, ...)");
// ---------------- Admin Menu ----------------
\define('_MI_WGSITENOTICE_ADMENU1', "Tableau de bord");
\define('_MI_WGSITENOTICE_ADMENU2', "Versions");
\define('_MI_WGSITENOTICE_ADMENU3', "Contenus");
\define('_MI_WGSITENOTICE_ADMENU4', "Versions en ligne");
\define('_MI_WGSITENOTICE_ADMENU5', "A propos");
// ---------------- Admin Nav ----------------
\define('_MI_WGSITENOTICE_ADMINPAGER', "Page Administrateur");
\define('_MI_WGSITENOTICE_ADMINPAGER_DESC', "Liste par page des Administrateurs");
// Config
\define('_MI_WGSITENOTICE_EDITOR', "Éditeur");
\define('_MI_WGSITENOTICE_EDITOR_DESC', "Sélectionnez l'éditeur que vous souhaitez utiliser");
\define('_MI_WGSITENOTICE_TEMPLATE', "Thème");
\define('_MI_WGSITENOTICE_TEMPLATE_DESC', "Sélectionnez le thème que vous souhaitez utiliser");
\define('_MI_WGSITENOTICE_KEYWORDS', "Mots-clés");
\define('_MI_WGSITENOTICE_KEYWORDS_DESC', "Insérez ici les mots-clés (séparés par des virgules)");
\define('_MI_WGSITENOTICE_ADVERTISE', "Code d'avertissement");
\define('_MI_WGSITENOTICE_ADVERTISE_DESC', "Insérez ici le code d'avertissement");
\define('_MI_WGSITENOTICE_BOOKMARKS', "Réseaux sociaux");
\define('_MI_WGSITENOTICE_BOOKMARKS_DESC', "Afficher les Réseaux sociaux dans le formulaire");
\define('_MI_WGSITENOTICE_FBCOMMENTS', "Commentaires Facebook");
\define('_MI_WGSITENOTICE_FBCOMMENTS_DESC', "Autoriser les commentaires Facebook dans le formulaire");
\define('_MI_WGSITENOTICE_OC_SERVER', "Serveur standard pour la vérification en ligne");
\define('_MI_WGSITENOTICE_OC_SERVER_DESC', "Définissez le serveur standard, celui où vous voudrez rechercher les nouvelles versions de mentions légales et les télécharger");
\define('_MI_WGSITENOTICE_OC_ALLOWED', "Autoriser le téléchargement de vos notes légales");
\define('_MI_WGSITENOTICE_OC_ALLOWED_DESC', "Définissez, si vous voulez permettre à d'autres développeurs xoops de télécharger les notes légales de votre base de données");
\define('_MI_WGSITENOTICE_SHOWCOPYRIGHT', 'Présenter copyright');
\define('_MI_WGSITENOTICE_SHOWCOPYRIGHT_DESC', 'Vous pouvez retirer copyright de page index sitenotice, mais un lien retour à www.wedega.com attendent, ailleurs votre page internet');
// blocks
\define('_MI_WGSITENOTICE_B_ALL_VERSIONS', "Afficher toutes les versions disponibles");
//update
\define('_MI_WGSITENOTICE_UPGRADEFAILED', "Erreur lors de la mise à jour du module");
// ---------------- End ----------------