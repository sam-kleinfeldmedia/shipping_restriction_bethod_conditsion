define([], function () {
    'use strict';

    return function (Component) {
        return Component.extend({
            selectShippingMethod: function (shippingMethod) {
                if (!shippingMethod.available) {
                    return false;
                }

                return this._super(shippingMethod);
            }
        });
    };
});
