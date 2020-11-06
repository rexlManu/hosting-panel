<header id="topnav" class="defaultscroll sticky">
    <div class="container">

        <div>
            <a class="logo" href="<?= $helper->url(); ?>">
                <img src="<?= $helper->cdnUrl(); ?>images/logo-dark.png" class="l-dark" height="16" alt="">
                <img src="<?= $helper->cdnUrl(); ?>images/logo-light.png" class="l-light" height="16" alt="">
            </a>
        </div>

        <?php if($user->sessionExists($_COOKIE['session_token'])){ ?>
            <div style="float: right;">
                <ul class="navigation-menu nav-light" id="navigation">
                    <li class="has-submenu">
                        <a href="javascript:void(0)"><?= $username; ?></a><span class="menu-arrow"></span>
                        <ul class="submenu">
                            <li><a href="<?= $helper->url(); ?>dashboard">Dashboard</a></li>
                            <li><a href="<?= $helper->url(); ?>tickets">Tickets</a></li>
                            <li><a href="<?= $helper->url(); ?>profile">Profil</a></li>
                            <li><a href="<?= $helper->url(); ?>status">Status</a></li>
                            <li><a href="<?= $helper->url(); ?>logout">Logout</a></li>
                            <?php if($user->isInTeam($_COOKIE['session_token'])){ ?>
                                <hr>
                                <li><a href="<?= $helper->url(); ?>team/users">Kunden</a></li>
                                <li><a href="<?= $helper->url(); ?>team/webspaces">Webspace</a></li>
                                <li><a href="<?= $helper->url(); ?>team/users">Tickets</a></li>
                                <li><a href="<?= $helper->url(); ?>team/node">Nodes</a></li>
                                <li><a href="<?= $helper->url(); ?>team/bots">Bots</a></li>
                            <?php } ?>
                        </ul>
                    </li>
                </ul>
            </div>
        <?php } else { ?>
            <div class="buy-button">
                <a href="<?= $helper->url(); ?>login" class="text-dark h6 mr-3 login">Login</a>
                <a href="<?= $helper->url(); ?>register" target="_blank" class="btn btn-primary">Account erstellen</a>
            </div>
        <?php } ?>

        <div class="menu-extras">
            <div class="menu-item">
                <a class="navbar-toggle">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
            </div>
        </div>

        <div id="navigation">
            <ul class="navigation-menu nav-light">

                <li><a href="<?= $helper->url(); ?>">Startseite</a></li>
                <li><a href="<?= $helper->url(); ?>webspace/order">Webspace</a></li>
                <li><a href="<?= $helper->url(); ?>bot/order">TS3AudioBot</a></li>

            </ul>
        </div>

    </div>
</header>
