
<?php

/*
 * Code for adding the filter options
 * - Combobox for labels (filter by labels)
 * - Combobox for sorting options
 * - Textbox for search criteria (search and filter by title)
 * 
 * All changes made in this UI will call the JS function OnListLoad()
 */

require("/services/serviceFactory.php");

// Read all the bookmarks
$bookmarks = ServiceFactory::getBookmarkService()->Read();

// Combobox for the labels
echo
    "<form id=\"filterForm\" method=\"post\">
    Show Label: 
    <select name=\"labelFilter\" onchange=\"OnListLoad()\">";

// Initialize the labels array with the "All" label
// Only add label once (can occur at more bookmarks)
$labels = array(serviceFactory::getBookmarkService()->getAllLabel());
foreach ($bookmarks as $bookmark)
    foreach ($bookmark->getLabels() as $label)
        if (in_array($label, $labels) == false)
            $labels[] = $label;

// Non-case-sensitive sort of the labels
natcasesort($labels);

// Add the sorted labels to the combobox
foreach ($labels as $item)
    echo'<option value="'.$item.'">'.$item.'</option>';

echo "</select>";

// Combobox for sort by (fixed with SortBy: "Title" or "Date created")
echo " - Sort by: 
    <select name=\"sortby\" onchange=\"OnListLoad()\">
        <option value=\"title\">Title</option>
        <option value=\"dateCreated\">Date created</option>
    </select> - ";

// Search Textbox
echo
    " Search by title: 
    <input name=\"searchFilter\" type=\"text\" size=\"100\" maxlength=\"100\" onkeyup=\"OnListLoad()\">
    </form>";

?>
