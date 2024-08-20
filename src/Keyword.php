<?php

namespace ORCID;

class Keyword {

    public int $Index;

    public string $Content;

    public function __construct(int $index, string $content) {
        $this->Index = $index;
        $this->Content = $content;
    }
}

?>