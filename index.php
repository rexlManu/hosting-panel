<?php
ob_start();
session_start();

include_once './vendor/autoload.php';

use Symfony\Component\Dotenv\Dotenv;

$date = new DateTime(null, new DateTimeZone('Europe/Berlin'));
$datetime = $date->format('Y-m-d H:i:s');

$dotenv = new Dotenv();
$dotenv->load(__DIR__.'/.env');

/*
 * config
 */
include 'app/controller/config.php';
include_once 'app/functions/autoload.php';

include_once 'app/notifications/sendMail.php';

/*
 * page manager
 */
$resources = 'resources/';
$sites = $resources.'sites/';
$auth = $resources.'auth/';
$customer = $resources.'customer/';
$team = $resources.'team/';

$page = $helper->protect($_GET['page']);

if(isset($_GET['page'])) {
    switch ($page) {

        default: include($sites."404.php");  break;

        //auth
        case "auth_login": include($auth."login.php");  break;
        case "auth_register": include($auth."register.php"); break;
        case "auth_logout": setcookie('session_token', null, time(),'/'); header('Location: '.$helper->url().'login'); break;
        case "auth_activate": include($auth."activate.php"); break;
        case "auth_forgot_password": include($auth."forgot_password.php"); break;

        //index
        case "main_page": include($sites."main_page.php");  break;
        case "dashboard": include($customer."dashboard.php");  break;
        case "status": include($customer."status.php");  break;
        case "profile": include($customer."profile.php");  break;

        //bot
        case "bot_order": include($customer . "bot/order.php");  break;
        case "bot": include($customer . "bot/index.php");  break;

        //webspace
        case "webspace_order": include($customer."webspace/order.php");  break;
        case "webspace_manage": include($customer."webspace/manage.php");  break;
        case "webspace_renew": include($customer."webspace/renew.php");  break;

        //
        case "impressum": include($sites."impressum.php");  break;
        case "datenschutz": include($sites."datenschutz.php");  break;
        case "agb": include($sites."agb.php");  break;

        //tickets
        case "tickets": include($customer."support/tickets.php");  break;
        case "ticket": include($customer."support/ticket.php");  break;

        //team
        case "team_tickets": include($team."tickets.php");  break;
        case "team_ticket": include($team."ticket.php");  break;
        case "team_users": include($team."users.php");  break;
        case "team_user": include($team."user.php");  break;
        case "team_webspaces": include($team."webspaces.php");  break;
        case "team_bots": include($team."bots.php");  break;
        case "team_bot": include($team."bot.php");  break;
        case "team_nodes": include($team."nodes.php");  break;
        case "team_node": include($team."node.php");  break;

    }

    include 'resources/additional/footer.php';

} else {
    die('please enable .htaccess on your server');
}
