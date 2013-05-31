<?php

require("/services/bookmarkServiceXml.php");

/*
 * A factory for all the needed services
 * Currently contains only one service (bookmarkService)
 * 
 * Should be used by UI, Controller as this is the class which controls all services
 * 
 * Here different services can get implemented for future references (e.g. Mock, Xml, Sql based)
 */
class serviceFactory {

    /*
     * bookmarkService is needed to read / write the bookmarks
     */
    private static $bookmarkService;
    
    /*
     * Gets the bookmarkService
     * Returns an xml based bookmarkservice
     */
    public static function getBookmarkService()
    {
        if (empty(ServiceFactory::$bookmarkService))
            ServiceFactory::$bookmarkService = new bookmarkServiceXml();
        
        return ServiceFactory::$bookmarkService;
    }
}

?>
