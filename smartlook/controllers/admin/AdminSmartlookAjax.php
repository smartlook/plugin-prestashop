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
 * Version:           1.0.0
 * Author:            Smartsupp
 * Author URI:        http://www.smartsupp.com
 * Text Domain:       smartlook
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

class AdminSmartlookAjaxController extends ModuleAdminController
{
    private $authKey = '47a2435f1f3673ffce7385bc57bbe3e7353ab02e';
    private $languageMap = array(
        'ag' => 'es',
        'mx' => 'es',
        'qc' => 'fr',
        'dh' => 'de',
        'gb' => 'en',
    );

    public function init()
    {
        require_once _PS_MODULE_DIR_ . 'smartlook/classes/Web/Api.php';
                        
        $projects = array();
        $api = new SmartlookWebApi();

        switch (Tools::getValue('action')) {
            case 'create':
                $language = Tools::strtolower($this->context->language->iso_code);
                if (array_key_exists($language, $this->languageMap)) {
                    $language = $this->languageMap[$language];
                }
                $result = $api->signUp(array('authKey' => $this->authKey, 'email' => Tools::getValue('email'), 'password' => Tools::getValue('password'), 'lang' => $language, 'consentTerms' => 1));
                if ($result['ok']) {
                    $api->authenticate($result['account']['apiKey']);
                    $project = $api->projectsCreate(array('name' => Configuration::get('PS_SHOP_NAME')));
                    $projectId = $project['project']['id'];
                    $projectKey = $project['project']['key'];
                    $projects[] = $project;
                    Configuration::updateValue('SMARTLOOK_KEY', $result['account']['apiKey']);
                    Configuration::updateValue('SMARTLOOK_EMAIL', Tools::getValue('email'));
                    Configuration::updateValue('SMARTLOOK_PROJECT_ID', $projectId);
                    Configuration::updateValue('SMARTLOOK_PROJECT_KEY', $projectKey);
                }
                break;
            case 'login':
                $result = $api->signIn(array('authKey' => $this->authKey, 'email' => Tools::getValue('email'), 'password' => Tools::getValue('password')));
                if ($result['ok']) {
                    $api->authenticate($result['account']['apiKey']);
                    Configuration::updateValue('SMARTLOOK_KEY', $result['account']['apiKey']);
                    Configuration::updateValue('SMARTLOOK_EMAIL', Tools::getValue('email'));
                    $projects = $api->projectsList();
                    $projects = $projects['projects'];
                    if (count($projects) === 1) {
                        Configuration::updateValue('SMARTLOOK_PROJECT_ID', $projects[0]['id']);
                        Configuration::updateValue('SMARTLOOK_PROJECT_KEY', $projects[0]['key']);
                    } else {
                        Configuration::updateValue('SMARTLOOK_PROJECT_ID', '');
                        Configuration::updateValue('SMARTLOOK_PROJECT_KEY', '');
                    }
                }
                break;
            case 'projects':
                $api->authenticate(Configuration::get('SMARTLOOK_KEY'));
                $projects = $api->projectsList();
                $projects = $projects['projects'];
                break;
            case 'assign':
                $api->authenticate(Configuration::get('SMARTLOOK_KEY'));
                $projects = $api->projectsList();
                $projects = $projects['projects'];
                if (Tools::getValue('project_key')) {
                    foreach ($projects as $project) {
                        if (Tools::getValue('project_key') === $project['key']) {
                            Configuration::updateValue('SMARTLOOK_PROJECT_ID', $project['id']);
                            Configuration::updateValue('SMARTLOOK_PROJECT_KEY', $project['key']);
                            break;
                        }
                    }
                } else {
                    $project = $api->projectsCreate(array('name' => Tools::getValue('project_name')));
                    Configuration::updateValue('SMARTLOOK_PROJECT_ID', $project['project']['id']);
                    Configuration::updateValue('SMARTLOOK_PROJECT_KEY', $project['project']['key']);
                }
                break;
            case 'deactivate':
                Configuration::updateValue('SMARTLOOK_KEY', '');
                Configuration::updateValue('SMARTLOOK_EMAIL', '');
                Configuration::updateValue('SMARTLOOK_PROJECT_ID', '');
                Configuration::updateValue('SMARTLOOK_PROJECT_KEY', '');
                break;
        }
                
        if ((isset($result) && isset($result['error'])) || (isset($project) && isset($project['error']))) {
            Configuration::updateValue('SMARTLOOK_KEY', '');
            Configuration::updateValue('SMARTLOOK_EMAIL', '');
            Configuration::updateValue('SMARTLOOK_PROJECT_ID', '');
            Configuration::updateValue('SMARTLOOK_PROJECT_KEY', '');
        }
        
        $options = array();
        foreach ($projects as $project) {
            $options[] = sprintf('<option value="%s">%s</option>', $project['key'], $project['name']);
        }

        die(Tools::jsonEncode(array(
                    'key' => Configuration::get('SMARTLOOK_KEY'),
                    'email' => Configuration::get('SMARTLOOK_EMAIL'),
                    'projects' => implode('', $options),
                    'projectId' => Configuration::get('SMARTLOOK_PROJECT_ID'),
                    'projectKey' => Configuration::get('SMARTLOOK_PROJECT_KEY'),
                    'error' => $result['error'],
                    'message' => $result['message'],
                    'hint' => $result['hint']
                )));
    }
}
