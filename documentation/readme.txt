
--------------------------------------------------------------------------------
Project name:   Bookmarker
                SWD11 Websprachen Summer Project
Creator:        Max HOTKO
Date:           2012/07/25
Version:        1.0

--------------------------------------------------------------------------------
Goal:
The goal of the Bookmarker is to provide an online bookmark collection.
Provides
- A list of all bookmarks
- Add/Edit/Delete functionalites
- User-defined "labels", which allow the user to categorize bookmarks
- Allows to filter all bookmarks by labels or chosen keyword
   (only displays bookmarks, which title contains keyword)
- Allows user to sort bookmarks by title or by date created
   (actually date modified)

--------------------------------------------------------------------------------
Description:
Bookmarker is a small project developed by Max HOTKO, SWD11 to display knowledge
 about discussed web technologies of the Websprachen subject of FH Joanneum.
Further background of the chosen topic is to develop it to get
 a release candidate to actually make use of the functionalities instead of the
 iGoogle bookmarks gadget, which will not be supported by Nov. 2013 anymore.

--------------------------------------------------------------------------------
Used technologies:
- HTML
- PHP
- Javascript / AJAX
- XML w/ corresponding XSD

--------------------------------------------------------------------------------
Architecture:
- UI with html pages / css / ajax
    * index.php
    * addPage.php
    * editPage.php
    * styles.css
    * ajax.js

    The UI is pretty short on side of fixed html, since js makes use of php
     provided elements (see BusinessLogic).
    Three pages (index, addPage, editPage) provided for navigation.
    CSS only styles a few elements.

- Services-Layer with php (also DataAccess layer)
    * serviceFactory.php
    * bookmarkServiceXml.php

    The serviceFactory is the chokepoint of all server-side based methods.
    It further chooses which access to the datastructure should be used.
    Mock services can be established in this layer.
    bookmarkServiceXml provides means of accessing the data.

- BusinessLogic via server-side php modules
    * add.php
    * delete.php
    * edit.php
    * filter.php
    * list.php

    Provides different functionalities server-side-based, since it makes great
     use of the services layer like add / edit or delete a bookmark
    Furthermore creates the filtering options and list of the bookmarks needed
     by the UI

- Model via server-side php module
    * bookmark.php

    Represents one bookmark that contains all needed information.
    Offers different functionalities, so actually is a smart model
     (not only to hold the data)

- Datastructure with xml
    * bookmarks.xml
    * bookmarks.xsd
    
    Represents the datastructure of the bookmarks.

--------------------------------------------------------------------------------
Ideas for future features:
- save the last selected label and use that instead of the first
- Get proper XHTML tags
- Styling, using images for buttons
- Autocomplete for Labels
- Authentication $ Authorization functionalities
- Deployment on webspace

--------------------------------------------------------------------------------
Known bugs:
- Add a label, which gets sorted before "All" makes that the first label
