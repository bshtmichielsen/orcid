<?php

namespace ORCID;

class Contributor {

    public string $Name;

    public ?string $ORCID;

    public ?string $Role;

    public function __construct(string $name, ?string $orcid, ?string $role) {
        $this->Name = $name;
        $this->ORCID = $orcid;
        $this->Role = $role;
    }
}

?>