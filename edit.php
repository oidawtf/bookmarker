<?php

/*
 * Represents the code to do, when a POST with "edit" was submitted
 * Manually searches for the right bookmark the edit
 * Gets saved to data structure automatically
 */

if ($_POST && array_key_exists("confirmEdit", $_POST))
{
    // The submitted and perhaps edited POST values
    // titleOriginal is the original title (before edit)
    // title is the new title (after edit)
    $titleOriginal = $_POST['titleOriginal'];
    $title = $_POST['title'];
    $url = $_POST['url'];
    $created = date("Y-m-d", time());
    $labels = explode(", ", $_POST['labels']);
    
    // Automatically adds the "All" label to the already submitted labels, if it does not already exists
    if (!in_array(serviceFactory::getBookmarkService()->getAllLabel(), $labels))
        $labels[] = serviceFactory::getBookmarkService()->getAllLabel();
      
    // Search for the right bookmark to edit and change the values
    foreach ($bookmarks as $bookmark)
        if ($bookmark->getTitle() == $titleOriginal)
        {
            $bookmark->setTitle($title);
            $bookmark->setUrl($url);
            $bookmark->setCreated($created);
            $bookmark->setLabels($labels);
            break;
        }
            
    // Save whole list with edited bookmark
    ServiceFactory::getBookmarkService()->Write($bookmarks);
}
        
?>
