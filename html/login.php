<?php

/**
  Login page. Compares entered password to the 
  user's password. Sets session id if successful.
**/


// configuration
require("../includes/config.php"); 

// if not already logged in
if (!isset($_SESSION["id"]))
{
    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["username"]))
        {
            apologize("You must provide your username.");
        }
        else if (empty($_POST["password"]))
        {
            apologize("You must provide your password.");
        }

        // query database for user
        $rows = query("SELECT * FROM users WHERE name = ?", $_POST["username"]);

        // if we found user, check password
        if (count($rows) == 1)
        {
            // first (and only) row
            $row = $rows[0];

            // compare hash of user's input against hash that's in database
            if (crypt($_POST["password"], $row["password"]) == $row["password"])
            {
                // remember that user's now logged in by storing user's ID in session
                $_SESSION["id"] = $row["id"];
                
                //print("Logged in.");
                // redirect to portfolio
                redirect($_POST["go"]);
            }
            // else apologize
            else
            {
                apologize("Invalid username and/or password.");
            }
        }

        // else apologize
        else
        {   
            apologize("Invalid username and/or password.");
        }
    }
    
    else
    {
        // else render form
        if(empty($_GET["go"]))
            render("login_form.php", array("title" => "CS50 Organizations: Log In", "go" => "index.php"));
        else
            render("login_form.php", array("title" => "CS50 Organizations: Log In", "go" => $_GET["go"]));
    }
}

// if logged in already, redirect to index
else
{
    redirect("index.php");
}
?>
