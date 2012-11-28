<?php

    // configuration
    require("../includes/config.php"); 

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $club = query("SELECT * FROM clubs WHERE name=?", $_POST["club"])[0];
        $privacy = 1;
        if (!empty($_SESSION["id"]))
        {
            $user = query("SELECT * FROM users WHERE id=?", $_SESSION["id"])[0];
            $subscription = query("SELECT * FROM subscriptions WHERE userID=? AND clubID=?", $user["id"],$club["id"]);
            if(!empty($subscription))
            {
                $privacy = $subscription[0]["level"];
            }    
        }
        $announcements = query("SELECT * FROM announcements WHERE id=? AND privacy <= ?",$club["id"],$privacy);
        render("club_display.php",["club" => $club,"announcements" => $announcements]);
    }
    else
    {
        $clubs = query("SELECT * FROM clubs");
        render("clubs_page.php", ["title" => "All Clubs", "clubs" => $clubs]);
    }
?>
