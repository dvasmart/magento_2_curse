/**
 * @api
 */
define([
    'jquery',
    'mage/storage',
    'mage/url',
    'mage/template',
    'text!Vitalii_Test/template/customer-cars.html',
    'text!Vitalii_Test/template/no-cars.html',
    'domReady!'
], function (
    $,
    storage,
    url,
    mageTemplate,
    customerCarsTemplate,
    noCarsTemplate
) {
    'use strict';

    $.widget('vitalii.getCustomerCars', {
        options: {
            useAjax: false,
            serviceUrl: 'rest/all/V1/test/cars/find/:userId',
            userId: 0,
            userName: 'User\'s',
            carsTemplate: customerCarsTemplate,
            noCarsTemplate: noCarsTemplate,
            container: '#cars-container'
        },

        _create: function () {
            if (!this.options.useAjax) {
                return;
            }

            var self = this;
            console.log('UserId: "' + this.options.userId + '"');
            console.log('AjaxUrl: "' + this.getAjaxUrl(this.options.serviceUrl, this.options.userId) + '"');
            $(this.element).on('click', function (event) {
                event.preventDefault();
                if (self.options.userId > 0) {
                    self.renderCustomerCars($(this));
                } else {
                    alert('You have not provided with the customer id!');
                }
            });
        },

        renderCustomerCars: function(element) {
            var self = this;
            var userId = this.options.userId;
            var fullUrl = this.getAjaxUrl(this.options.serviceUrl, userId);
            var container = $(document).find(self.options.container);
            container.trigger('processStart');
            storage.get(
                fullUrl, false
            ).done(function (response) {
                console.log(response);
                if (!response.length) {
                    self.renderNoCarsAnswer(element);
                    return;
                }

                var template = self.options.carsTemplate;
                var options = {
                    cars: response,
                    hrefMore: element.attr('href'),
                    userName: self.options.userName
                };
                var htmlToInsert = mageTemplate(template, options);
                container.hide();
                container.empty();
                container.html(htmlToInsert);
                container.animate({
                    opacity: 1,
                    width: "show"
                }, 250, function() {
                    container.show();
                });
                self.initClickOnCloseButton(container);
            }).fail(function (response) {
                console.log(response);
            }).always(function () {
                container.trigger('processStop');
            });
        },

        initClickOnCloseButton: function(container)
        {
            container.find('.close').off('click').on('click', function (event) {
                event.preventDefault();
                container.animate({
                    opacity: 0.25,
                    width: "hide"
                }, 500, function() {
                    container.hide();
                });
            });
        },

        renderNoCarsAnswer: function() {
            var container = $(document).find(this.options.container);
            var template = this.options.noCarsTemplate;
            var options = {
                userName: this.options.userName
            };
            var htmlToInsert = mageTemplate(template, options);
            container.hide();
            container.empty();
            container.html(htmlToInsert);
            container.animate({
                opacity: 1,
                width: "show"
            }, 250, function() {
                container.show();
            });
            this.initClickOnCloseButton(container);
        },

        getAjaxUrl: function (serviceUrl, userId) {
            var ajaxUrl = serviceUrl.replace(":userId", userId);
            url.setBaseUrl(BASE_URL);
            return url.build(ajaxUrl)
        }
    });

    return $.vitalii.getCustomerCars;
});
