define([
    'uiComponent',
    'jquery',
    'ko',
    'underscore',
    'Magento_Ui/js/modal/alert',
    'uiRegistry',
    'mage/translate'
], function (Component, $, ko, _, alert, registry, $t) {
    'use strict';

    return Component.extend({
        defaults: {
            myObservableCount: ko.observable(0)
        },

        /** @inheritdoc */
        initialize: function () {
            this._super();
            console.log('Initialized! Success!');
        },

        /** @inheritdoc */
        initObservable: function () {
            this._super().observe(
                'myObservableCount'
            );

            var self = this;
            this.myObservableCount.subscribe(function (value) {
                self.applyFilter(value);
            });

            return this;
        },

        applyFilter: function (value) {
            var list = $(document).find(this.listItemsSelector);
            var parsedValue = parseInt(value);
            var parsedValue = isNaN(parsedValue) ? 0 : parsedValue;
            list.hide();
            var count = 1;
            console.log('new value is: "' + parsedValue + '"');
            _.each(list, function (element) {
                console.log('count is: "' + count + '"');
                var text = $(element).find('.user-name').text();
                if (count > parsedValue) {
                    console.log('count is grater than new value -> skip showing element for user: "' + text + '"!');
                    count++;
                    return false;
                }

                console.log('count is lower than new value -> show element for user: "' + text + '"!');
                $(element).show();
                count++;
            }, this);
        }
    });
});
