{*
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
 * Version:           1.0.0
 * Author:            Smartsupp
 * Author URI:        http://www.smartsupp.com
 * Text Domain:       smartlook
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 *}

<script type="text/javascript">
    var ajax_controller_url = "{$ajax_controller_url|escape:'htmlall':'UTF-8'}";    
</script>
<input id="smartlook_key" type="hidden" value="{$smartlook_key|escape:'htmlall':'UTF-8'}">
<input id="smartlook_project_key" type="hidden" value="{$smartlook_project_key|escape:'htmlall':'UTF-8'}">
<div class="bootstrap smartlook_landing_page">
        <div class="module_error alert alert-danger">
                <button class="close" data-dismiss="alert" type="button">×</button>
                <span></span>
        </div>
</div>
<div id="smartlook_landing_page" class="panel">
        <div class="intro">
                <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <img src="{$module_dir|escape:'html':'UTF-8'}views/img/smartlook_logo.png" alt="Smartlook" />
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <button id="connect_existing_account_btn" class="btn btn-default pull-right">{l s='Connect existing account' mod='smartlook'}</button>
                        </div>
                </div>
                <hr/>
                <div class="row text-center">
                        <div class="row">
                                <p class="title">
                                        <strong>
                                                {l s='We will record everything visitors do.' mod='smartlook'}
                                                <br/>
                                                {l s='On every website. For free.' mod='smartlook'}
                                        </strong>
                                </p>
                                <p class="title">
                                        {l s='Look at your website through your customer\'s eyes!' mod='smartlook'}
                                </p>
                        </div>
                </div>
                <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"></div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-center">
                                <p>
                                        <div class="input-group">
                                            <span class="input-group-addon"> {l s='E-mail' mod='smartlook'}</span>
                                            <input id="SMARTLOOK_EMAIL" type="text" size="30" value="" name="SMARTLOOK_EMAIL">
                                        </div>
                                        <br/>
                                        <div class="input-group">
                                            <span class="input-group-addon"> {l s='Password' mod='smartlook'} </span>
                                            <input id="SMARTLOOK_PASSWORD" type="password" size="30" value="" name="SMARTLOOK_PASSWORD">
                                        </div>   
					<br/>
					<div>
					    <input id="SMARTLOOK_DPA" type="checkbox" value="" name="SMARTLOOK_DPA">
					    <span id="SMARTLOOK_DPA_LABEL" for="SMARTLOOK_DPA">{l s='I have read and agree with' mod='smartsupp'} <a href="https://www.smartlook.com/terms" target="_blank">{l s='Terms' mod='smartlook'}</a> {l s=' ' mod='smartlook'}</span>
					</div>                                        
					<br/>
                                </p>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"></div>
                </div>                        
                <div class="row text-center">
                        <div class="row">
                                <div class="center-block">
                                        <button id="create_account_do" class="btn btn-primary btn-lg">{l s='Create new account' mod='smartlook'}</button>
                                </div>
                        </div>
                </div>
        </div>
        <br/>
        <br/>
        <br/>
        <div class="row text-center">
                <p>
                        <strong class="heading">{l s='170000+ happy customers, including:' mod='smartlook'}</strong>
                </p>
                <div class="customers">
                        <a>
                                <img alt="Hyundai" src="{$module_dir|escape:'html':'UTF-8'}views/img/hyundai.png">
                        </a>
                        <a>
                                <img alt="Kiwi.com" src="{$module_dir|escape:'html':'UTF-8'}views/img/kiwi.png">
                        </a>
                        <a>
                                <img alt="O2" src="{$module_dir|escape:'html':'UTF-8'}views/img/o2.png">
                        </a>
                        <a>
                                <img alt="Conrad" src="{$module_dir|escape:'html':'UTF-8'}views/img/conrad.png">
                        </a>
                        <a>
                                <img alt="Miele" src="{$module_dir|escape:'html':'UTF-8'}views/img/miele.png">
                        </a>
                </div>
        </div>                                                                        
</div>
