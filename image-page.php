<?php
include('header.php');
include('includes/lib.inc.php');
require_once('connect.php');
session_start();
$imageInfo = $connection->query("SELECT * FROM images WHERE Id=". $_REQUEST['imageID']);
$imageInfo = mysqli_fetch_assoc($imageInfo);
$commentsToImage = $connection->query("SELECT * FROM `comments`
    INNER JOIN users ON users.Id=comments.UserID
    WHERE ImageId='". $_REQUEST['imageID'] ."'ORDER BY CommentDate ASC");
    ?>
    <div class="main-gallery">
        <div class="image-overview">
            <img src="<?php echo $imageInfo['ImagePath'] ?>">
            <div class="likes-number-btn">
                <span id="number-of-likes" style="font-size: 30px;"><?php echo $imageInfo['Likes']; ?></span>
                <a href="#" id="like" disabled><img src="images/like.png" width="50"></a>
                <a href="#" id="unlike"><img style="background: lightblue; border-radius: 30px;" src="images/like.png" width="50"></a>
            </div>
            <!-- AddToAny BEGIN -->
<!--             <div class="a2a_kit a2a_kit_size_32 a2a_default_style" style="padding: 10px 0px;">
                <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
                <a class="a2a_button_facebook"></a>
                <a class="a2a_button_twitter"></a>
                <a class="a2a_button_google_plus"></a>
                <a class="a2a_button_email"></a>
            </div>
            <script async src="https://static.addtoany.com/menu/page.js"></script> -->
            <!-- AddToAny END -->
            <!-- Pluso BEGIN -->
            <script type="text/javascript">(function() {
              if (window.pluso)if (typeof window.pluso.start == "function") return;
              if (window.ifpluso==undefined) { window.ifpluso = 1;
                var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
                s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
                s.src = ('https:' == window.location.protocol ? 'https' : 'http')  + '://share.pluso.ru/pluso-like.js';
                var h=d[g]('body')[0];
                h.appendChild(s);
            }})();</script>
            <div class="pluso" data-background="transparent" data-options="small,square,line,horizontal,counter,theme=04" data-services="facebook,google,email,print"></div>
            <!-- Pluso END -->


        </div>

        <div style="display: inline-block;" class="comments-block">
            <div class="comments">
                <?php 
                while ($comment = mysqli_fetch_assoc($commentsToImage)) { ?>
                <div class="comment">
                    <span class="comment-user-name"><?php echo $comment['Name']. ": " ?></span>
                    <span><?php echo $comment['Comment']?></span>
                    <br />
                    <span class="comment-date"><?php echo $comment['CommentDate']?></span>
                </div>
                <?php }
                echo "</div>";
                if (!isset($_SESSION['logged'])) {
                   echo "<span class='errmsg' style='width: 100%; text-align: center;'>To leave your comment you must be logged in!</span>";   
               }
               else {?>
               <form style="text-align: left" method="post" action="comment.php?imageID=<?php echo $imageInfo['Id']; ?>" id="comment-form">
                <input type="text" name="comment-text" placeholder="Write a new comment" required="" style="width: 95%;">
            </form>
            <?php } ?>
        </div>
        <div style="clear: both;"></div>
    </div>
    <script type="text/javascript" src="js/like.js"></script>

    <?php
    include('footer.php');
    ?>