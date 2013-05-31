<?php

/*
 * Represents the code needed to generate the html to display all bookmarks as a list
 * Several parameters are needed by the code:
 * - editEnabled: enables edit functionality: delete and edit buttons
 * - labelFilter: chosen label, which should be shown (default "All" label)
 * - searchFilter: text by which bookmarks get filtered by title
 * - sortby: by which value of bookmark shall the bookmarks be sorted
 * edit and delete buttons submit title by POST
 * delete calls js function OnDelete()
 * edit navigates to editPage.php
 */

require("/services/serviceFactory.php");

// Read all the bookmarks
$bookmarks = ServiceFactory::getBookmarkService()->Read();

// Getting the selected label to filter
$selectedLabel = serviceFactory::getBookmarkService()->getAllLabel();
if ($_POST && array_key_exists("labelFilter", $_POST))
    $selectedLabel = $_POST["labelFilter"];

echo "</br><b>$selectedLabel bookmarks:</b></br>";

// Getting the search parameter to filter
if ($_POST && array_key_exists("editEnabled", $_POST))
    $editEnabled = $_POST["editEnabled"];   

// Getting the parameter editEnabled
if ($_POST && array_key_exists("searchFilter", $_POST))
    $search = $_POST["searchFilter"];

$sortby = "compareByTitle";
// Getting the parameter sortby
if ($_POST && array_key_exists("sortby", $_POST))
        if ($_POST["sortby"] == "dateCreated")
            $sortby = "compareByCreated";

// Sort all bookmarks (default by title)
usort($bookmarks, array("bookmark", $sortby));

// Display sorted list of bookmarks (only with $selectedLabel)
foreach ($bookmarks as $bookmark)
    if (in_array($selectedLabel, $bookmark->getLabels()))
        if (empty($search) || $bookmark->contains($search))
            // Differentiate display of information depending on editEnabled
            if ($editEnabled == "true")
            {
                // Also show delete and edit buttons, title gets submitted
                echo
                "<form style=\"float:left\" id=\"editForm\" method=\"post\">
                    <input name=\"delete\" type=\"button\" value=\"- Delete\" OnClick=\"OnDelete('" . $bookmark->getTitle() . "')\" />
                </form>";
                echo
                "<form id=\"editForm\" action=\"editPage.php\" method=\"post\">
                    <input name=\"title\" type=\"hidden\" value=\"" . $bookmark->getTitle() . "\">
                    <input name=\"edit\" type=\"submit\" value=\"~ Edit\" />";
                echo $bookmark->display ();
                echo "</form>";
            }
            else
                // Only show default bookmark display
                echo $bookmark->display ();

?>
