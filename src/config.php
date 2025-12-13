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

// OPTIONAL: log errors to file
// ini_set('log_errors', 1);
// ini_set('error_log', __DIR__ . '/php-error.log');

// -------------------------------------------------
// IMAP SETTINGS
// -------------------------------------------------
$config['imap']['url'] = '{outlook.office365.com:993/imap/ssl}INBOX';
$config['imap']['username'] = 'nano-s0ft@outlook.com';
$config['imap']['password'] = 'testpassw0rdDZA*';

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
// OPTIONAL: IMAP CONNECTION DEBUG TEST
// -------------------------------------------------
$imap = @imap_open(
    $config['imap']['url'],
    $config['imap']['username'],
    $config['imap']['password']
);

if (!$imap) {
    echo '<pre>';
    echo "IMAP CONNECTION FAILED\n";
    echo imap_last_error() . "\n";
    print_r(imap_errors());
    echo '</pre>';
} else {
    echo "IMAP connection successful.";
    imap_close($imap);
}
