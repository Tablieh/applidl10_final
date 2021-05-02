<?php
    use App\Core\Session;
?>
<div class="uk-container">
    <section class="uk-padding-remove">
    <?php 
        if($successMsgs = Session::getFlashes("success")){
            ?>
            
            <div class="uk-alert-success" uk-alert>
                <a class="uk-alert-close" uk-close></a>
                <?php
                    foreach($successMsgs as $msg){
                        echo "<p>",$msg,"</p>";
                    }
                ?>
            </div>
        
            <?php
        }
        if($errorMsgs = Session::getFlashes("error")){
            ?>
            
            <div class="uk-alert-danger" uk-alert>
                <a class="uk-alert-close" uk-close></a>
                <?php
                    foreach($errorMsgs as $msg){
                        echo "<p>", $msg ,"</p>";
                    }
                ?>
            </div>
            
            <?php
        }
    ?>
    </section>
</div>