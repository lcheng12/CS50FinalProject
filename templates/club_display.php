<form action="allClubs.php" method="get">

<?php
    print("<h1>".$club["name"]."</h1></br>");

    print("<button type=\"button\">LA</button>");
    
    foreach ($announcements as $announcement)
    {
        print("<div>");
        print("<h4>".$announcement["title"]."</h4>");
        print("<h5>"."Posted ".$announcement["time"]."</h5>");
        print($announcement["text"]);
        print("</br>");
        print("</div>");                
    }
?>

</form>
