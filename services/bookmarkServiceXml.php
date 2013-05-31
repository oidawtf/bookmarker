<?php

require("model/bookmark.php");

/*
 * A service used for reading / writing the bookmarks from / to a fixed xml file
 * Furthermore offers other functionality to get one specific bookmark
 */
class bookmarkServiceXml {
    
    /*
     * The xml file in which the bookmarks are to be loaded / saved
     */
    const XMLPATH = "data/bookmarks.xml";
    /*
     * Corresponding xsd schema for the xml file
     */
    const XSDPATH = "data/bookmarks.xsd";
    
    /*
     * A string resource for the "All" label
     */
    const AllLabel = "All";
    
    /*
     *  Gets the "All" label
     */
    public function getAllLabel()
    {
        return self::AllLabel;
    }
    /*
     * Specified by title returns one bookmark by reference
     * Reads freshly from the xml file
     */
    public function &getBookmark($title)
    {
        $bookmarks = $this->Read();
        
        foreach ($bookmarks as $item)
            if ($item->getTitle() == $title)
                return $item;
            
        return $item;
    }
    
    /*
     * Read functionality to return all bookmarks from the xml file
     */
    public function Read()
    {
        $result = array();
        
        $xml = new DOMDocument();
        $xml->load(self::XMLPATH);
        
        // Validate the xml against the corresponding xsd
        if (!$xml->schemaValidate(self::XSDPATH)) {
            echo "Invalid XML!<br/>";
        }
        else {
            // Read all bookmarks
            $bookmarks = $xml->getElementsByTagName("bookmark");
            foreach( $bookmarks as $bookmark )
            {   
                // Read title
                $title = $bookmark->getElementsByTagName("title");
                $title = $title->item(0)->nodeValue;
                
                // Read url
                $url = $bookmark->getElementsByTagName("url");
                $url = $url->item(0)->nodeValue;
                
                // Read date created
                $created = $bookmark->getElementsByTagName("created");
                $created = $created->item(0)->nodeValue;
                
                // Read all labels
                $labelElements = $bookmark->getElementsByTagName("label");
                $labels = array();
                foreach ($labelElements as $labelElement)
                    $labels[] = $labelElement->nodeValue;
                
                // Create bookmark with read data and save it to result array
                $result[] = new bookmark($title, $url, $created, $labels);
            }
        }
        
        return $result;
    }
    
    /*
     * Write functionality to save all specified bookmarks to the xml file
     */
    public function Write($bookmarks)
    {
        $xml = new DOMDocument();
        $xml->formatOutput = true;
  
        // Create the root element and append it to the DOMDocument
        $rootElement = $xml->createElement( "bookmarks" );
        $xml->appendChild( $rootElement );
  
        // Create one element for each bookmark
        foreach( $bookmarks as $bookmark )
        {
            $bookmarkElement = $xml->createElement( "bookmark" );
            
            // title element
            $titleElement = $xml->createElement( "title" );
            $titleElement->appendChild($xml->createTextNode( (string)$bookmark->getTitle() ));
            $bookmarkElement->appendChild( $titleElement );
            
            // url element
            $urlElement = $xml->createElement( "url" );
            $urlElement->appendChild($xml->createTextNode( (string)$bookmark->getUrl() ));
            $bookmarkElement->appendChild( $urlElement );
            
            // date created element
            $createdElement = $xml->createElement( "created" );
            $createdElement->appendChild($xml->createTextNode( (string)$bookmark->getCreated() ));
            $bookmarkElement->appendChild( $createdElement );
            
            // Create one labels element collection to store all labels
            $labelsElement = $xml->createElement( "labels" );
            foreach ((array)$bookmark->getLabels() as $label)
                if (!empty($label))
                {
                    // label element
                    $labelElement = $xml->createElement("label");
                    $labelElement->appendChild($xml->createTextNode( (string)$label ));
                    $labelsElement->appendChild($labelElement);
                }
            
            $bookmarkElement->appendChild( $labelsElement );
            $rootElement->appendChild( $bookmarkElement );
        }
  
        $xml->Save(self::XMLPATH);
    }
}

?>
