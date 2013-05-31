<!DOCTYPE html>
<html>
    <head>
        
        <!--
            Displays a form, which is needed in order to create a new bookmark
        
            -- -- Kind of redundant to editPage.php
            -- -- maybe only one page with non-existent submitted bookmark
            -- --  to differentiate between those two functionalities
        -->
        
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <title>Add new bookmark</title>

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
        
        <!-- Form for the new bookmark values -->
        <form action="index.php" method="post">
            <p>
                <table border="0">
                    <tr>
                        <td>Title:</td>
                        <td><input name="title" type="text" size="100" maxlength="100"></td>
                    </tr>
                    <tr>
                        <td>Url:</td>
                        <td><input name="url" type="text" size="100" maxlength="2000"></td>
                    </tr>
                    <tr>
                        <td>Labels:</td>
                        <td><input name="labels" type="text" size="100" maxlength="100"></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td class="comment">e.g.: Work, Funny, Holidays</td>
                    </tr>
                </table>
                <br/>
                <input name="add" type="submit" value="+ Add" />
            </p>
        </form>
        
    </body>
</html>
