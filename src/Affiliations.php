<?php

namespace ORCID;

class Affiliations {

    public array $Educations;

    public array $Employments;

    public array $Services;

    public array $Distinctions;

    public array $InvitedPositions;

    public array $Memberships;

    public array $Qualifications;

    public function __construct() {
        $this->Educations = array();
        $this->Employments = array();
        $this->Services = array();
        $this->Distinctions = array();
        $this->InvitedPositions = array();
        $this->Memberships = array();
        $this->Qualifications = array();
    }

    public function addAffiliation(string $label, Affiliation $affiliation) {
        switch ($label) {
            case "EDUCATION":
                $this->Educations[] = $affiliation;
                usort($this->Educations, array($this, 'comparer'));
                break;
            case "EMPLOYMENT":
                $this->Employments[] = $affiliation;
                usort($this->Employments, array($this, 'comparer'));
                break;
            case "SERVICE":
                $this->Services[] = $affiliation;
                usort($this->Services, array($this, 'comparer'));
                break;
            case "DISTINCTION":
                $this->Distinctions = $affiliation;
                usort($this->Distinctions, array($this, 'comparer'));
                break;
            case "INVITED_POSITION":
                $this->InvitedPositions = $affiliation;
                usort($this->InvitedPositions, array($this, 'comparer'));
                break;
            case "MEMBERSHIP":
                $this->Memberships = $affiliation;
                usort($this->Memberships, array($this, 'comparer'));
                break;
            case "QUALIFICATION":
                $this->Qualifications = $affiliation;
                usort($this->Qualifications, array($this, 'comparer'));
                break;
        }
    }

    function comparer($a, $b) {
        $aEnd = (isset($a->End)) ? $a->End : "9999";
        $bEnd = (isset($b->End)) ? $b->End : "9999"; 
        return strcmp($bEnd, $aEnd);
    }
}

?>