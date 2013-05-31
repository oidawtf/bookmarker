<!DOCTYPE html>
<html>
    <head>
        
        <!--
            Displays a list of user-defined bookmarks
            Offers filtering functionality
            Contains add, edit and delete functionality
            A bookmark furthermore contains user-defined labels, which categorize them
        -->
        
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        
        <title>Bookmarker</title>
        
        <style type="text/css">
            @import "css/styles.css";
        </style>
        
        <script src="js/ajax.js" type="text/javascript"></script>
        
    </head>
    <body>
        
        <!-- Links for navigation and edit checkbox -->
        <p>
            <a href="index.php">Bookmarker</a>
            -
            <a href="addPage.php">Add a bookmark</a>
            -
            <input id="changeEdit" name="changeEdit" type="checkbox" onchange="OnChangeEdit()" value="Edit" />
            Edit
        </p>
        
        <?php

        require 'services/serviceFactory.php';
        
        // Read all bookmarks
        $bookmarks = ServiceFactory::getBookmarkService()->Read();
        
        // Include code to save the last submitted bookmark into the list
        include 'add.php';
        
        // Include code to edit the confirmed bookmark in the list
        include 'edit.php';
        
        ?>
        
        <!-- div filter represents a placeholder for the php generated filter options (changes with ajax) -->
        <div id="filter"></div>
        <!-- div bookmarkList represents a placeholder for the php generated list of bookmarks (changes with ajax) -->
        <div id="bookmarkList"></div>
        
        <!-- Load the filter (and list) when this page is called -->
        <script type="text/javascript">
            OnFilterLoad();
        </script>
        
    </body>
</html>
