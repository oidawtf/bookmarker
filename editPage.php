<!DOCTYPE html>
<html>
    <head>
        
        <!--
            Displays a form, which is needed in order to edit a submitted bookmark
            The bookmark is recognized by the title submitted by POST
            Values to be edited inserted with php
        -->
        
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        
        <title>Edit bookmarks</title>
        
        <style type="text/css">
            @import "css/styles.css";
        </style>
        
    </head>
    <body>
        
        <!-- Links for navigation -->
        <p>
            <a href="index.php">Bookmarker</a>
            -
            <a href="addPage.php">Add a bookmark</a>
        </p>
        
        <?php
        
        require("services/serviceFactory.php");
        
        // Getting the right bookmark to edit (form needs values in textboxes)
        // Page has to be called by POST and has to submit the title
        if ($_POST && array_key_exists("title", $_POST))
        {
            $title = $_POST["title"];
            
            $bookmark = serviceFactory::getBookmarkService()->getBookmark($title);
        }
        
        ?>
        
        <!--
            Form for the bookmark values to be edited
            Input values are the values of the submitted bookmark
        -->
        <form action="index.php" method="post">
            <p>
                <!-- original title has to get submitted too, here by an invisible element -->
                <input name="titleOriginal" type="hidden" size="100" maxlength="100"
                                   <?php
                                   echo "value=\"" . $title . "\"";
                                   ?>
                                   >
                <table border="0">
                    <tr>
                        <td>Title:</td>
                        <td><input name="title" type="text" size="100" maxlength="100"
                                   <?php
                                   echo "value=\"" . $bookmark->getTitle() . "\"";
                                   ?>
                                   ></td>
                    </tr>
                    <tr>
                        <td>Url:</td>
                        <td><input name="url" type="text" size="100" maxlength="2000"
                                   <?php
                                   echo "value=\"" . $bookmark->getUrl() . "\"";
                                   ?>
                                   ></td>
                    </tr>
                    <tr>
                        <td>Labels:</td>
                        <td><input name="labels" type="text" size="100" maxlength="100"
                                   <?php
                                   echo "value=\"" . $bookmark->getLabelsAsString() . "\"";
                                   ?>

                                   ></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td class="comment">e.g.: Work, Funny, Holidays</td>
                    </tr>
                </table>
                <br/>
                <input name="confirmEdit" type="submit" value="Confirm" />
            </p>
        </form>
        
    </body>
</html>
