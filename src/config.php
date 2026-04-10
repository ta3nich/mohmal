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
    //"bitcoin-plazza.eu.org",
    //"itchigho.eu.org",
    //"techxbox.eu.org",
    //"youoneshell.eu.org",
    "ziw0tempemail.eu.org",
    "ziw05tempemail.eu.org",
    "techstreet07.eu.org",
    "lg-salmi.nl.eu.org",
    "alpha-sig.eu.org",
    "alpha804.eu.org",
    "beta-sig.eu.org",
    "bitcoin-plazza.eu.org",
    "c0rner-bit.eu.org",
    "dark0s-market.eu.org",
    "gamma-sig.eu.org",
    "iblogg.eu.org",
    "m0rd05.eu.org",
    "sec4891.eu.org",
    "vaya.eu.org",
    "w0rld.int.eu.org,
   
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
