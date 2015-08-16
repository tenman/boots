jQuery( function ( $ ) {

    $( '#access .menu-header' ).after( '<a id="page-top"><span></span></a><a id="desmiss"><span></span></a>' );
    var topBtn = $( "#page-top" );
    topBtn.hide();
    $( '#desmiss' ).hide();
    var desmiss = false;
    var boots_window_width = jQuery( window ).width();
    $( '#desmiss' ).click( function () {

        topBtn.fadeOut();
        $( 'nav#access' ).removeClass( 'boots-menu-fixed' );
        desmiss = true;
    } );

    $( window ).scroll( function () {


        if ( $( this ).scrollTop() > 100 && desmiss == false  ) {

            topBtn.fadeIn();
            $( '#desmiss' ).fadeIn();
            $( 'nav#access' ).addClass( 'boots-menu-fixed' ).css({'min-height':'3.2em'});
            $( 'nav' ).css({'background':'#fff'});
            $( 'nav .menu > li > a' ).css({'color':'#555'});
            if ( boots_window_width < 641 ) {
                 $( 'nav .menu > li > a' ).removeAttr( 'style' );
            }
  
        } else {
            $( '#desmiss' ).fadeOut();
            topBtn.fadeOut();
            $( 'nav#access' ).removeClass( 'boots-menu-fixed' );
            $( 'nav' ).removeAttr( 'style' );
             $( 'nav .menu > li > a' ).removeAttr( 'style' );
        }
    } );
/*
     $(window).mousemove(function(e){
              
                var status_bar_window_height =  jQuery(window).innerHeight();
                if ( 300 > e.pageY - jQuery(this).scrollTop() && desmiss == false ) {
                     topBtn.fadeIn();
                    $( '#desmiss' ).fadeIn();
                } else {
                   $( '#desmiss' ).fadeOut();
                    topBtn.fadeOut();
                    $( 'nav#access' ).removeClass( 'boots-menu-fixed' );
                }
    });
*/
    topBtn.click( function () {
        $( "body,html" ).animate( {
            scrollTop: 0 }, 500 );
        return false;
    } );
    $( '#desmiss' ).click( function () {
        topBtn.fadeOut();
        $( 'nav#access' ).removeClass( 'boots-menu-fixed' );
    } );
} );

