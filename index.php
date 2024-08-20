<?php
require __DIR__ . "/vendor/autoload.php";

use ORCID\Reader;

//$id = "0000-0003-1934-7170";
$id = "0009-0001-0789-3994";

$reader = new Reader();
$profile = $reader->getProfile($id);
$affiliations = $reader->getAffiliations($id);
$works = $reader->getWorks($id);
?>

<h1>Profile</h1>
<?php
var_dump($profile);
?>

<h1>Affiliations</h1>
<?php
var_dump($affiliations);
?>

<h1>Works</h1>
<pre><?php var_dump($works);?></pre>