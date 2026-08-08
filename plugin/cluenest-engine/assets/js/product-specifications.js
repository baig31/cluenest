jQuery(function ($) {

    $('#add-specification').on('click', function () {

        $('#product-specifications').append(

            '<div class="product-specification-row">' +

                '<input type="text" name="specification[]" class="regular-text" placeholder="Specification"> ' +

                '<input type="text" name="value[]" class="regular-text" placeholder="Value"> ' +

                '<button type="button" class="button remove-specification">Remove</button>' +

            '</div>'

        );

    });

    $(document).on('click', '.remove-specification', function () {

        $(this)
            .closest('.product-specification-row')
            .remove();

    });

});