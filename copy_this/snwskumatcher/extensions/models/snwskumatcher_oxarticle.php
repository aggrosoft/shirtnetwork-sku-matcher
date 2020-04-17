<?php

class snwskumatcher_oxarticle extends snwskumatcher_oxarticle_parent {

    protected $_sDesignerVariantSku;
    protected $_sDesignerSizeSku;

    public function getDesignerVariantSku(){

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


}