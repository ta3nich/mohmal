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
// IMAP SETTINGS — MAILO
// -------------------------------------------------
$config['imap']['url'] = '{mail.mailo.com:993/imap/ssl}INBOX';
$config['imap']['username'] = 'mohmal@mailo.com'; // FULL MAILO EMAIL
$config['imap']['password'] = 'testpassw0rdDZA*'; // Your Mailo password or app password

// -------------------------------------------------
// EMAIL DOMAINS
// -------------------------------------------------
$config['domains'] = array(
    "bitcoin-plazza.eu.org",
    "itchigho.eu.org",
    "techxbox.eu.org",
    "youoneshell.eu.org",
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
// -------------------------------------------------
