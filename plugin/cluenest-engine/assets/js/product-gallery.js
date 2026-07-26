jQuery(function ($) {

    let galleryFrame;

    $('#select-gallery-images').on('click', function (e) {

        e.preventDefault();

        if (galleryFrame) {
            galleryFrame.open();
            return;
        }

        galleryFrame = wp.media({
            title: 'Select Gallery Images',
            button: {
                text: 'Use Images'
            },
            multiple: true
        });

        galleryFrame.on('select', function () {

            const selection = galleryFrame
                .state()
                .get('selection')
                .toJSON();

            selection.forEach(function (attachment) {

                if ($('#gallery-preview').find('[data-id="' + attachment.id + '"]').length) {
                    return;
                }

                $('#gallery-preview').append(
                    '<div class="gallery-item" data-id="' + attachment.id + '">' +
                        '<img src="' + attachment.sizes.thumbnail.url + '">' +
                        '<input type="hidden" name="gallery_image_ids[]" value="' + attachment.id + '">' +
                        '<p><button type="button" class="button remove-gallery-image">Remove</button></p>' +
                    '</div>'
                );

            });

        });

        galleryFrame.open();

    });

    $(document).on('click', '.remove-gallery-image', function (e) {

        e.preventDefault();

        $(this)
            .closest('.gallery-item')
            .remove();

    });


   $('#gallery-preview').sortable({
    items: '.gallery-item',
    cursor: 'move',
    opacity: 0.8,
    placeholder: 'gallery-placeholder',
    tolerance: 'pointer'
});

});