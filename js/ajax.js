
/*
 * Contains all javascript functionalities
 * Makes great use of ajax
 */

/*
 * Gets a new XMLHttpRequest
 * Differentiates between different sets of browsers while creating the object
 */
function getXmlHttpRequest()
{
    var xmlhttp;
                
    if (window.XMLHttpRequest)  // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    else                        // code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                
    return xmlhttp;
}

/*
 * Gets called each time the filter needs to be loaded anew
 * Calls filter.php
 * Exchanges div filter with responseText
 * Calls javascript function OnListLoad(), since the filter itself changed
 * 
 * Could have been solved with GET (uses POST) for future functionalities that might occur
 */
function OnFilterLoad()
{
    var xmlhttp = getXmlHttpRequest();
    var url = "filter.php";
    var params = "";

    xmlhttp.open("POST", url, true);
                
    xmlhttp.onreadystatechange = function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById("filter").innerHTML=xmlhttp.responseText;
            OnListLoad(document.getElementById('changeEdit').checked);
        }
    }

    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.setRequestHeader("Content-length", params.length);
    xmlhttp.setRequestHeader("Connection", "close");
            
    xmlhttp.send(params);
}

/*
 * Gets called every time the list needs to be loaded anew
 * Uses parameter editEnabled to call list.php (different styles of display information)
 * Can be called without parameter (searches for editEnabled on its own)
 * Parameters:
 * - labelFilter: chosen label to filter bookmarks
 * - searchFilter: search parameter to filter bookmarks by title
 * - sortby: sort bookmarks by chosen input
 * - editEnabled: enable edit functionality
 * Displays returned responseText in div bookmarkList
 */
function OnListLoad(editEnabled)
{
    // Get editEnabled if undefined
    if(typeof editEnabled == 'undefined')
        editEnabled = document.getElementById('changeEdit').checked;
    
    var xmlhttp = getXmlHttpRequest();
    var url = "list.php";
    var params =
        "labelFilter=" + document.forms["filterForm"].elements["labelFilter"].value + "&" + 
        "searchFilter=" + document.forms["filterForm"].elements["searchFilter"].value + "&" + 
        "sortby=" + document.forms["filterForm"].elements["sortby"].value + "&" + 
        "editEnabled=" + editEnabled;
    
    xmlhttp.open("POST", url, true);
                
    xmlhttp.onreadystatechange = function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
            document.getElementById("bookmarkList").innerHTML=xmlhttp.responseText;
    }

    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.setRequestHeader("Content-length", params.length);
    xmlhttp.setRequestHeader("Connection", "close");
            
    xmlhttp.send(params);
}

/*
 * Gets called every time the edit checkbox changes status
 * Calls OnListLoad() itself, since the list has to get loaded anew
 */
function OnChangeEdit()
{
    OnListLoad(document.getElementById('changeEdit').checked);
}

/*
 * Gets called every time a delete button is clicked
 * Uses title parameter to call delete.php
 * Calls javascript function OnFilterLoad(), since a label could have been deleted
 *  and OnFilterLoad() calls OnListLoad() itself
 */
function OnDelete(title)
{
    var xmlhttp = getXmlHttpRequest();
    var url = "delete.php";
    var params = "delete=" + title;
    
    xmlhttp.open("POST", url, true);
                
    xmlhttp.onreadystatechange = function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
            OnFilterLoad();
    }

    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.setRequestHeader("Content-length", params.length);
    xmlhttp.setRequestHeader("Connection", "close");

    xmlhttp.send(params);
}