window.MySite_CMB2 = window.MySite_CMB2 || {};
 
(function( window, document, $, app, undefined ) {
    'use strict';
    console.log('itrend-edit-script');
    app.cache = function() {
        app.$ = {};
        app.$.checkboxPrevencion = $('div[class*="cmb2-id--itrend-acciones"] input[type="checkbox"], div.cmb2-id--itrend-tareas-taxonomy-replacement input[type="checkbox"], div.cmb2-id--itrend-acciones-taxonomy-replacement input[type="checkbox"]');
    };
 
    app.init = function() {
        app.cache();
        checkChecked()

        app.$.checkboxPrevencion.on( 'change', function( event ) {
            checkChecked();
        } ).trigger( 'change' );
    };
 
    $( document ).ready( app.init );
})( window, document, jQuery, MySite_CMB2 );

function checkChecked() {
    var descFields = jQuery( 'div[class*="itrend-descripcion-accion"], div[class*="itrend-descripcion-relacion-tarea"], div[class*="itrend-descripcion-relacion-accion"]' );
    descFields.hide();

    jQuery.each(jQuery('div[class*="cmb2-id--itrend-acciones"] input:checked, div.cmb2-id--itrend-tareas-taxonomy-replacement input:checked, div.cmb2-id--itrend-acciones-taxonomy-replacement input:checked'), function() {
        var val = jQuery(this).val();
        console.log(val);
        jQuery('div.cmb-type-wysiwyg[class*="' + val + '"]').show()
    });
}