<?php

namespace ORCID;

class Works {

    public array $Items;

    public function __construct() {
        $this->Items = array();
    }

    public function addWork(Work $work) {
        $this->Items[] = $work;
        usort($this->Items, array($this, 'comparer'));
    }

    function comparer($a, $b) {
        $aPublicationDate = (isset($a->PublicationDate)) ? $a->PublicationDate : "9999";
        $bPublicationDate = (isset($b->PublicationDate)) ? $b->PublicationDate : "9999"; 
        return strcmp($bPublicationDate, $aPublicationDate);
    }
}

?>