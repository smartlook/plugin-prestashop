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

<div id="smartlook_connect_account" class="panel">
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
			<img src="{$module_dir|escape:'html':'UTF-8'}views/img/smartlook_logo.png" alt="Smartlook" />
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <button id="create_account_btn" class="btn btn-default pull-right">{l s='Create free account' mod='smartlook'}</button>
		</div>
	</div>
	<hr/>
        <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"></div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-center">
                        <p>
                                <strong class="heading">{l s='Connect existing account' mod='smartlook'}</strong>
                        </p>
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
                        </p>
                        <div class="center-block">
                                <button id="connect_existing_account_do" class="btn btn-primary btn-lg">{l s='Connect existing account' mod='smartlook'}</button>
                        </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"></div>
        </div>
        <br/>
        <br/>
        <div class="row text-center">
                <p>
                        <strong class="heading">{l s='250 000 happy customers, including:' mod='smartlook'}</strong>
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
