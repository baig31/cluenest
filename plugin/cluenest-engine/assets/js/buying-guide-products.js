jQuery(function ($) {

    function rebuildHiddenInputs() {

        const container = $('#buying-guide-product-hidden-inputs');

        container.empty();

        $('#selected-buying-guide-products')
            .find('.selected-buying-guide-product')
            .each(function () {

                const productId = $(this).data('product-id');

                $('<input>')
                    .attr('type', 'hidden')
                    .attr('name', 'product_ids[]')
                    .val(productId)
                    .appendTo(container);
            });
    }


    function addProduct(productId, productName) {

        if (
            $('#selected-buying-guide-products')
                .find(
                    '[data-product-id="' +
                    productId +
                    '"]'
                )
                .length
        ) {
            return;
        }

        $('#selected-buying-guide-products').append(

            '<li ' +
                'class="selected-buying-guide-product" ' +
                'data-product-id="' + productId + '" ' +
                'style="' +
                    'list-style:none;' +
                    'padding:10px;' +
                    'margin-bottom:8px;' +
                    'border:1px solid #ddd;' +
                    'background:#fff;' +
                    'cursor:move;' +
                '"' +
            '>' +

                '<span style="margin-right:10px;color:#777;">☰</span>' +

                '<strong>' +
                    $('<div>').text(productName).html() +
                '</strong>' +

            '</li>'
        );

        rebuildHiddenInputs();
    }


    function removeProduct(productId) {

        $('#selected-buying-guide-products')
            .find(
                '[data-product-id="' +
                productId +
                '"]'
            )
            .remove();

        rebuildHiddenInputs();
    }


    $('.buying-guide-product-checkbox').on(
        'change',
        function () {

            const productId = $(this).val();

            const productName = $(this)
                .closest('.buying-guide-product-option')
                .find('strong')
                .first()
                .text()
                .trim();

            if ($(this).is(':checked')) {

                addProduct(
                    productId,
                    productName
                );

            } else {

                removeProduct(productId);
            }
        }
    );


    $('#selected-buying-guide-products').sortable({

        items: '.selected-buying-guide-product',

        cursor: 'move',

        opacity: 0.8,

        placeholder: 'buying-guide-product-placeholder',

        tolerance: 'pointer',

        update: function () {

            rebuildHiddenInputs();
        }
    });


    rebuildHiddenInputs();

});