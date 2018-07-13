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

<div id="smartlook_configuration" class="panel">
	<div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <p class="email none">{$smartlook_email|escape:'htmlall':'UTF-8'}</p>
                </div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-center">
			<img src="{$module_dir|escape:'html':'UTF-8'}views/img/smartlook_logo.png" alt="Smartlook" />
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <button id="deactivate_chat_do" class="btn btn-default pull-right">{l s='Disconnect account' mod='smartlook'}</button>
		</div>
	</div>
        <div class="row">
                <div class="col-lg-4"></div>
                <div class="col-lg-4 text-center">
                    <p class="status-information">
                            {l s='Have you got your popcorn ready?' mod='smartlook'}
                            <br/>
                            {l s='Go to Smartlook to see and filter visitor recordings.' mod='smartlook'}
                    </p>
                    <div class="center-block">
                            <form action="https://www.smartlook.com/app/dashboard" target="_blank">
                                    <input type="hidden" name="utm_source" value="Prestashop">
                                    <input type="hidden" name="utm_medium" value="integration">
                                    <input type="hidden" name="utm_campaign" value="link">
                                    <input type="submit" class="btn btn-primary btn-lg" value="{l s='Go to Smartlook' mod='smartlook'}">
                            </form>                        
                    </div>
                    <p style="padding-top: 5px;">
                            ({l s='This will open a new browser tab.' mod='smartlook'})
                    </p>
                </div>
                <div class="col-lg-4"></div>
        </div>
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