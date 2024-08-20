# ORCID

This package provides a reader for public ORCID records. Note that this package is likely not complete as I just needed it to pull my public profile, affiliations and works, so did not look into the other aspects of ORCID much. Feel free to submit a pull request.

```php

use ORCID\Reader;

$orcid = "0009-0001-0789-3994";

$reader = new Reader();
$profile = $reader->getProfile($orcid);
$affiliations = $reader->getAffiliations($id);
$works = $reader->getWorks($id);

```