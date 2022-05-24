<?php

class snwskumatcher_oxarticle extends snwskumatcher_oxarticle_parent {

    protected $_sDesignerVariantSku;
    protected $_sDesignerSizeSku;

    public function getDesignerBaseSku(){
        if ($this->getDesignerProductSmartyMatcher()){
            return $this->getDesignerSmartyMatch($this->getDesignerProductSmartyMatcher());
        }
        return parent::getDesignerBaseSku();
    }

    public function getDesignerVariantSku(){

        if ($this->getDesignerVariantSmartyMatcher()){
            return $this->getDesignerSmartyMatch($this->getDesignerVariantSmartyMatcher());
        }

        if ($this->_sDesignerVariantSku === null && $this->oxarticles__oxparentid->value) {
            //remove base sku
            $aParts = explode('-', $this->oxarticles__oxartnum->value);
            array_shift($aParts);
            $sku = implode('-', $aParts);

            $oParent = $this->getParentArticle();

            if(stristr($oParent->oxarticles__oxvarname->value, '|') !== FALSE){
                //remove everything that looks like a size sku
                $aSizes = Shirtnetwork::getInstance()->getSizes();
                $aSizeSkus = array_column($aSizes->source, 'artnr');

                foreach ($aSizeSkus as $sSizeSku) {
                    $sku = str_replace('-'.$sSizeSku, '', $sku);
                }
            }

            $this->_sDesignerVariantSku = trim($sku, '-');

        }

        return $this->_sDesignerVariantSku;
    }

    public function getDesignerSizeSku(){

        if ($this->getDesignerSizeSmartyMatcher()){
            return $this->getDesignerSmartyMatch($this->getDesignerSizeSmartyMatcher());
        }

        if ($this->_sDesignerSizeSku === null && $this->oxarticles__oxparentid->value) {
            $oParent = $this->getParentArticle();
            if(stristr($oParent->oxarticles__oxvarname->value, '|') !== FALSE){
                //remove base sku
                $aParts = explode('-', $this->oxarticles__oxartnum->value);
                array_shift($aParts);
                $sku = implode('-', $aParts);

                $sku = str_replace($this->getDesignerVariantSku(), '', $sku);

                $this->_sDesignerSizeSku = trim($sku, '-');
            }
        }
        return $this->_sDesignerSizeSku;
    }

    public function getDesignerPrinttypeSku(){
        if ($this->getDesignerPrinttypeSmartyMatcher()){
            return $this->getDesignerSmartyMatch($this->getDesignerPrinttypeSmartyMatcher());
        }
    }

    protected function getDesignerProductSmartyMatcher () {
        return trim(implode(PHP_EOL, \OxidEsales\Eshop\Core\Registry::getConfig()->getConfigParam('aSmartyProductSkuMatcher', null, 'module:snwskumatcher')));
    }

    protected function getDesignerVariantSmartyMatcher () {
        return trim(implode(PHP_EOL, \OxidEsales\Eshop\Core\Registry::getConfig()->getConfigParam('aSmartyVariantSkuMatcher', null, 'module:snwskumatcher')));
    }

    protected function getDesignerSizeSmartyMatcher () {
        return trim(implode(PHP_EOL, \OxidEsales\Eshop\Core\Registry::getConfig()->getConfigParam('aSmartySizeSkuMatcher', null, 'module:snwskumatcher')));
    }

    protected function getDesignerPrinttypeSmartyMatcher () {
        return trim(implode(PHP_EOL, \OxidEsales\Eshop\Core\Registry::getConfig()->getConfigParam('aSmartyPrinttypeSkuMatcher', null, 'module:snwskumatcher')));
    }

    protected function getDesignerSmartyMatch ($matcher) {
        return trim(\OxidEsales\Eshop\Core\Registry::getUtilsView()->getRenderedContent($matcher, ['product' => $this], 'snwsku:'.$this->getId()));
    }


}