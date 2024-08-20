<?php

namespace ORCID;

class Website {

    public string $Name;

    public string $URL;

    public function __construct(string $name, string $url) {
        $this->Name = $name;
        $this->URL = $url;
    }
}

?>