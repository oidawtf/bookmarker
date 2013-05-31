<?php

/*
 * bookmark class represents one bookmark data structure
 */
class bookmark {
   
    /*
     * Title / name of the bookmark
     * Works as an Id
     */
    private $title;
    /*
     * Url
     */
    private $url;
    /*
     * Date the bookmark was created or modified
     */
    private $created;
    /*
     * Labels is an array of categories, in which the bookmark is considered in (e.g. Funny, Work)
     */
    private $labels;
    
    /*
     * Default constructor
     */
    public function __construct($title, $url, $created, $labels) {
        $this->setTitle($title);
        $this->setUrl($url);
        $this->setCreated($created);
        $this->setLabels($labels);
    }
    
    /*
     * Gets the title
     */
    public function getTitle() {
        return $this->title;
    }

    /*
     * Sets the title
     */
    public function setTitle($title) {
        $this->title = (string) $title;
    }
    
    /*
     * Gets the url
     */
    public function getUrl() {
        return $this->url;
    }

    /*
     * Sets the url
     */
    public function setUrl($url) {
        $this->url = (string) $url;
    }
    
    /*
     * Gets the date created
     */
    public function getCreated() {
        return $this->created;
    }

    /*
     * Sets the date created
     */
    public function setCreated($created) {
        $this->created = (string) $created;
    }
    
    /*
     * Gets the labels
     */
    public function getLabels() {
        return $this->labels;
    }

    /*
     * Sets the labels
     */
    public function setLabels($labels) {
        $this->labels = (array) $labels;
    }
    
    /*
     * A display method that echos the title and url as hyperlink, as well as the date created on and the labels
     * e.g.: iGoogle - created on 2012-06-03 - Labels: [ Work | Misc | All ]
     */
    public function display() {
        $result
        = "<a target=\"_blank\" href=\""
        . $this->getUrl()
        . "\">"
        . $this->getTitle()
        . "</a>"
        . " - created on "
        . $this->getCreated()
        . " - Labels: [ ";
        foreach ($this->labels as $label)
            $result .= $label . " | ";
        $result = trim($result, " | ");
        $result .= " ]<br/>";
        echo $result;
    }
    
    /*
     * Returns the labels separated by commas
     */
    public function getLabelsAsString()
    {
        $result = "";
        foreach ($this->getLabels() as $label)
            $result .= $label . ", ";
        $result = trim($result, ", ");
        return $result;
    }
    
    /*
     * Checks, if a substring $str exists in the title
     */
    public function contains($str)
    {
        $a1 = strtolower($this->getTitle());
        $b1 = strtolower($str);
        return strlen(strpos($a1,$b1)) > 0 ? 1 : 0;
    }
    
    /*
     * Compares two bookmarks by title (needed by sort)
     */
    static function compareByTitle($a, $b)
    {
        $al = strtolower($a->getTitle());
        $bl = strtolower($b->getTitle());
        if ($al == $bl)
            return 0;
        
        return ($al > $bl) ? +1 : -1;
    }
    
    /*
     * Compares two bookmarks by the date created (needed by sort)
     */
    static function compareByCreated($a, $b)
    {
        $al = new DateTime($a->getCreated());
        $bl = new DateTime($b->getCreated());
        if ($al == $bl)
            return 0;
        
        return ($al < $bl) ? +1 : -1;
    }
}

?>
