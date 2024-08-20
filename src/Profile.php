<?php

namespace ORCID;

class Profile {

    public string $DisplayName;

    public string $GivenNames;

    public string $FamilyName;

    public string $Biography;

    public array $Countries;

    public array $Keywords;

    public array $Websites;

    public function __construct() {
        $this->Countries = array();
        $this->Keywords = array();
        $this->Websites = array();
    }

    public function addCountry(string $name, string $ISOcode) {
        $this->Countries[] = new Country($name, $ISOcode);
    }

    public function addKeyword(int $index, string $content) {
        $this->Keywords[] = new Keyword($index, $content);
    }

    public function addWebsite(string $name, string $url) {
        $this->Websites[] = new Website($name, $url);
    }
}

?>