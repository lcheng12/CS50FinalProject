<?php /*<!DOCTYPE html>

<html>

    <head>

        <link href="css/bootstrap.css" rel="stylesheet"/>
        <link href="css/bootstrap-responsive.css" rel="stylesheet"/>
        <link rel="stylesheet" href="css/jquery-ui.css" />
        <link href="css/jquery-ui-timepicker-addon.css" rel="stylesheet"/>
        <link href="css/styles.css" rel="stylesheet"/>
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
        
        <?php if (isset($title)): ?>
            <title><?= htmlspecialchars($title) ?></title>
        <?php else: ?>
            <title></title>
        <?php endif ?>

   
        <script src="http://code.jquery.com/jquery-1.8.3.js"></script>
        <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
        <script type="text/javascript" src="js/jquery-1.8.2.js"></script>
        <script type="text/javascript" src="js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui-timepicker-addon.js"></script>
        <script type="text/javascript" src="js/jquery-ui-sliderAccess.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/scripts.js"></script>
        <script>
            $(document).ready(function(){
                $(".datetime").hover(function(){
                    $(this).datetimepicker({controlType: 'select', timeFormat: 'hh:mm tt', stepMinute: 5});
                });
            });
        </script>
        <script> function myTest(){alert ("hi")}</script>
    </head>

    <body>

        <div class="container-fluid">

            <div id="top">

            </div>

            <div id="middle">
                <?php
                    // include links to main pages on home page
                ?>
            <div>

                <ul class="nav nav-pills">
                   
                   <li><a href="allClubs.php"> All Clubs </a></li>
                   <li><a href="viewAnnouncements.php"> Recent Announcements </a></li>
                    <?php
                        
                        // links to login and register page only if no user logged in currently
                        if (empty($_SESSION["id"]))
                        {
                            print("<li><a href=\"login.php\"> Log In </a></li>");
                            print("<li><a href=\"register.php\"> Register </a></li>");
                        }
                        
                        //links that apply only when someone is currently logged in
                        else
                        {

                            print("<li><a href=\"createClub.php\">Register New Club</a></li>");
                            
                            $rows = query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);
                            if($rows[0]["admin"])
                            {
                                print("<li><a href=\"makeEvent.php\">Make an Event</a></li>");
                                print("<li><a href=\"makeAnnouncement.php\">Make an Announcement</a></li>");
                            }
                            
                            print("<li><a href=\"logout.php\"> Log Out </a></li>");
                        }
                    ?>
                </ul>

            </div>

*/
?>
<!DOCTYPE html>


<html>

    <head>

    <style type="text/css">

    html, body, .container, .content {
        height: 100%;
    }

    .container, .content {
        position: relative;
    }

    .proper-content {
        padding-top: 40px; /* >= navbar height */
    }

    .wrapper {
        min-height: 100%;
        height: auto !important;
        height: 100%;
        margin: 0 auto -50px; /* same as the footer */
    }

    .push {
        height: 50px; /* same as the footer */
    }

    .footer-wrapper {
        position: relative;
        height: 50px;
        background-color:#ffddcc;
        margin:0;
        padding:0;

    }
    .club-header
{
    padding: 30px;
    font-size: 18px;
    font-weight: 200;
    line-height: 30px;
    color: inherit;
    text-align:left;

}

.club-header h1
{
    margin-bottom: 0;
    font-size: 50px;
    line-height: 1;
    letter-spacing: -1px;
    color: inherit;
}

.club-header h1 small
{
    margin-bottom: 0;
    font-size: 26px;
    font-weight: 300;
    font-color: #999999;
}

    .page-header
    {
        text-align:center;
    }

    .page-header h1
    {
        font-size: 100px;
        font-weight: 500;
        letter-spacing: -5px;
        color: #333333;
    }

    .page-header p
    {
        font-size: 20px;
        font-weight: 200;
        letter-spacing: 1px;
        color: #999999;
        line-height: 3;
    }


    .tab-content
    {
        height:500px;
        overflow-y:auto;
        text-align:center;
    }

    .dropdown
{
    text-align:left;
}

    </style>

        <link href="css/bootstrap.css" rel="stylesheet"/>
        <link href="css/bootstrap-responsive.css" rel="stylesheet"/>
        <link href="css/jquery-ui.css" rel="stylesheet"/>
        <link href="css/jquery-ui-timepicker-addon.css" rel="stylesheet"/>
        <link rel="stylesheet" href="css/styles.css" />
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
        
        <?php if (isset($title)): ?>
            <title><?= htmlspecialchars($title) ?></title>
        <?php else: ?>
            <title></title>
        <?php endif ?>

   
        <script src="http://code.jquery.com/jquery-1.8.3.js"></script>
        <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>     
        <script type="text/javascript" src="js/jquery-1.8.2.js"></script>
        <script type="text/javascript" src="js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui-timepicker-addon.js"></script>
        <script type="text/javascript" src="js/jquery-ui-sliderAccess.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/scripts.js"></script>
        <script>
            $(document).ready(function(){
                $(".datetime").hover(function(){
                    $(this).datetimepicker({controlType: 'select', timeFormat: 'hh:mm tt', stepMinute: 5});
                });
            });
        </script>
    </head>

    <body>

        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">

                <div class="container">

                    <a class="brand" href="index.php">CS50 Organizations</a>

                    <!--IF LOGGED IN-->
                    <?php if (isset($_SESSION["id"])): 
                        $myclubs = query("SELECT * FROM subscriptions JOIN clubs WHERE userID = ? AND subscriptions.ClubID = clubs.id", $_SESSION["id"]);?>

                    <ul class="nav" style:>
                        <li class="dropdown pull-left">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                Clubs
                                <b class="caret"></b>
                            </a>
                        
                            <ul class="dropdown-menu">
                                <li class="nav-header">My Clubs</li>

                                <?php foreach ($myclubs as $club){
                                    print("<li><a href=\"allClubs.php?club=".str_replace(" ", "+", $club["name"])."\">".$club["name"]."</a></li>");

                                }?>

                                <li class="nav-header">Manage Clubs</li>
                                <li><a href="makeAnnouncement.php"> Make Announcement </a></li>
                                <li><a href="createClub.php"> Create Club </a></li>
                                <li><a href="makeEvent.php"> Create Event </a></li>
                                <li class="divider"></li>
                                <li><a href="allClubs.php"> All Clubs </a></li>
                            </ul>
                        </li>
                    </ul>

                    <form class="navbar-search pull-left">
                        <input type="text" class="search-query" placeholder="Search clubs and events">
                    </form>

                    <ul class="nav pull-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-user"></i>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="login.php"> Connect via Facebook </a></li>
                                <li><a href="login.php"> Connect via Google </a></li>
                                <li class="divider"></li>
                                <li><a href="logout.php"> Account Settings </a></li>
                                <li><a href="logout.php"> Log Out </a></li>
                            </ul>
                        </li>
                        </ul>

                    <!--IF NOT LOGGED IN-->
                    <?php else: ?>

<ul class="nav" style:>
<li class="dropdown pull-left">
<a href="#" class="dropdown-toggle" data-toggle="dropdown">
Clubs
<b class="caret"></b>
</a>

<ul class="dropdown-menu">
    <li><a href="allClubs.php"> All Clubs </a></li>
</ul>
</li>
</ul>

                        <form class="navbar-search pull-left">
                            <input type="text" class="search-query" placeholder="Search site">
                        </form>

                        <ul class="nav pull-right"> 
                            <li><a href="login.php"> <img src="img/harvard_icon.gif"> Login via HUID </a></li>
                        </ul>
                    <?php endif; ?>


                </div>                
            </div>
        </div>	
</body>
        <div class="container">

            <div class="content" style="padding-top:40px">

                <div class="wrapper">
                    <div class="proper-content">
     

