<?php

namespace ORCID;

class Work {

    public string $Title;

    public ?string $Journal;

    public ?Date $PublicationDate;

    public ?string $DOI;

    public ?string $Type;

    public array $Contributors;

    public function __construct(string $title, ?string $journal, ?Date $publicationDate, ?string $doi, ?string $type) {
        $this->Title = $title;
        $this->Journal = $journal;
        $this->PublicationDate = $publicationDate;
        $this->DOI = $doi;
        $this->Type = $type;
        $this->Contributors = array();
    }

    public function addContributor(Contributor $contributor) {
        $this->Contributors[] = $contributor;
    }
}

?>