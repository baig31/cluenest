jQuery(function ($) {

    $('#add-highlight').on('click', function () {

        $('#product-highlights').append(

            '<div class="product-highlight-row">' +

                '<input type="text" name="highlight[]" class="regular-text" placeholder="Highlight"> ' +

                '<button type="button" class="button remove-highlight">Remove</button>' +

            '</div>'

        );

    });

    $(document).on('click', '.remove-highlight', function () {

        $(this)
            .closest('.product-highlight-row')
            .remove();

    });

});