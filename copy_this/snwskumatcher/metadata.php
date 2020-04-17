<?php
$aModule = array(
    'id'           => 'snwskumatcher',
    'title'        => 'Shirtnetwork Sku Matcher',
    'description'  => 'Mapped Shirtnetwork Artikelnummern zu Oxid Artikelnummern',
    'thumbnail'    => '',
    'version'      => '1.0.0',
    'author'       => 'Aggrosoft',
    'extend'      => array(
        'oxarticle' => 'snwskumatcher/extensions/models/snwskumatcher_oxarticle'
    )
);