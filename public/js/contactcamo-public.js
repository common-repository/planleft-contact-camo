( function( $ ) {
        'use strict';

        $( document ).ready(function() {

                $( this ).on( 'click', '.contactcamo-link-popup', function () {

                        $( '.contactcamo-popup' ).show();

                } );

                $( this ).on( 'click', '#contactcamo-close', function () {

                        $( '.contactcamo-popup' ).hide();

                } );

                $( this ).on( 'click', '.contactcamo-hidden-email', function ( e ) {

                        e.preventDefault();

                        let hashed_email = $( this ).attr( 'data-email' );
                        let subject = $( this ).attr( 'data-subject' );

                        $.ajax( {

                                type : 'GET',
                                dataType : 'json',
                                url : contactcamoajax.restURL + 'baseURL/v1/baseEndPoint/endPoint',
                                beforeSend: function ( xhr ) {
                                        xhr.setRequestHeader( 'X-WP-NONCE', contactcamoajax.restNonce )
                                },

                                data : {
                                        hashed_email : hashed_email
                                },

                                success : function( response ) {

                                        if (response) {
                                                let email = response[0].email;

                                                window.open( 'mailto:' + email + '?subject=' + subject,'_blank' );

                                                return false;
                                        }

                                },
                                error : function( response ) {

                                        if ( response ) {
                                            console.log( response );
                                        }

                                }

                        } );

                } );

        } );

} )( jQuery );
