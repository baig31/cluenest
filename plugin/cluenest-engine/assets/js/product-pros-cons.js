jQuery(function ($) {

    // Add Pro
    $('#add-product-pro').on('click', function () {

        $('#product-pros').append(

            '<div class="product-pros-cons-row" style="margin-bottom: 10px;">' +

                '<input type="hidden" ' +
                    'name="pros_cons_type[]" ' +
                    'value="pro">' +

                '<input type="text" ' +
                    'name="pros_cons_content[]" ' +
                    'class="regular-text" ' +
                    'placeholder="Product advantage"> ' +

                '<button type="button" ' +
                    'class="button remove-pros-cons">' +
                    'Remove' +
                '</button>' +

            '</div>'

        );

    });


    // Add Con
    $('#add-product-con').on('click', function () {

        $('#product-cons').append(

            '<div class="product-pros-cons-row" style="margin-bottom: 10px;">' +

                '<input type="hidden" ' +
                    'name="pros_cons_type[]" ' +
                    'value="con">' +

                '<input type="text" ' +
                    'name="pros_cons_content[]" ' +
                    'class="regular-text" ' +
                    'placeholder="Product disadvantage"> ' +

                '<button type="button" ' +
                    'class="button remove-pros-cons">' +
                    'Remove' +
                '</button>' +

            '</div>'

        );

    });


    // Remove Pro / Con
    $(document).on('click', '.remove-pros-cons', function () {

        $(this)
            .closest('.product-pros-cons-row')
            .remove();

    });

});