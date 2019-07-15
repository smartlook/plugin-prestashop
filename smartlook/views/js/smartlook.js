/**
 * Smartlook integration module.
 * 
 * @package   Smartlook
 * @author    Smartlook <vladimir@smartsupp.com>
 * @link      http://www.smartsupp.com
 * @copyright 2015 Smartsupp.com
 * @license   GPL-2.0+
 *
 * Plugin Name:       Smartlook
 * Plugin URI:        http://www.getsmartlook.com
 * Description:       Adds Smartlook code to PrestaShop.
 * Version:           2.1.0
 * Author:            Smartsupp
 * Author URI:        http://www.smartsupp.com
 * Text Domain:       smartlook
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

jQuery(document).ready( function($) {

    $( "#smartlook_configuration" ).next( ".bootstrap" ).hide();
    $( "#smartlook_choose_configuration" ).next( ".bootstrap" ).hide();
    
    $( "select#SMARTLOOK_PROJECT_KEY" ).change(function() {
            if ($(this).children('option:first-child').is(':selected')) {
                    $( "#smartlook_choose_configuration .project-name" ).show();
            }
            else {
                    $( "#smartlook_choose_configuration .project-name" ).hide();                
            }
    });
        
    function retrieve_projects() {
        $.ajax({
                url: ajax_controller_url,
                async: false,
                type: 'POST',
                data: {
                    action: 'projects'
                },                
                dataType: 'json',
                headers: { "cache-control": "no-cache" },
                success: function(data) {
                        var first_option = $("select#SMARTLOOK_PROJECT_KEY option:first").html();
                        var options = '<option value="0">' + first_option + '</option>' + data.projects;
                        $("select#SMARTLOOK_PROJECT_KEY").html(options);
                        if (data.error === null) {
                            $("div.smartlook_landing_page").hide();
                        }
                        else {
                            $("div.smartlook_landing_page").show();
                            $("div.smartlook_landing_page span").html(data.message);
                        }
                }
        });                
    }

    function page_refresh() {    
        if ($( "#smartlook_key" ).val() === "") {
            $( "#smartlook_create_account" ).hide();
            $( "#smartlook_connect_account" ).hide();
            $( "#smartlook_configuration" ).hide();
            if (($("#smartlook_configuration p.email")).html() === "") {
                $( "#smartlook_choose_configuration" ).hide();
                $( "#smartlook_landing_page" ).show();
            }
            else {
                retrieve_projects();                
                $( "#smartlook_landing_page" ).hide();                
                $( "#smartlook_choose_configuration" ).show();
            }
        }
        else {
            $( "#smartlook_landing_page" ).hide();
            $( "#smartlook_create_account" ).hide();
            $( "#smartlook_connect_account" ).hide();
            if ($( "#smartlook_project_key" ).val() === "") {
                retrieve_projects();                
                $( "#smartlook_configuration" ).hide();
                $( "#smartlook_choose_configuration" ).show();
            }
            else {
                $( "#smartlook_choose_configuration" ).hide();
                $( "#smartlook_configuration" ).show();
            }
        }        
        //$( "#configuration_form.smartlook" ).hide();
    } 
    page_refresh();
    
    $( "#connect_existing_account_btn" ).click(function() {
        $("#smartlook_configuration").next('.bootstrap').hide();
        $("div.smartlook_landing_page").hide();
        $( "#smartlook_landing_page" ).hide();
        $( "#smartlook_connect_account" ).show();
    });
    
    $( "#create_account_btn" ).click(function() {
        $("#smartlook_configuration").next('.bootstrap').hide();
        $("div.smartlook_landing_page").hide();
        $( "#smartlook_connect_account" ).hide();
        $( "#smartlook_landing_page" ).show();
    });
    
    $( "#connect_existing_account_do" ).click(function() {
        $.ajax({
                url: ajax_controller_url,
                async: false,
                type: 'POST',
                data: {
                    action: 'login', 
                    email: $( "#smartlook_connect_account #SMARTLOOK_EMAIL" ).val(), 
                    password: $( "#smartlook_connect_account #SMARTLOOK_PASSWORD" ).val()
                },
                dataType: 'json',
                headers: { "cache-control": "no-cache" },
                success: function(data) {
                        $("input#smartlook_key").val(data.key);
                        $("input#smartlook_project_key").val(data.projectKey);
                        $("#smartlook_choose_configuration p.email").html(data.email);
                        $("#smartlook_configuration p.email").html(data.email);
                        var first_option = $("select#SMARTLOOK_PROJECT_KEY option:first").html();
                        var options = '<option>' + first_option + '</option>' + data.projects;
                        $("select#SMARTLOOK_PROJECT_KEY").html(options);
                        if (data.error === null) {
                            $("div.smartlook_landing_page").hide();
                        }
                        else {
                            $("div.smartlook_landing_page").show();
                            $("div.smartlook_landing_page span").html(data.message);
                        }
                }
        });        
        page_refresh();
    });

    $( "#create_account_do" ).click(function() {
        $( "#smartlook_landing_page #SMARTLOOK_DPA_LABEL" ).removeClass("invalid");
        if ($( "#smartlook_landing_page #SMARTLOOK_DPA" ).is(':checked')) {      
		$.ajax({
			url: ajax_controller_url,
			async: false,
			type: 'POST',
			data: {
			    action: 'create', 
			    email: $( "#smartlook_landing_page #SMARTLOOK_EMAIL" ).val(), 
			    password: $( "#smartlook_landing_page #SMARTLOOK_PASSWORD" ).val()
			},
			dataType: 'json',
			headers: { "cache-control": "no-cache" },
			success: function(data) {
				$("input#smartlook_key").val(data.key);
				$("input#smartlook_project_key").val(data.projectKey);
				$("#smartlook_configuration p.email").html(data.email);                                        
				if (data.error === null) {
				    $("div.smartlook_landing_page").hide();
				}
				else {
				    $("div.smartlook_landing_page").show();
				    $("div.smartlook_landing_page span").html(data.message);
				}
			}
		});      
		page_refresh();
	}
        else {
            $( "#smartlook_landing_page #SMARTLOOK_DPA" ).focus();
            $( "#smartlook_landing_page #SMARTLOOK_DPA_LABEL" ).addClass("invalid");
        }	
    });
        
    $( "#assign_project_do" ).click(function() {
        if ($( "#smartlook_choose_configuration #SMARTLOOK_PROJECT_KEY" ).val() === '0' && $( "#smartlook_choose_configuration #SMARTLOOK_PROJECT_NAME" ).val().trim() === "") {
            alert('Project name is missing. Please enter it!');
        }
        else {
            $.ajax({
                    url: ajax_controller_url,
                    async: false,
                    type: 'POST',
                    data: {
                        action: 'assign', 
                        project_key: $( "#smartlook_choose_configuration #SMARTLOOK_PROJECT_KEY" ).val(), 
                        project_name: $( "#smartlook_choose_configuration #SMARTLOOK_PROJECT_NAME" ).val(), 
                    },
                    dataType: 'json',
                    headers: { "cache-control": "no-cache" },
                    success: function(data) {
                            $("#smartlook_choose_configuration #SMARTLOOK_PROJECT_NAME").val('');        
                            $("input#smartlook_key").val(data.key);
                            $("input#smartlook_project_key").val(data.projectKey);
                            $("#smartlook_configuration p.email").html(data.email);                                        
                            if (data.error === null) {
                                $("div.smartlook_landing_page").hide();
                            }
                            else {
                                $("div.smartlook_landing_page").show();
                                $("div.smartlook_landing_page span").html(data.message);
                            }
                    }
            });
        }
        page_refresh();
    });

    $( "#deactivate_chat_do" ).click(function() {
        $("#smartlook_configuration").next('.bootstrap').hide();
        $.ajax({
                url: ajax_controller_url,
                async: false,
                type: 'POST',
                data: {
                    action: 'deactivate'
                },
                dataType: 'json',
                headers: { "cache-control": "no-cache" },
                success: function(data) {
                        $("input#smartlook_key").val(data.key);
                        $("input#smartlook_project_key").val(data.projectKey);
                        $("#smartlook_configuration p.email").html(data.email);
                }
        });
        page_refresh();
    });
});