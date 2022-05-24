# shirtnetwork-sku-matcher
Match skus to different schemes

Currently matches only `{PRODUCT_SKU}-{VARIANT_SKU}-{SIZE_SKU}`

You can configure custom matchers through the module options, the settings are a smarty rendered template.

It comes with the variable `$product` which contains the current oxarticle instance.