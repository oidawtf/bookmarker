
<?php

/*
 * Represents the code to do, when a POST with "add" was submitted
 * Adds the submitted title, url, created and labels as one new bookmark
 *  to the bookmarks provided by the serviceFactory
 * Gets saved to data structure automatically
 */

if ($_POST && array_key_exists("add", $_POST))
{
    // Submitted POST values
    $title = $_POST['title'];
    $url = $_POST['url'];
    $created = date("Y-m-d", time());
    $labels = explode(", ", $_POST['labels']);
    
    // Automatically adds the "All" label to the already submitted labels, if it does not already exists
    if (!in_array(serviceFactory::getBookmarkService()->getAllLabel(), $labels))
        $labels[] = serviceFactory::getBookmarkService()->getAllLabel();
     
    // Add new bookmark to the model
    $bookmarks[] = new bookmark($title, $url, $created, (array)$labels);
    
    // Save whole list
    ServiceFactory::getBookmarkService()->Write($bookmarks);
}
        
?>
