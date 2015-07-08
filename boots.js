jQuery( function ( $ ) {

    $( '#access .menu-header' ).after( '<a id="page-top"><span></span></a><a id="desmiss"><span></span></a>' );
    var topBtn = $( "#page-top" );
    topBtn.hide();
    $( '#desmiss' ).hide();
    var desmiss = false;
    $( '#desmiss' ).click( function () {

        topBtn.fadeOut();
        $( 'nav#access' ).removeClass( 'boots-menu-fixed' );
        desmiss = true;
    } );

    $( window ).scroll( function () {

        if ( $( this ).scrollTop() > 100 && desmiss == false ) {
            topBtn.fadeIn();
            $( '#desmiss' ).fadeIn();
            $( 'nav#access' ).addClass( 'boots-menu-fixed' );
        } else {
            $( '#desmiss' ).fadeOut();
            topBtn.fadeOut();
            $( 'nav#access' ).removeClass( 'boots-menu-fixed' );
        }
    } );

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

