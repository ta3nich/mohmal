<?php
/*
 * input:
 * User $user       - User object
 * array $config    - config array
 * array $emails    - array of emails
 */

require_once './autolink.php';

$purifier_config = HTMLPurifier_Config::createDefault();
$purifier_config->set('HTML.Nofollow', true);
$purifier_config->set('HTML.ForbiddenElements', array("img"));
$purifier = new HTMLPurifier($purifier_config);

\Moment\Moment::setLocale($config['locale']);

$mailIds = array_map(function ($mail) { return $mail->id; }, $emails);
$mailIdsJoinedString = filter_var(join('|', $mailIds), FILTER_SANITIZE_SPECIAL_CHARS);

function niceDate($date) {
    $m = new \Moment\Moment($date, date_default_timezone_get());
    return $m->calendar();
}

function printMessageBody($email, $purifier) {
    global $config;

    $safeHtml = $purifier->purify($email->textHtml);
    $safeText  = \AutoLinkExtension::auto_link_text(nl2br(htmlspecialchars($email->textPlain)));

    $hasHtml = strlen(trim($safeHtml)) > 0;
    $hasText = strlen(trim($safeText)) > 0;

    if ($config['prefer_plaintext']) {
        echo $hasText ? $safeText : $safeHtml;
    } else {
        echo $hasHtml ? $safeHtml : $safeText;
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="a.validate.02" content="HZyTwk_SpyI44cwNY_omzitPOyj1PexnhR8r">
    <link rel="icon" type="image/svg+xml" href="assets/img/favicon.svg">
    <link rel="stylesheet" href="assets/bootstrap/4.1.1/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/fontawesome/v5.0.13/all.css">
    <link rel="stylesheet" href="assets/spinner.css">
    <link rel="stylesheet" href="assets/custom.css">
    <title><?php echo $emails ? "(" . count($emails) . ") " : ""; echo $user->address ?></title>
    <script>
        var mailCount = <?php echo count($emails) ?>;
        setInterval(function () {
            var r = new XMLHttpRequest();
            r.open("GET", "?action=has_new_messages&address=<?php echo $user->address ?>&email_ids=<?php echo $mailIdsJoinedString ?>", true);
            r.onreadystatechange = function () {
                if (r.readyState != 4 || r.status != 200) return;
                if (r.responseText > 0) {
                    document.getElementById("new-content-avalable").style.display = 'block';
                    if (mailCount === 0) location.reload();
                }
            };
            r.send();
        }, 15000);
    </script>
</head>
<body>

    <!-- <script async src="https://appsha-prm.ctengine.io/js/script.js?wkey=4n0OQUu6vw"></script> -->

    <div class="tgme_background_wrap">
        <canvas id="tgme_background" class="tgme_background default" width="50" height="50" data-colors="dbddbb,6ba587,d5d88d,88b884"></canvas>
        <div class="tgme_background_pattern default"></div>
    </div>

    <div id="new-content-avalable">
        <div class="alert alert-info alert-fixed" role="alert">
            <strong>New emails</strong> have arrived.
            <button type="button" class="btn btn-outline-secondary" onclick="location.reload()">
                <i class="fas fa-sync"></i> Reload!
            </button>
        </div>
        <div style="height: 3rem">&nbsp;</div>
    </div>

    <div style="width:100%;background:#343a40;padding:10px 0;text-align:center;">
        <iframe data-aa='2132882' src='//ad.a-ads.com/2132882?size=728x90' style='width:728px;height:90px;border:0;padding:0;overflow:hidden;background-color:transparent;display:inline-block;'></iframe>
    </div>

    <header>
        <div class="container">
            <nav class="navbar navbar-expand-md navbar-dark bg-dark">
                <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" aria-expanded="false" aria-controls="term_and_pivacy" href="#term_and_pivacy">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" aria-expanded="false" aria-controls="term_and_pivacy" href="#term_and_pivacy">Terms and Privacy</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="tools/"><i class="fas fa-tools"></i> Tools</a>
                        </li>
                    </ul>
                </div>
                <div class="mx-auto order-0">
                    <a class="navbar-brand mx-auto" href="#">
                        <img src="assets/img/w2.png" width="45" height="45" alt="Logo">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
                <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" aria-expanded="false" aria-controls="about_us" href="#about_us">About us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" aria-expanded="false" aria-controls="contact_us" href="#contact_us">Contact Us</a>
                        </li>
                        <li class="nav-item d-flex align-items-center pl-2">
                            <img src="https://visitor-badge.laobi.icu/badge?page_id=mohmal.eu.org" alt="visitor count" style="vertical-align:middle">
                        </li>
                    </ul>
                </div>
            </nav>

            <p class="lead">Your disposable mailbox is ready.</p>

            <div class="columnsn">
                <div class="cardn flow1">
                    <div class="my-address-block">
                        <span id="my-address"><?php echo $user->address ?></span>
                        &nbsp;<button class="copy-button" data-clipboard-target="#my-address">Copy</button>
                    </div>
                </div>
                <div class="cardn2 flow2">
                    <button type="button" class="change-button" data-toggle="collapse" title="choose your own address"
                        data-target=".change-address-toggle" aria-controls="address-box-normal address-box-edit" aria-expanded="false">
                        <i class="fas fa-magic"></i> Change address
                    </button>
                </div>
            </div>

            <form class="collapse change-address-toggle" id="address-box-edit" action="?action=redirect" method="post">
                <div class="card">
                    <div class="card-body">
                        <p>
                            <a href="?action=random" role="button" class="btn btn-dark">
                                <i class="fa fa-random"></i> Open random mailbox
                            </a>
                        </p>
                        or create your own address:
                        <div class="form-row align-items-center">
                            <div class="col-sm">
                                <label class="sr-only" for="inlineFormInputName">username</label>
                                <input name="username" type="text" class="form-control" id="inlineFormInputName"
                                    placeholder="username" value="<?php echo $user->username ?>">
                            </div>
                            <div class="col-sm-auto my-1">
                                <label class="sr-only" for="inlineFormInputGroupUsername">Domain</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">@</div>
                                    </div>
                                    <select class="custom-select" id="inlineFormInputGroupUsername" name="domain">
                                        <?php foreach ($config['domains'] as $aDomain): ?>
                                            <option value="<?php echo $aDomain ?>"<?php echo $aDomain === $user->domain ? ' selected' : '' ?>><?php echo $aDomain ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-auto my-1">
                                <button type="submit" class="btn btn-primary">Open mailbox</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </header>

    <main>
        <div class="container">
            <div class="main-col">
                <div id="email-list" class="list-group" style="background:var(--card-bg);border:1px solid var(--card-border);border-radius:var(--radius);overflow:hidden;backdrop-filter:blur(8px);">
                    <?php foreach ($emails as $email):
                        $safe_email_id = filter_var($email->id, FILTER_VALIDATE_INT); ?>
                    <a class="list-group-item list-group-item-action email-list-item"
                        style="background:transparent;color:var(--text-primary);border-color:var(--card-border);"
                        data-toggle="collapse" href="#mail-box-<?php echo $email->id ?>"
                        role="button" aria-expanded="false" aria-controls="mail-box-<?php echo $email->id ?>">
                        <div class="media">
                            <button class="btn btn-white open-collapse-button">
                                <i class="fas fa-caret-right expand-button-closed"></i>
                                <i class="fas fa-caret-down expand-button-opened"></i>
                            </button>
                            <div class="media-body">
                                <h6 class="list-group-item-heading">
                                    <?php echo filter_var($email->fromName, FILTER_SANITIZE_SPECIAL_CHARS) ?>
                                    <span class="text-muted"><?php echo filter_var($email->fromAddress, FILTER_SANITIZE_SPECIAL_CHARS) ?></span>
                                    <small class="float-right" title="<?php echo $email->date ?>"><?php echo niceDate($email->date) ?></small>
                                </h6>
                                <p class="list-group-item-text text-truncate" style="width:75%">
                                    <?php echo filter_var($email->subject, FILTER_SANITIZE_SPECIAL_CHARS) ?>
                                </p>
                            </div>
                        </div>
                    </a>
                    <div id="mail-box-<?php echo $email->id ?>" class="card-collapse collapse" role="tabpanel" aria-expanded="true">
                        <div class="card-body">
                            <div class="card-block email-body">
                                <div class="float-right primary">
                                    <a class="btn btn-outline-primary btn-sm" download="true" role="button"
                                        href="?action=download_email&email_id=<?php echo $safe_email_id ?>&address=<?php echo $user->address ?>">Download</a>
                                    <a class="btn btn-outline-danger btn-sm" role="button"
                                        href="?action=delete_email&email_id=<?php echo $safe_email_id ?>&address=<?php echo $user->address ?>">Delete</a>
                                </div>
                                <?php printMessageBody($email, $purifier); ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>

                    <?php if (empty($emails)): ?>
                    <div id="empty-mailbox">
                        <p>The mailbox is empty. Checking for new emails automatically.</p>
                        <div class="spinner">
                            <div class="rect1"></div>
                            <div class="rect2"></div>
                            <div class="rect3"></div>
                            <div class="rect4"></div>
                            <div class="rect5"></div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>

    <footer style="background-color:#343a40 !important;">
        <div class="container">
            <small class="text-justify quick-summary" style="color:#fff;">
                This is a disposable mailbox service. Whoever knows your username, can read your emails.
                Emails will be deleted after 30 days.
                <a data-toggle="collapse" href="#about" aria-expanded="false" aria-controls="about">Show Details</a>
            </small>

            <div id="omh">
                <div id="term_and_pivacy" data-parent="#omh" class="card card-body collapse" style="max-width:40rem">
                    <p class="text-justify">By using the temporary email address services provided by mohmal.eu.org, you agree to be bound by the terms and conditions contained below.</p>
                    <p>Generally, this service prohibits:</p>
                    <p>Any illegal activity. The use of bots of any kind. Over-use our resources by repeatedly making many requests to our servers. Reverse engineer, circumvent or attack our website for the purpose of gaining unauthorised privileges. Use of our service for purposes other than intended.</p>
                    <p>This service prohibits messages that are unsolicited commercial email (spam), harassing, abusive, defamatory, obscene, or otherwise illegal content, distribute trojans or malicious software, intend to commit fraud, phishing, or scams, distribute intellectual property without ownership or license, or breach the terms of service of this website or the recipients'.</p>
                    <p>mohmal.eu.org provides an inbound-only email service. It is not possible for users to send emails from our service.</p>
                    <p>mohmal.eu.org provides temporary email accounts without user registration. Accounts are not password-protected and can be accessed by anyone who knows the email address. Emails sent here should be considered public.</p>
                    <p>Our domain names may be changed or removed at any time without warning. All email addresses are temporary.</p>
                    <p>mohmal.eu.org has no control over third party resources and is not responsible for their content. We have no control over and are not responsible for any content of email messages, including attachments.</p>
                    <p>We do not perform malware scanning on emails or attachments. All emails are to be considered unsafe and opened at your own risk.</p>
                    <p>For abuse prevention we keep logs of email addresses created, the IP address used, and the date &amp; time. We will keep these logs as long as necessary. If you abuse our service, we may provide these logs to authorities where an appropriate court order has been provided.</p>
                    <p>Complaints or abuse reports should be reported via Session Messenger. Our Session ID is 059b96edf17642a8539e09088f103541ada3208ebfd839e9ae500ef43898917d02. We may take up to 90 days to process reports.</p>
                    <p>This site uses a session cookie to maintain application state. Cookies may also be set by third party services for ad delivery and tracking.</p>
                    <p>This service is provided "as is" without any express or implied warranties.</p>
                </div>

                <div id="about_us" data-parent="#omh" class="card card-body collapse" style="max-width:40rem">
                    <p class="text-justify">About us.</p>
                </div>

                <div id="contact_us" data-parent="#omh" class="card card-body collapse" style="max-width:40rem">
                    <p class="text-justify">Contact Us.</p>
                </div>
            </div>


            <div id="accor">
                <div class="card card-body collapse" id="about" style="max-width:40rem">
                    <p class="text-justify">This disposable mailbox keeps your main mailbox clean from spam.</p>
                    <p class="text-justify">Just choose an address and use it on websites you don't trust. Once you are done, forget about the mailbox — all the spam stays here.</p>
                    <p class="text-justify">There is no registration and no passwords. If you know the address, you can read the emails. <strong>Basically, all emails are public. So don't use it for sensitive data.</strong></p>
                </div>
            </div>

            <p><small>Powered by <a href=""><strong>H - Yacine-84</strong></a></small></p>
        </div>
    </footer>

    <script src="assets/jquery/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="assets/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="assets/bootstrap/4.1.1/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <script src="assets/clipboard.js/clipboard.min.js" integrity="sha384-8CYhPwYlLELodlcQV713V9ZikA3DlCVaXFDpjHfP8Z36gpddf/Vrt47XmKDsCttu" crossorigin="anonymous"></script>
    <script>
        var clipboard = new ClipboardJS('[data-clipboard-target]');
        $(function () { $('[data-tooltip="tooltip"]').tooltip(); });
        clipboard.on('success', function (e) {
            $(e.trigger).attr('title', 'Copied!').tooltip('_fixTitle').tooltip('show').tooltip('_fixTitle');
            e.clearSelection();
        });
    </script>

    <div style="width:100%;text-align:center;padding:16px 0 8px;background:#f8f9fa;">
        <div id="frame" style="width:70%;margin:auto;position:relative;z-index:99998;">
            <div style="width:100%;text-align:left;position:absolute;left:0;right:0;top:-24px;">
                <a style="display:inline-block;font-size:13px;color:#263238;padding:4px 10px;background:#F8F8F9;text-decoration:none;border-radius:4px 4px 0 0;"
                    id="frame-link" target="_blank"
                    href="https://aads.com/campaigns/new?source_id=2420628&source_type=ad_unit&partner=2420628">
                    Advertise here
                </a>
            </div>
            <iframe data-aa=2420628 src=//acceptable.a-ads.com/2420628/?size=Adaptive style='border:0;padding:0;width:100%;height:auto;overflow:hidden;margin:auto;display:block;'></iframe>
        </div>
    </div>

</body>
</html>
