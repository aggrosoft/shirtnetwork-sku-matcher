<?php

$sMetadataVersion = '1.1';

$aModule = array(
    'id'           => 'snwskumatcher',
    'title'        => 'Shirtnetwork Sku Matcher',
    'description'  => 'Mapped Shirtnetwork Artikelnummern zu Oxid Artikelnummern',
    'thumbnail'    => '',
    'version'      => '1.0.4',
    'author'       => 'Aggrosoft',
    'extend'      => array(
        'oxarticle' => 'snwskumatcher/extensions/models/snwskumatcher_oxarticle'
    ),
    'settings' => array(
        array('group' => 'snwskumatcher_settings', 'name' => 'aSmartyVariantSkuMatcher',  'type' => 'arr',   'value' => ''),
        array('group' => 'snwskumatcher_settings', 'name' => 'aSmartySizeSkuMatcher',  'type' => 'arr',   'value' => ''),
        array('group' => 'snwskumatcher_settings', 'name' => 'aSmartyPrinttypeSkuMatcher',  'type' => 'arr',   'value' => ''),
    )
);