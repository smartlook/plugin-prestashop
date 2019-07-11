<?php
/**
 * Smartlook integration module.
 *
 * @author    Smartlook <vladimir@smartsupp.com>
 * @copyright 2015 Smartsupp.com
 * @license   GPL-2.0+
 * @package   Smartlook
 * @link      http://www.smartsupp.com
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

if (!defined('_PS_VERSION_')) {
    exit;
}

class Smartlook extends Module
{
    public function __construct()
    {
        $this->name = 'smartlook';
        $this->tab = 'advertising_marketing';
        $this->version = '2.0.1';
        $this->author = 'Smartsupp';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
        $this->bootstrap = true;
        $this->module_key = '';

        parent::__construct();

        $this->displayName = $this->l('Smartlook');
        $this->description = $this->l('Look at your website through your customer\'s eyes! We will record everything visitors do on your site.');
        $this->confirmUninstall = $this->l('Are you sure you want to uninstall Smartlook? You will lose all the data related to this module.');

        if (version_compare(_PS_VERSION_, '1.5', '<')) {
            require(_PS_MODULE_DIR_ . $this->name . '/backward_compatibility/backward.php');
        }

        if (!Configuration::get('SMARTLOOK_PROJECT_KEY')) {
            $this->warning = $this->l('No Smartlook key provided.');
        }
    }

    public function install()
    {
        if (version_compare(_PS_VERSION_, '1.6', '>=') && Shop::isFeatureActive()) {
            Shop::setContext(Shop::CONTEXT_ALL);
        }

        $tab = new Tab();
        $tab->active = 1;
        $tab->class_name = 'AdminSmartlookAjax';
        $tab->name = array();
        foreach (Language::getLanguages(true) as $lang) {
            $tab->name[$lang['id_lang']] = 'Smartlook';
        }
        $tab->id_parent = -1;
        $tab->module = $this->name;

        if (!$tab->add() ||
                !parent::install() ||
                !$this->registerHook('footer') ||
                !$this->registerHook('backOfficeHeader') ||
                !Configuration::updateValue('SMARTLOOK_KEY', '') ||
                !Configuration::updateValue('SMARTLOOK_EMAIL', '') ||
                !Configuration::updateValue('SMARTLOOK_PROJECT_ID', '') ||
                !Configuration::updateValue('SMARTLOOK_PROJECT_KEY', '') ||
                !Configuration::updateValue('SMARTLOOK_VARIABLES_ENABLED', '') ||
                !Configuration::updateValue('SMARTLOOK_CUSTOMER_NAME', '') ||
                !Configuration::updateValue('SMARTLOOK_CUSTOMER_EMAIL', '')
        ) {
            return false;
        }

        return true;
    }

    public function uninstall()
    {
        $id_tab = (int) Tab::getIdFromClassName('AdminSmartlookAjax');

        if ($id_tab) {
            $tab = new Tab($id_tab);
            $tab->delete();
        }

        if (!parent::uninstall() ||
                !$this->unregisterHook('footer') ||
                !$this->unregisterHook('backOfficeHeader') ||
                !Configuration::deleteByName('SMARTLOOK_KEY') ||
                !Configuration::deleteByName('SMARTLOOK_EMAIL') ||
                !Configuration::deleteByName('SMARTLOOK_PROJECT_ID') ||
                !Configuration::deleteByName('SMARTLOOK_PROJECT_KEY') ||
                !Configuration::deleteByName('SMARTLOOK_VARIABLES_ENABLED') ||
                !Configuration::deleteByName('SMARTLOOK_CUSTOMER_NAME') ||
                !Configuration::deleteByName('SMARTLOOK_CUSTOMER_EMAIL')
        ) {
            return false;
        }

        return true;
    }

    public function displayForm()
    {
        $default_lang = (int) Configuration::get('PS_LANG_DEFAULT');

        $helper = new HelperForm();

        // Module, token and currentIndex
        $helper->module = $this;
        $helper->name_controller = $this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->currentIndex = AdminController::$currentIndex . '&configure=' . $this->name;

        // Language
        $helper->default_form_language = $default_lang;
        $helper->allow_employee_form_lang = $default_lang;

        // Title and toolbar
        $helper->title = $this->displayName;
        $helper->show_toolbar = true;
        $helper->toolbar_scroll = true;
        $helper->submit_action = 'submit' . $this->name;
        $helper->toolbar_btn = array(
            'save' =>
            array(
                'desc' => $this->l('Save'),
                'href' => AdminController::$currentIndex . '&configure=' . $this->name . '&save' . $this->name .
                '&token=' . Tools::getAdminTokenLite('AdminModules'),
            ),
            'back' => array(
                'href' => AdminController::$currentIndex . '&token=' . Tools::getAdminTokenLite('AdminModules'),
                'desc' => $this->l('Back to list')
            )
        );

        $fields_form = array();
        $fields_form[0]['form'] = array(
            'legend' => array(
                'title' => $this->l('Settings'),
            ),
            'input' => array(
                array(
                    'type' => 'checkbox',
                    'label' => $this->l('Record visitors'),
                    'name' => 'SMARTLOOK_VARIABLES',
                    'desc' => $this->l('By enabling this option you will be able to see selected variables in your Smartlook dashboard.'),
                    'required' => false,
                    'values' => array(
                        'query' => array(
                            array('id' => 'ENABLED', 'name' => '', 'val' => '1'),
                        ),
                        'id' => 'id',
                        'name' => 'name'
                    )
                ),
            ),
            'submit' => array(
                'title' => $this->l('Save'),
            )
        );
        $fields_form[1]['form'] = array(
            'legend' => array(
                'title' => $this->l('Visitor info'),
            ),
            'input' => array(
                array(
                    'type' => 'checkbox',
                    'label' => $this->l('Name'),
                    'name' => 'SMARTLOOK_CUSTOMER',
                    'desc' => $this->l('Shows customer\'s display name.'),
                    'required' => false,
                    'values' => array(
                        'query' => array(
                            array('id' => 'NAME', 'name' => '', 'val' => '1'),
                        ),
                        'id' => 'id',
                        'name' => 'name'
                    )
                ),
                array(
                    'type' => 'checkbox',
                    'label' => $this->l('Email'),
                    'name' => 'SMARTLOOK_CUSTOMER',
                    'desc' => $this->l('Shows customer\'s email.'),
                    'required' => false,
                    'values' => array(
                        'query' => array(
                            array('id' => 'EMAIL', 'name' => '', 'val' => '1'),
                        ),
                        'id' => 'id',
                        'name' => 'name'
                    )
                ),
            ),
            'submit' => array(
                'title' => $this->l('Save'),
            )
        );

        $helper->fields_value['SMARTLOOK_VARIABLES_ENABLED'] = Configuration::get('SMARTLOOK_VARIABLES_ENABLED');
        $helper->fields_value['SMARTLOOK_CUSTOMER_NAME'] = Configuration::get('SMARTLOOK_CUSTOMER_NAME');
        $helper->fields_value['SMARTLOOK_CUSTOMER_EMAIL'] = Configuration::get('SMARTLOOK_CUSTOMER_EMAIL');

        return $helper->generateForm($fields_form);
    }

    public function getContent()
    {
        $output = '';
        if (Tools::isSubmit('submit' . $this->name)) {
            $smartlook_key = Configuration::get('SMARTLOOK_PROJECT_KEY');
            if ($smartlook_key) {
                $output .= $this->displayConfirmation($this->l('Settings updated successfully'));
            }
            Configuration::updateValue('SMARTLOOK_VARIABLES_ENABLED', Tools::getValue('SMARTLOOK_VARIABLES_ENABLED'));
            Configuration::updateValue('SMARTLOOK_CUSTOMER_NAME', Tools::getValue('SMARTLOOK_CUSTOMER_NAME'));
            Configuration::updateValue('SMARTLOOK_CUSTOMER_EMAIL', Tools::getValue('SMARTLOOK_CUSTOMER_EMAIL'));
        }

        if (version_compare(_PS_VERSION_, '1.6', '>=')) {
            $output .= $this->displayForm();
        }

        $ajax_controller_url = $this->context->link->getAdminLink('AdminSmartlookAjax');
        $this->context->smarty->assign(array(
            'ajax_controller_url' => $ajax_controller_url,
            'smartlook_key' => Configuration::get('SMARTLOOK_KEY'),
            'smartlook_email' => Configuration::get('SMARTLOOK_EMAIL'),
            'smartlook_project_id' => Configuration::get('SMARTLOOK_PROJECT_ID'),
            'smartlook_project_key' => Configuration::get('SMARTLOOK_PROJECT_KEY'),
        ));

        return $this->display(__FILE__, 'views/templates/admin/landing_page.tpl') .
                $this->display(__FILE__, 'views/templates/admin/connect_account.tpl') .
                $this->display(__FILE__, 'views/templates/admin/choose_configuration.tpl') .
                $this->display(__FILE__, 'views/templates/admin/configuration.tpl') .
                $output;
    }

    public function hookFooter()
    {
        $smartlook_key = Configuration::get('SMARTLOOK_PROJECT_KEY');

        if ($smartlook_key) {
            $this->context->smarty->assign('smartlook_key', $smartlook_key);
            $this->context->smarty->assign('smartlook_cookie_domain', Tools::getHttpHost(true) . __PS_BASE_URI__);

            $customer = $this->context->customer;
            if ($customer->id) {
                $this->context->smarty->assign('smartlook_dashboard_name', sprintf('"%s %s"', $customer->firstname, $customer->lastname));

                $variables_enabled = Configuration::get('SMARTLOOK_VARIABLES_ENABLED');
                $this->context->smarty->assign('smartlook_variables_enabled', $variables_enabled);

                if ($variables_enabled) {
                    $smartlook_variables_js = '';
                    if (Configuration::get('SMARTLOOK_CUSTOMER_NAME')) {
                        $smartlook_variables_js .= 'smartlook ("tag", "name", "' . $customer->firstname . ' ' . $customer->lastname . '");';
                    }
                    if (Configuration::get('SMARTLOOK_CUSTOMER_EMAIL')) {
                        $smartlook_variables_js .= 'smartlook ("tag", "email", "' . $customer->email . '");';
                    }
                    $this->context->smarty->assign('smartlook_variables_js', trim($smartlook_variables_js, ', '));
                }
            } else {
                $this->context->smarty->assign('smartlook_dashboard_name', '""');
                $this->context->smarty->assign('smartlook_variables_enabled', 0);
                $this->context->smarty->assign('smartlook_variables_js', '');
            }

            if (version_compare(_PS_VERSION_, '1.7', '>=')) {
                return $this->display(__FILE__, 'views/templates/hook/footer17.tpl');
            } else {
                return $this->display(__FILE__, 'views/templates/hook/footer.tpl');
            }
        }
    }

    public function hookBackOfficeHeader()
    {
        $js = '';
        if (strcmp(Tools::getValue('configure'), $this->name) === 0) {
            if (version_compare(_PS_VERSION_, '1.6', '>=') == true) {
                $this->context->controller->addJquery();
                $this->context->controller->addJs($this->_path . 'views/js/smartlook.js');
                $this->context->controller->addCSS($this->_path . 'views/css/smartlook.css');
                if (version_compare(_PS_VERSION_, '1.6', '<') == true) {
                    $this->context->controller->addCSS($this->_path . 'views/css/smartlook-nobootstrap.css');
                }
            } else {
                $js .= '<script type="text/javascript" src="' . $this->_path . 'views/js/smartlook.js"></script>';
                $js .= '<link rel="stylesheet" href="' . $this->_path . 'views/css/smartlook.css" type="text/css" />' .
                        '<link rel="stylesheet" href="' . $this->_path . 'views/css/smartlook-nobootstrap.css" type="text/css" />';
            }
        }


        return $js;
    }

    protected function getAdminDir()
    {
        return basename(_PS_ADMIN_DIR_);
    }
}
