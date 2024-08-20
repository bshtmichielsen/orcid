<?php

namespace ORCID;

class Country {

    public string $Name;

    public string $ISOcode;

    public function __construct(string $name, string $ISOcode) {
        $this->Name = $name;
        $this->ISOcode = $ISOcode;
    }
}

?>