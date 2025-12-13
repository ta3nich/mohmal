<?php

// -------------------------------------------------
// TIMEZONE
// -------------------------------------------------
date_default_timezone_set('Europe/Paris');

// -------------------------------------------------
// LOCALE
// -------------------------------------------------
$config['locale'] = 'en_US';

// -------------------------------------------------
// DEBUG MODE (ENABLE FOR TESTING)
// -------------------------------------------------
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// -------------------------------------------------
// IMAP SETTINGS — YANDEX
// -------------------------------------------------
$config['imap']['url'] = '{imap.yandex.com:993/imap/ssl}INBOX';
// Alternative outside Russia:
// $config['imap']['url'] = '{imap.ya.ru:993/imap/ssl}INBOX';

$config['imap']['username'] = 'yacinehasnaoui@yandex.com'; // FULL EMAIL
$config['imap']['password'] = 'xittifzfhydueqoy'; // NOT normal password

// -------------------------------------------------
// EMAIL DOMAINS
// -------------------------------------------------
$config['domains'] = array(
    'techxbox.eu.org',
    'itchigho.eu.org'
);

// -------------------------------------------------
// MESSAGE CLEANUP
// -------------------------------------------------
$config['delete_messages_older_than'] = '30 days ago';

// -------------------------------------------------
// BLOCKED USERNAMES
// -------------------------------------------------
$config['blocked_usernames'] = array(
    'root',
    'admin',
    'administrator',
    'hostmaster',
    'postmaster',
    'webmaster'
);

// -------------------------------------------------
// MESSAGE FORMAT
// -------------------------------------------------
$config['prefer_plaintext'] = true;

// -------------------------------------------------
// IMAP CONNECTION TEST
//

