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
 * @version         $Id: 1.0 admin.php 1 Fri 2015/02/20 12:43:29Z Goffy / wedega.com / XOOPS Development Team $
 */
// ---------------- Admin Index ----------------
\define('_AM_WGSITENOTICE_STATISTICS', "Statistiques");
// There are
\define('_AM_WGSITENOTICE_THEREARE_VERSIONS', "Il y a <span class='bold'>%s</span> versions dans la base de données");
\define('_AM_WGSITENOTICE_THEREARE_CONTENTS', "Il y a <span class='bold'>%s</span> contenus dans la base de données");
// ---------------- Admin Files ----------------
// There aren't
\define('_AM_WGSITENOTICE_THEREARENT_VERSIONS', "Il n'y a pas de version");
\define('_AM_WGSITENOTICE_THEREARENT_CONTENTS', "Il n'y a pas de contenu");
// Save/Delete
\define('_AM_WGSITENOTICE_FORMOK', "Enregistré avec succès");
\define('_AM_WGSITENOTICE_FORMDELOK', "Supprimé avec succès ");
\define('_AM_WGSITENOTICE_FORMSUREDEL', "Etes-vous certain de vouloir supprimer : <b><span style='color : Red'>%s </span></b>");
\define('_AM_WGSITENOTICE_FORMSURERENEW', "Etes-vous certain de vouloir mettre à jour : <b><span style='color : Red'>%s </span></b>");
// Lists
\define('_AM_WGSITENOTICE_VERSIONS_LIST', "Liste des versions");
\define('_AM_WGSITENOTICE_CONTENTS_LIST', "Liste des contenus");
// ---------------- Admin Classes ----------------
// Versions add/edit
\define('_AM_WGSITENOTICE_VERSION_ADD', "Ajouter une version");
\define('_AM_WGSITENOTICE_VERSION_EDIT', "Supprimer une version");
// Elements of Versions
\define('_AM_WGSITENOTICE_VERSION_ID', "ID");
\define('_AM_WGSITENOTICE_VERSION_NAME', "Nom");
\define('_AM_WGSITENOTICE_VERSION_LANG', "Langue / Pays");
\define('_AM_WGSITENOTICE_VERSION_DESCR', "Description :&nbsp;");
\define('_AM_WGSITENOTICE_VERSION_AUTHOR', "Auteur");
\define('_AM_WGSITENOTICE_VERSION_WEIGHT', "Poid");
\define('_AM_WGSITENOTICE_VERSION_CURRENT', "Afficher cette version (blocs, menu");
\define('_AM_WGSITENOTICE_VERSION_ONLINE', "Autoriser le téléchargement");
\define('_AM_WGSITENOTICE_VERSION_DATE', "Date");
// Contents add/edit
\define('_AM_WGSITENOTICE_CONTENT_ADD', "Ajouter du contenu");
\define('_AM_WGSITENOTICE_CONTENT_EDIT', "Supprimer le contenu");
// Elements of Contents
\define('_AM_WGSITENOTICE_CONT_ID', "ID");
\define('_AM_WGSITENOTICE_CONT_VERSION_ID', "Version :&nbsp;");
\define('_AM_WGSITENOTICE_CONT_HEADER', "Entête");
\define('_AM_WGSITENOTICE_CONT_TEXT', "Texte");
\define('_AM_WGSITENOTICE_CONT_WEIGHT', "Poid");
\define('_AM_WGSITENOTICE_CONT_DATE', "Date");
//Check online versions
\define('_AM_WGSITENOTICE_OC', "Versions en ligne");
\define('_AM_WGSITENOTICE_OC_DISCLAIMER', "Règlement");
\define('_AM_WGSITENOTICE_OC_DISCLAIMER_DESCR', "Il n'y a aucune garantie pour toute ou partie des mentions légales téléchargées.  Les versions de texte légales ne sont qu'une suggestion.<br/>Veuillez vérifier avant de les utiliser, si ces suggestions sont conformes aux dispositions légales et remplissent les exigences légales, des instructions et directives pertinentes.<br/>Vous les utilisez à vos risques et périls.");
\define('_AM_WGSITENOTICE_OC_FORM', "Rechercher les versions en ligne disponibles");
\define('_AM_WGSITENOTICE_OC_SERVER', "Serveur standard pour la vérification en ligne");
\define('_AM_WGSITENOTICE_OC_START', "Commencer à rechercher les versions en ligne disponibles");
\define('_AM_WGSITENOTICE_OC_RESULT', "Sur le serveur désigné, versions disponibles de mentions légales");
\define('_AM_WGSITENOTICE_OC_ERR_FORBIDDEN', "Désolé, mais le serveur désigné n'autorise pas le téléchargement de ses versions de mentions légales");
\define('_AM_WGSITENOTICE_OC_ERR_NO_VERSIONS', "Désolé, mais sur le serveur désigné il n'existe aucune version de mentions légales en téléchargement.");
\define('_AM_WGSITENOTICE_OC_ERR_INVALID_PARAM', "Désolé, la requête a échoué à cause d'un paramètre non valide");
\define('_AM_WGSITENOTICE_OC_ERR_CONNECT', "Désolée, la requête au serveur désigné '%s' a échoué.<br/>Veuillez rechercher un serveur standard dans les paramètres du module");
\define('_AM_WGSITENOTICE_OC_ERR_READ_XML', "Désolé, une erreur est survenue lors de la lecture / l'analyse du code xml");
\define('_AM_WGSITENOTICE_OC_ERR_ADDCONT', "%e erreur(s) est survenue lors de l'ajout du contenu à votre base de données");
// General
\define('_AM_WGSITENOTICE_FORMACTION', "Action");
\define('_AM_WGSITENOTICE_FORMDOWNLOAD', "T&#233;l&#233;charger");
// ---------------- Admin Others ----------------
\define('_AM_WGSITENOTICE_MAINTAINEDBY', "est maintenu par");
// ---------------- End ----------------