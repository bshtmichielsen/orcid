<?php

namespace ORCID;

class Affiliation {

    public string $Name;

    public string $Organization;

    public ?string $Department;

    public ?string $City;

    public ?string $Region;

    public ?string $Country;

    public ?Date $Start;

    public ?Date $End;

    public ?string $Url;

    public function __construct(string $name, string $organization, ?string $department, ?string $city, ?string $region, ?string $country, ?Date $start, ?Date $end, ?string $url) {
        $this->Name = $name;
        $this->Organization = $organization;
        $this->Department = $department;
        $this->City = $city;
        $this->Region = $region;
        $this->Country = $country;
        $this->Start = $start;
        $this->End = $end;
        $this->Url = $url;
    }
}

?>