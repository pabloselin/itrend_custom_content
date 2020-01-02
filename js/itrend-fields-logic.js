window.MySite_CMB2 = window.MySite_CMB2 || {};

 
(function( window, document, $, app, undefined ) {
    'use strict';
    console.log('itrend-edit-script');
    app.cache = function() {
        app.$ = {};
        app.$.checkboxPrevencion = $('div[class*="cmb2-id--itrend-acciones"] input[type="checkbox"], div.cmb2-id--itrend-tareas-taxonomy-replacement input[type="checkbox"], div.cmb2-id--itrend-acciones-taxonomy-replacement input[type="checkbox"]');
        app.$.selectRegion = $('select#_itrend_contacto_region');
        app.$.selectComuna = $('select#_itrend_contacto_comuna');
        app.$.checkboxTareas = $('#cmb2-metabox-_itrend_itrend_tareas_actor input[type="checkbox"]');
    };
 
    app.init = function() {
        app.cache();
        checkChecked()

        app.$.checkboxPrevencion.on( 'change', function( event ) {
            checkChecked();
        } ).trigger( 'change' );

        app.$.selectRegion.on('change', function( event ) {
            console.log('changingng');
            var val = jQuery("option:selected", this).val();
            var comunas = itrend_fields[val];
            app.$.selectComuna.empty();
            for( var i = 0; i < comunas.length; i++) {
                app.$.selectComuna.append('<option value="' + comunas[i] + '">' + comunas[i] + '</option>');
            }
        })

        $.each(app.$.checkboxTareas, function() {
            var tareaInfo = itrend_tareas[$(this).val()];
            $(this).next('label').prepend("<strong>" + tareaInfo.numero + ".</strong> ");
        });


    };
 
    $( document ).ready( app.init );
})( window, document, jQuery, MySite_CMB2 );

function checkChecked() {
    var descFields = jQuery( 'div[class*="itrend-descripcion-accion"], div[class*="itrend-descripcion-relacion-tarea"], div[class*="itrend-descripcion-relacion-accion"]' );
    descFields.hide();

    jQuery.each(jQuery('div.cmb2-id--itrend-tareas-taxonomy-replacement input:checked'), function() {
        var val = jQuery(this).val();
        jQuery('#_itrend_itrend_tareas_actor div.cmb-type-wysiwyg[class*="' + val + '"]').show()
    });

    jQuery.each(jQuery('div.cmb2-id--itrend-acciones-taxonomy-replacement input:checked'), function() {
        var val = jQuery(this).val();
        jQuery('#_itrend_itrend_acciones_actor div.cmb-type-wysiwyg[class*="' + val + '"]').show()
    });
}