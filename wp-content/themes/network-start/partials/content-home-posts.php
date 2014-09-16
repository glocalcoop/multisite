<script type="text/javascript">
jQuery(document).ready(function(){
  jQuery('.news-list').bxSlider({
    slideWidth: 5000,
    minSlides: 2,
    maxSlides: 2,
    slideMargin: 10,
    pager: false
  });
  var responsive_viewport = jQuery(window).width();
  if (responsive_viewport < 320) {
      jQuery('.news-list').reloadSlider({
	    slideWidth: 5000,
	    minSlides: 1,
	    maxSlides: 1,
	    slideMargin: 10,
	    pager: false
      });
  } 
});
</script>

<?php get_template_part( 'partials/queries/query-home', 'posts' ); ?>