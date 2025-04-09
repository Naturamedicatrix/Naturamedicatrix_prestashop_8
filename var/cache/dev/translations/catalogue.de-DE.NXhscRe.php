<?php

use Symfony\Component\Translation\MessageCatalogue;

$catalogue = new MessageCatalogue('de-DE', array (
));

$catalogueDe = new MessageCatalogue('de', array (
));
$catalogue->addFallbackCatalogue($catalogueDe);

return $catalogue;
