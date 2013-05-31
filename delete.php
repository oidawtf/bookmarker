<?php

/*
 * Represents the code to do, when a POST with "delete" was submitted
 * No confirmation is needed to delete a bookmark
 * Deletion is permanent and real
 * Gets saved to data structure automatically
 */

require("/services/serviceFactory.php");

// Read the bookmarks from the service
$bookmarks = ServiceFactory::getBookmarkService()->Read();

// Get the title to delete
if ($_POST && array_key_exists("delete", $_POST))
    $delete = $_POST["delete"];

// If title exists in bookmarks it gets deleted
foreach ($bookmarks as $key => $value)
    if ($value->getTitle() == $delete)
        unset($bookmarks[$key]);
    
// Write the remaining bookmarks with help of the service
ServiceFactory::getBookmarkService()->Write($bookmarks);

?>
