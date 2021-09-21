jQuery( document ).ready( function( $ ) {
console.log('xxxx');
	/**
	* Image upload 
	*/ 
	$( '.mx_upload_image' ).on( 'click', function( e ) {

		var mx_upload_button = $( this );

		e.preventDefault();

		var frame;

		if ( frame ) {
			frame.open();
			return;
		}

		frame = wp.media({

			title: 'choose image',

			library: {
				type: 'image'
			},

			button: {

				text: 'Upload'
			},

			multyple: false
		});


		frame.on( 'select', function() {

			var attachment = frame.state().get('selection').first();

			// and show the image's data
			var image_id = attachment.id;

			var image_url = attachment.attributes.url;

			// pace an id
			mx_upload_button.parent().find( '.mx_upload_image_save' ).val( image_id );

			// show an image
			mx_upload_button.parent().find( '.mx_upload_image_show' ).attr( 'src', image_url );
				mx_upload_button.parent().find( '.mx_upload_image_show' ).show();

			// show "remove button"
			mx_upload_button.parent().find( '.mx_upload_image_remove' ).show();

			// hide "upload" button
			mx_upload_button.hide();

		} );

		frame.open();

	} );

	// remove image
	$( '.mx_upload_image_remove' ).on( 'click', function( e ) {

		var remove_button = $( this );

		e.preventDefault();

		// remove an id
		remove_button.parent().find( '.mx_upload_image_save' ).val( '' );

		// hide an image
		remove_button.parent().find( '.mx_upload_image_show' ).attr( 'src', '' );
			remove_button.parent().find( '.mx_upload_image_show' ).hide();

		// show "Upload button"
		remove_button.parent().find( '.mx_upload_image' ).show();

		// hide "remove" button
		remove_button.hide();

	} );

	/**
	* Video upload
	*/
	$( '.mx_upload_video' ).on( 'click', function( e ) {

		var mx_upload_button = $( this );

		e.preventDefault();

		var frame;

		if ( frame ) {
			frame.open();
			return;
		}

		frame = wp.media({

			title: 'choose video',

			library: {
				type: 'video'
			},

			button: {

				text: 'Upload'
			},

			multyple: false
		});


		frame.on( 'select', function() {

			var attachment = frame.state().get('selection').first();

			// and show the video's data
			var video_id = attachment.id;

			var video_url = attachment.attributes.url;

			// pace an id
			mx_upload_button.parent().find( '.mx_upload_video_save' ).val( video_id );

			// show an video
			mx_upload_button.parent().find( '.mx_upload_video_show' ).attr( 'src', video_url );
				mx_upload_button.parent().find( '.video-wrapper' ).show();

				mx_upload_button.parent().find( '.video-wrapper' ).load();

			// show "remove button"
			mx_upload_button.parent().find( '.mx_upload_video_remove' ).show();

			// hide "upload" button
			mx_upload_button.hide();

		} );

		frame.open();

	} );

	// remove video
	$( '.mx_upload_video_remove' ).on( 'click', function( e ) {

		var remove_button = $( this );

		e.preventDefault();

		// remove an id
		remove_button.parent().find( '.mx_upload_video_save' ).val( '' );

		// hide an video
		remove_button.parent().find( '.mx_upload_video_show' ).attr( 'src', '' );
			remove_button.parent().find( '.video-wrapper' ).hide();

		// show "Upload button"
		remove_button.parent().find( '.mx_upload_video' ).show();

		// hide "remove" button
		remove_button.hide();

	} );

	/**
	* Document upload
	*/
	$( '.mx_upload_document' ).on( 'click', function( e ) {

		var mx_upload_button = $( this );

		e.preventDefault();

		var frame;

		if ( frame ) {
			frame.open();
			return;
		}

		frame = wp.media({

			title: 'choose document',

			library: {
			},

			button: {

				text: 'Upload'
			},

			multyple: false
		});


		frame.on( 'select', function() {

			var attachment = frame.state().get('selection').first();

			// and show the document's data
			var document_id = attachment.id;

			var document_url = attachment.attributes.url;

			// pace an id
			mx_upload_button.parent().find( '.mx_upload_document_save' ).val( document_id );

			// show an document
			mx_upload_button.parent().find( '.mx_upload_document_show' ).text( document_url );
				mx_upload_button.parent().find( '.mx_upload_document_show' ).show();

			// show "remove button"
			mx_upload_button.parent().find( '.mx_upload_document_remove' ).show();

			// hide "upload" button
			mx_upload_button.hide();

		} );

		frame.open();

	} );

	// remove document
	$( '.mx_upload_document_remove' ).on( 'click', function( e ) {

		var remove_button = $( this );

		e.preventDefault();

		// remove an id
		remove_button.parent().find( '.mx_upload_document_save' ).val( '' );

		// hide an document
		remove_button.parent().find( '.mx_upload_document_show' ).text( '' );
			remove_button.parent().find( '.mx_upload_document_show' ).hide();

		// show "Upload button"
		remove_button.parent().find( '.mx_upload_document' ).show();

		// hide "remove" button
		remove_button.hide();

	} );

} );

function addNewField(elem) {

    const buttonIdStr = elem.id;
  
    const splitingArray = buttonIdStr.split("_");
  
    const filteredArray = splitingArray.filter(e => e !== "");
  
    const elemPrefix = filteredArray[0];
  
    const elemId = filteredArray[filteredArray.length-1];
  
    const elemPrefixSlicer = "_"+elemPrefix+"_";
  
    const elemIdSlicer = "_"+elemId;
  
    const parentIdStr = buttonIdStr.replace(elemPrefixSlicer, "").replace(elemIdSlicer, "");
  
    const parentElem = elem.closest("#"+parentIdStr);
  
    const parentNodes = parentElem.querySelectorAll('[id*='+parentIdStr+'');
  
    parentNodes.forEach(
    function(currentValue, currentIndex, listObj) {
  
      const node = parentNodes[currentIndex]
  
      if ( node.required && node.value === "" ) {
          elem.preventDefault();
      }
  
    },
    'myThisArg'
  );
  
      const arrayIds = parentIdStr.match(/\d+/g);
  
      const newIdLength = arrayIds ? arrayIds.length : null;
  
      const newId = arrayIds ? arrayIds[newIdLength] : null;
  
      const elementsParentIdStr = arrayIds ? parentIdStr.substring(0, parentIdStr.length - newIdLength) : parentIdStr
  
      const elements = document.querySelectorAll('div[id^='+elementsParentIdStr+'');
  
    let div = document.getElementById(parentIdStr),
      clone = div.cloneNode(true); // true means clone all childNodes and all event handlers
      id = elements.length;
      clone.id = elementsParentIdStr+""+id;
      elem.remove();
      document.body.appendChild(clone);
  
      const nodes = clone.querySelectorAll('[id*='+parentIdStr+'');
  
      nodes.forEach(
      function(currentValue, currentIndex, listObj) {
  
          nodes[currentIndex].id = nodes[currentIndex].id.replace(parentIdStr, clone.id);
  
          if ( nodes[currentIndex].id == clone.id+"_nonce_name") {
              nodes[currentIndex].value = nodes[currentIndex].value+""+id
          } else {
              nodes[currentIndex].value = "";
          }
    },
    'myThisArg'
  );
  
  }