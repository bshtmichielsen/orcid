<?php

namespace ORCID;

use GuzzleHttp\Client;

class Reader {

    private string $baseURL;

    private Client $client;

    public function __construct() {
        $this->baseURL = "https://orcid.org";
        $this->client = new Client();
    }

    public function getProfile(string $id) : Profile {
        $profile = new Profile();
        $response = $this->client->get($this->baseURL . "/$id/public-record.json");
        $statusCode = $response->getStatusCode();
        if ($statusCode != 200) throw new Exception("ORCID could not get public record: Status $statusCode");
        $data = json_decode($response->getBody()->getContents(), true);
        $profile->DisplayName = $data["displayName"];
        $profile->GivenNames = $data["names"]["givenNames"]["value"];
        $profile->FamilyName = $data["names"]["familyName"]["value"];
        $profile->Biography = (isset($data["biography"]["biography"])) ? $data["biography"]["biography"]["value"] : "";
        foreach($data["countries"]["addresses"] as $c) {
            $profile->addCountry($c["countryName"], $c["iso2Country"]["value"]);
        }
        foreach($data["keyword"]["keywords"] as $k) {
            $profile->addKeyword($k["displayIndex"], $k["content"]);
        }
        foreach($data["website"]["websites"] as $w) {
            $profile->addWebsite($w["urlName"], $w["url"]["value"]);
        }
        return $profile;
    }

    public function getAffiliations($id) : Affiliations {
        $affiliations = new Affiliations();
        $response = $this->client->get($this->baseURL . "/$id/affiliationGroups.json");
        $statusCode = $response->getStatusCode();
        if ($statusCode != 200) throw new Exception("ORCID could not get affiliation groups: Status $statusCode");
        $data = json_decode($response->getBody()->getContents(), true);
        foreach($data["affiliationGroups"] as $label => $group) {
            foreach($group as $e) {
                $e = $e["defaultAffiliation"];
                $start = $this->parseDate($e["startDate"]);
                $end = $this->parseDate($e["endDate"]);
                $url = (isset($e["url"]["value"])) ? $e["url"]["value"] : "";
                $affiliation = new Affiliation($e["roleTitle"]["value"], $e["affiliationName"]["value"], $e["departmentName"]["value"], $e["city"]["value"], $e["region"]["value"], $e["country"]["value"], $start, $end, $url);
                $affiliations->addAffiliation($label, $affiliation);
            }
        }
        return $affiliations;
    }

    public function getWorks($id) : Works {
        $works = new Works();
        $response = $this->client->get($this->baseURL . "/$id/worksExtendedPage.json", ["query" => ["offset" => "0", "sort" => "date", "sortAsc" => "false", "pageSize" => "999"]]);
        $statusCode = $response->getStatusCode();
        if ($statusCode != 200) throw new Exception("ORCID could not get works: Status $statusCode");
        $data = json_decode($response->getBody()->getContents(), true);
        foreach($data["groups"] as $group) {
            $w = $group["works"][0];
            $journal = (isset($w["journalTitle"]["value"])) ? $w["journalTitle"]["value"] : null;
            $pubDate = $this->parseDate($w["publicationDate"]);
            $doi = null;
            foreach ($w["workExternalIdentifiers"] as $identifier) {
                if ($identifier["externalIdentifierType"]["value"] == "doi") {
                    $doi = $identifier["normalized"]["value"];
                    break;
                }
            }
            $type = (isset($w["workType"]["value"])) ? $w["workType"]["value"] : null;
            $work = new Work($w["title"]["value"], $journal, $pubDate, $doi, $type);
            foreach ($w["contributorsGroupedByOrcid"] as $c) {
                $orcid = (isset($c["contributorOrcid"]["path"])) ? $c["contributorOrcid"]["path"] : null;
                $role = (isset($c["rolesAndSequences"][0]["contributorRole"])) ? $c["rolesAndSequences"][0]["contributorRole"] : null;
                $contributor = new Contributor($c["creditName"]["content"], $orcid, $role);
                $work->addContributor($contributor);
            }
            $works->addWork($work);
        }
        return $works;
    }

    private function parseDate($input) : ?Date {
        $year = intval($input["year"]);
        $month = intval($input["month"]);
        $day = intval($input["day"]);
        if ($year == 0 && $month == 0 && $day == 0) {
            return null;
        }
        return new Date($year, $month, $day);
    }
}

?>