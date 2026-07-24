jQuery(function ($) {

    let mediaFrame;

    $('#select-featured-image').on('click', function (e) {

        e.preventDefault();

        if (mediaFrame) {
            mediaFrame.open();
            return;
        }

        mediaFrame = wp.media({
            title: 'Select Featured Image',
            button: {
                text: 'Use this image'
            },
            multiple: false
        });

        mediaFrame.on('select', function () {

            const attachment = mediaFrame
                .state()
                .get('selection')
                .first()
                .toJSON();

            $('#featured_image_id').val(attachment.id);

            $('#featured-image-preview').html(
                '<img src="' +
                attachment.url +
                '" style="max-width:180px;height:auto;border:1px solid #ddd;padding:5px;display:block;margin-bottom:10px;">'
            );

            $('#remove-featured-image').show();

        });

        mediaFrame.open();

    });

    $('#remove-featured-image').on('click', function (e) {

        e.preventDefault();

        $('#featured_image_id').val('');

        $('#featured-image-preview').html('');

        $(this).hide();

    });

});