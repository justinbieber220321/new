/*
 * jQuery Maxlength plugin 1.0.0
 *
 * Copyright (c) 2013 Viral Patel
 * http://viralpatel.net
 *
 * Licensed under the MIT license:
 *   http://www.opensource.org/licenses/mit-license.php
 */

;(function ($) {

	$.fn.maxlength = function(){
		 
		$("textarea[maxlength], input[maxlength]").keypress(function(event){ 
			var key = event.which;
			 
			//all keys including return.
			if(key >= 33 || key == 13 || key == 32) {
				var maxLength = $(this).attr("maxlength");
				var length = this.value.length;
				if(length >= maxLength) {					 
					event.preventDefault();
				}
			}
		});
	}

})(jQuery);