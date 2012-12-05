

<div class="row-fluid">

    <div class="club-header">

        <h1>
        <?php 
            if($clubInfo["abbreviation"]!="")
            {
                print($clubInfo["abbreviation"]." <small>".$clubInfo["name"]."</small>");
            }
            else
                print($clubInfo["name"]);
            ?>
        </h1>

<form action="signUp.php" method="link">

        <p style="text-align:left">
            <button type ="button" class="btn" data-toggle="collapse" data-target="#info">
                <i class = "icon-info-sign"></i>
            </button>
            
            <!-- Button to trigger modal -->
            <a href="#emailModal" role="button" class="btn" data-toggle="modal">
                <i class="icon-envelope"></i>
            </a>

            <?php if(isset($_SESSION["id"]) && $level == 1):?>

<?php
    print("<input type=\"hidden\" name=\"club\" value=\"".$clubInfo["name"]."\">");
    print("<button type=\"submit\"  class=\"btn btn-primary\" >Join</button>");
    ?>
            <?php elseif($level == 5):?>
            <a href="#announcementModal" role="button" class="btn" data-toggle="modal">
                <i class="icon-volume-up"></i>
            </a>
            <?php endif ?>

        </p>
        
        <div id="info" class="collapse out"> 

                <?=$clubInfo["information"]?> 
        </div>

</form>

    </div>
</div>


<div class="modal fade hide" id="emailModal" tabindex="-1" style="text-align:left" role="dialog" aria-labelledby="emailModalLabel" aria-hidden="true" data-remote= <?="\"/sendMail.php?club=".str_replace(" ", "+", $clubInfo["name"])."\""?> >
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h3 id="emailModalLabel">Email club admins.</h3>
</div>
<div class="modal-body">
<p>Loading email form...</p>
</div>
</div>

<div class="modal fade hide" id="announcementModal" tabindex="-1" style="text-align:left" role="dialog" aria-labelledby="announcementModalLabel" aria-hidden="true" data-remote= <?="\"/sendMail.php?club=".str_replace(" ", "+", $clubInfo["name"])."\""?> >
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h3 id="announcementModalLabel">Make club announcement.</h3>
</div>
<div class="modal-body">
<p>Loading announcement form...</p>
</div>
</div>


<div class = "row-fluid">


    <ul id="MainTabs" class="nav nav-tabs">
        <li><a data-target="#events" data-toggle="tab"><i class="icon-calendar"></i>&nbsp;&nbsp;Events</a></li>
        <li><a data-target="#announcements" data-toggle="tab"> <i class="icon-exclamation-sign"></i>&nbsp;&nbsp;Announcements</a></li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane" id="events">
            <iframe src="https://www.google.com/calendar/embed?src=2ah0qjho0ctekccbmtmpatunco%40group.calendar.google.com&ctz=America/New_York" style="border: 0" width="700" height="450" frameborder="0" scrolling="no">
            </iframe>
        </div>
        <div class="tab-pane" id="announcements">
            <?php   
                
                if ($announcements == NULL)
                    print("There are no announcements.");
                
                else{
                    foreach ($announcements as $announcement)
                    {                    
                    print("<div class = \"announcement\">");
                    print("<div class = \"announcement-subject\">");
                          print($announcement["title"]);
                    print("</div>");  
                    
                    print("<div class = \"announcement-content\">");
                        print($announcement["text"]);
                    print("</div>"); 
                    
                    print("<div class = \"announcement-info\">");
                    $poster = query("SELECT * FROM users WHERE id=?", $announcement["userID"])[0];
                        print("posted ".$announcement["time"]." by ".$poster["realname"]);
                    print("</div>");
                    }
                }
                ?>
        </div>
    </div>

    <script>
        $(function() {
            $("#MainTabs").tab();
            $("#MainTabs").bind("show", function(e) {    
                var contentID  = $(e.target).attr("data-target");
                var contentURL = $(e.target).attr("href");
                $(contentID).load(contentURL, function(){
                    $("#MainTabs").tab();
                });
            });
        $('#MainTabs a:first').tab("show");
        });
    </script>

</div>

</form>
