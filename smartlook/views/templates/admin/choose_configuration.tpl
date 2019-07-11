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

<div id="smartlook_choose_configuration" class="panel">
	<div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <p class="email">{$smartlook_email|escape:'htmlall':'UTF-8'}</p>
                </div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-center">
			<img src="{$module_dir|escape:'html':'UTF-8'}views/img/smartlook_logo.png" alt="Smartlook" />
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <button disabled class="btn btn-default pull-right">{l s='Disconnect account' mod='smartlook'}</button>
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
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="control-label text-right col-lg-5 col-md-5 col-sm-5 col-xs-5"> {l s='Choose project' mod='smartlook'} </label>
                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                        <select id="SMARTLOOK_PROJECT_KEY" name="SMARTLOOK_PROJECT_KEY" class="fixed-width-xl">
                                                <option>{l s='Create new project' mod='smartlook'}</option>
                                        </select>
                                </div>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12 project-name">
                                <label class="control-label text-right col-lg-5 col-md-5 col-sm-5 col-xs-5"> {l s='Name for new project' mod='smartlook'} </label>
                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                        <input id="SMARTLOOK_PROJECT_NAME" name="SMARTLOOK_PROJECT_NAME" type="text" class="fixed-width-xl">
                                </div>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
                        <button id="assign_project_do" class="btn btn-primary btn-lg">{l s='Assign project to this web' mod='smartlook'}</button>
                </div>
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