var config = {
    config: {
        mixins: {
            'Magento_Checkout/js/model/shipping-rates-validation-rules': {
                'Dww_Shiprestriction/js/model/shipping-rates-validation-rules-mixin': true
            },
            'Magento_Checkout/js/view/shipping': {
                'Dww_Shiprestriction/js/view/shipping-mixin': true
            }
        }
    }
};
