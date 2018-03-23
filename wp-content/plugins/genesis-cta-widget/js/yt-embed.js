// Set iframe SRC from data-youtubeID attr in button
function gctaYTmodal() {
	var trigger = jQuery("body").find('[data-toggle="modal"]');
	trigger.click(function () {
		var theModal = jQuery(this).data("target"),
			videoSRC = jQuery(this).attr("data-youtubeID"),
			videoSRC = "https://www.youtube-nocookie.com/embed/" + videoSRC + "?controls=0",
			videoSRCauto = videoSRC + ";autoplay=1";
		jQuery(theModal + ' iframe').attr('src', videoSRCauto);
		jQuery(theModal).click(function () {
			jQuery(theModal + ' iframe').attr('src', videoSRC);
		});
		jQuery(document).keyup(function(e) {
			if (e.keyCode == 27) { // Escape key
				jQuery(theModal + ' iframe').attr('src', videoSRC);
			}
		})
	});
}
