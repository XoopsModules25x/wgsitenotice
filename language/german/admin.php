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
 */
// ---------------- Admin Index ----------------
\define('_AM_WGSITENOTICE_STATISTICS', 'Statistik');
// There are
\define('_AM_WGSITENOTICE_THEREARE_VERSIONS', "Es gibt <span class='bold'>%s</span> Versionen in der Datenbank");
\define('_AM_WGSITENOTICE_THEREARE_CONTENTS', "Es gibt <span class='bold'>%s</span> Inhalte in der Datenbank");
// ---------------- Admin Files ----------------
// There aren't
\define('_AM_WGSITENOTICE_THEREARENT_VERSIONS', 'Es sind keine Versionen verfügbar');
\define('_AM_WGSITENOTICE_THEREARENT_CONTENTS', 'Es sind keine Inhalte verfügbar');
// Save/Delete
\define('_AM_WGSITENOTICE_FORMOK', 'Erfolgreich gespeichert');
\define('_AM_WGSITENOTICE_FORMDELOK', 'Erfolgreich gelöscht');
\define('_AM_WGSITENOTICE_FORMSUREDEL', "Wollen Sie wirklich löschen: <b><span style='color : Red;'>%s </span></b>");
\define('_AM_WGSITENOTICE_FORMSURERENEW', "Wollen Sie wirklichen aktualisieren: <b><span style='color : Red;'>%s </span></b>");
// Lists
\define('_AM_WGSITENOTICE_VERSIONS_LIST', 'Liste der Versionen');
\define('_AM_WGSITENOTICE_CONTENTS_LIST', 'Liste der Inhalte');
// ---------------- Admin Classes ----------------
// Versions add/edit
\define('_AM_WGSITENOTICE_VERSION_ADD', 'Version hinzufügen');
\define('_AM_WGSITENOTICE_VERSION_EDIT', 'Version bearbeiten');
// Elements of Versions
\define('_AM_WGSITENOTICE_VERSION_ID', 'Version-Id');
\define('_AM_WGSITENOTICE_VERSION_NAME', 'Name');
\define('_AM_WGSITENOTICE_VERSION_LANG', 'Sprache / Land');
\define('_AM_WGSITENOTICE_VERSION_DESCR', 'Beschreibung');
\define('_AM_WGSITENOTICE_VERSION_AUTHOR', 'Author');
\define('_AM_WGSITENOTICE_VERSION_WEIGHT', 'Reihung');
\define('_AM_WGSITENOTICE_VERSION_CURRENT', 'Version anzeigen');
\define('_AM_WGSITENOTICE_VERSION_ONLINE', 'Download erlauben');
\define('_AM_WGSITENOTICE_VERSION_DATE', 'Datum');
// Contents add/edit
\define('_AM_WGSITENOTICE_CONTENT_ADD', 'Inhalt hinzufügen');
\define('_AM_WGSITENOTICE_CONTENT_EDIT', 'Inhalt bearbeiten');
// Elements of Contents
\define('_AM_WGSITENOTICE_CONT_ID', 'Id');
\define('_AM_WGSITENOTICE_CONT_VERSION_ID', 'Version');
\define('_AM_WGSITENOTICE_CONT_HEADER', 'Überschrift');
\define('_AM_WGSITENOTICE_CONT_TEXT', 'Text');
\define('_AM_WGSITENOTICE_CONT_WEIGHT', 'Reihung');
\define('_AM_WGSITENOTICE_CONT_DATE', 'Datum');
//Check online versions
\define('_AM_WGSITENOTICE_OC', 'Online Versionen');
\define('_AM_WGSITENOTICE_OC_DISCLAIMER', 'Haftungshinweis');
\define('_AM_WGSITENOTICE_OC_DISCLAIMER_DESCR', 'Es wird keine Garantie für die Richtigkeit der heruntergeladenenen rechtlichen Hinweise bzw. Teile davon übernommen.<br/>
Die Texte stellen nur einen Vorschlag dar. Bitte überprüfen Sie vor deren Verwendung, ob diese Vorschläge den gesetzlichen Vorschriften, rechtlichen Voraussetzungen, Bestimmungen oder Richtlinien entsprechen.<br/>
Die Verwendung erfolgt auf eigene Gefahr.');
\define('_AM_WGSITENOTICE_OC_FORM', 'Überprüfung auf verfügbare Online-Versionen');
\define('_AM_WGSITENOTICE_OC_SERVER', 'Standard-Server für die Online-Überprüfung');
\define('_AM_WGSITENOTICE_OC_START', 'Starte Überprüfung auf verfügbare Online-Versionen');
\define('_AM_WGSITENOTICE_OC_RESULT', 'Auf dem angeführten Server sind folgende Online-Versionen verfügbar');
\define('_AM_WGSITENOTICE_OC_ERR_FORBIDDEN',
       'Entschuldigung, aber der angeführte Server gestattet den Download der dort vorhandenen Versionen nicht');
\define('_AM_WGSITENOTICE_OC_ERR_NO_VERSIONS',
       'Entschuldigung, aber auf dem angeführten Server sind keine Versionen für den Download verfügbar');
\define('_AM_WGSITENOTICE_OC_ERR_INVALID_PARAM',
       'Entschuldigung, aber die Anfrage ist aufgrund eines ungültigen Parameters fehlgeschlagen');
\define('_AM_WGSITENOTICE_OC_ERR_CONNECT', "Entschuldigung, aber die Anfrage an den angeführten Server '%s' ist fehlgeschlagen.<br/>Bitte überprüfen Sie den Standardserver in den Moduleinstellungen");
\define('_AM_WGSITENOTICE_OC_ERR_READ_XML', 'Entschuldigung, beim Lesen/Parsen des xml-Codes ist ein Fehler aufgetreten');
\define('_AM_WGSITENOTICE_OC_ERR_ADDCONT', 'Beim Hinzufügen der Inhalte in die Datenbank sind %e Fehler aufgetreten');
// General
\define('_AM_WGSITENOTICE_FORMACTION', 'Aktion');
\define('_AM_WGSITENOTICE_FORMDOWNLOAD', 'Download');
// ---------------- Admin Others ----------------
\define('_AM_WGSITENOTICE_MAINTAINEDBY', ' wird unterstützt durch ');
// ---------------- End ----------------
