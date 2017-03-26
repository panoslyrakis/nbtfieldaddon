(function($){

	$( document ).ready(function(){

		$( '.blog_template-item_selector' ).on( 'click', function(){

			var previewer = $( this ).parent();

			var theme_key = previewer.data( 'tkey' );
			
			$( '#blog-template-radio-' + theme_key ).prop("checked", true);

		} );

	});

})(jQuery);
