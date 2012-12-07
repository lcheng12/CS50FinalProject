<?php

    // configuration
    require("../includes/config.php");

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
                
        // insert new user into database
        $result = query("INSERT INTO users (name, password, email, admin, realname) VALUES(?, ?, ?, 0, ?)",
                     $_POST["username"], crypt($_POST["password"]), $_POST["email"], $_POST["first"]." ".$_POST["last"]);
        
        // if user not added, notify user      
        if($result === false)
        {
            echo("The new user could not be added.");
        }
        
        //obtain most recently allocated user id
        $rows = query("SELECT LAST_INSERT_ID() AS id");
        $id = $rows[0]["id"];
        
        // remember that the user is logged in by storing user's ID in session
        $_SESSION["id"] = $id;
        
        // redirect to portfolio
        redirect("/"); 
    }
    else
    {
        // else render form
        render("register_form.php", array("title" => "Register"));
    }
?>
