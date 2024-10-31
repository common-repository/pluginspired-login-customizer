(function( $ ) {

  var file_frame;

	$('.add_image_button').on('click', function( event ) {

    event.preventDefault();

    // If the media frame already exists, reopen it.
    if ( file_frame ) {
      file_frame.open();
      return;
    }

    // Create the media frame.
    file_frame = wp.media.frames.file_frame = wp.media({
      title: $( this ).data( 'uploader_title' ),
      button: {
        text: $( this ).data( 'uploader_button_text' ),
      },
      multiple: false  // Set to true to allow multiple files to be selected
    });

    // When an image is selected, run a callback.
    file_frame.on( 'select', function() {
      // We set multiple to false so only get one image from the uploader
      attachment = file_frame.state().get( 'selection' ).first().toJSON();

      // Show the image on the page
      $( ".image_preview" ).children( 'img' ).attr( 'src', attachment.url ).show();
      $( ".image_field" ).val( attachment.url );
      $( ".add_image_button" ).html('Change Image');
      $( ".remove_image_button" ).show();
      $( ".image_preview" ).show();

    });

    // Finally, open the modal
    file_frame.open();
  });

  $('.remove_image_button').on('click', function() {
    $( ".image_preview" ).children( 'img' ).attr( 'src', '' );
    $( ".image_field" ).val('');
    $( ".add_image_button" ).html('Add Image');
    $( ".remove_image_button" ).hide();
    $( ".image_preview" ).hide();
  });

  /* Handle custom logo options visibility */
  $('.use_custom_logo').on('click', function(event) {
    if ($(this).is(':checked')) {
      $(this).attr('checked', true);
      $(".use_custom_logo_settings").show();
    }
    else {
      if (confirm('Are you sure you want to do this? All logo settings will be lost when saved!')) {
        $(this).attr('checked', false);
        $(".use_custom_logo_settings").hide();
      }
      else {
        $(this).attr('checked', true);
      }
      e.preventDefault();
      return false;
    }
  });

  /* Handle custom styles options visibility */
  $('.use_custom_styles').on('click', function(event) {
    if ($(this).is(':checked')) {
      $(this).attr('checked', true);
      $(".use_custom_styles_settings").show();
    }
    else {
      if (confirm('Are you sure you want to do this? All custom CSS styles will be lost when saved!')) {
        $(this).attr('checked', false);
        $(".use_custom_styles_settings").hide();
      }
      else {
        $(this).attr('checked', true);
      }
      e.preventDefault();
      return false;
    }
  });

  // Initialize the WordPress color picker on inputs with color-field class
  $(function() {
    $('.color-field').wpColorPicker();
  });

})( jQuery );
