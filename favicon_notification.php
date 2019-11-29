<?php
/**
* 2007-2019 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2019 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

if (!defined('_PS_VERSION_')) {
    exit;
}

class Favicon_notification extends Module
{
    protected $config_form = false;

    public function __construct()
    {
        $this->name = 'favicon_notification';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'PANCLab';
        $this->need_instance = 0;

        /* Set $this->bootstrap to true if your module is compliant with bootstrap (PrestaShop 1.6) */
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Favicon Notification');
        $this->description = $this->l('Displays a notification in the browser tab reminding the customer he has products in cart');

        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
    }

    public function install()
    {
        Configuration::updateValue('FAVICON_NOTIFICATION_POSITION', "down");

        return parent::install() &&
            $this->registerHook('header') &&
            $this->registerHook('displayFooter');
    }

    public function uninstall()
    {
        Configuration::deleteByName('FAVICON_NOTIFICATION_POSITION');

        return parent::uninstall();
    }

    /* Load the configuration form */
    public function getContent()
    {
        /* If values have been submitted in the form, process. */
        if (((bool)Tools::isSubmit('submitFavicon_notificationModule')) == true) {
            $this->postProcess();
        }

        $this->context->smarty->assign('module_dir', $this->_path);

        $output = $this->context->smarty->fetch($this->local_path.'views/templates/admin/preview.tpl');

        return $output.$this->renderForm();
    }

    /* Create the form that will be displayed in the configuration of your module. */
    protected function renderForm()
    {
        $helper = new HelperForm();

        $helper->show_toolbar = false;
        $helper->table = $this->table;
        $helper->module = $this;
        $helper->default_form_language = $this->context->language->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG', 0);

        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submitFavicon_notificationModule';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false)
            .'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');

        $helper->tpl_vars = array(
            'fields_value' => $this->getConfigFormValues(), /* Add values for your inputs */
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id,
        );

        return $helper->generateForm(array($this->getConfigForm()));
    }

    /* Create the structure of your form. */
    protected function getConfigForm()
    {
        return array(
            'form' => array(
                'legend' => array(
                'title' => $this->l('Settings'),
                'icon' => 'icon-cogs',
                ),
                'input' => array(
                    array(
                        'type' => 'select',                              
                        'label' => $this->l('Position:'),
                        'name' => 'FAVICON_NOTIFICATION_POSITION',                    
                        'required' => true,                             
                        'options' => array(
                        'query' => $options = array(
                            array(
                                'id_option' => "down",
                                'name' => 'Bottom Right'
                            ),
                            array(
                                'id_option' => "up",
                                'name' => 'Top Right'
                            ),
                            array(
                                'id_option' => "left",
                                'name' => 'Bottom Left'
                            ),
                            array(
                                'id_option' => "upleft",
                                'name' => 'Top Left'
                            ),
                        ),
                            'id' => 'id_option',
                            'name' => 'name' 
                        )
                    ),
                    array(
                        'type' => 'select',                              
                        'label' => $this->l('Shape:'),
                        'name' => 'FAVICON_NOTIFICATION_SHAPE',                    
                        'required' => true,                             
                        'options' => array(
                        'query' => $options = array(
                            array(
                                'id_option' => "circle",
                                'name' => 'Circle'
                            ),
                            array(
                                'id_option' => "rectangle",
                                'name' => 'Rectangle'
                            ),
                        ),
                            'id' => 'id_option',
                            'name' => 'name' 
                        )
                    ),
                    array(
                        'type' => 'select',                              
                        'label' => $this->l('Animation:'),
                        'name' => 'FAVICON_NOTIFICATION_ANIMATION',                    
                        'required' => true,                             
                        'options' => array(
                        'query' => $options = array(
                            array(
                                'id_option' => "slide",
                                'name' => 'Slide'
                            ),
                            array(
                                'id_option' => "fade",
                                'name' => 'Fade'
                            ),
                            array(
                                'id_option' => "pop",
                                'name' => 'Pop'
                            ),
                            array(
                                'id_option' => "popFade",
                                'name' => 'Pop Fade'
                            ),
                            array(
                                'id_option' => "none",
                                'name' => 'None'
                            ),
                        ),
                            'id' => 'id_option',
                            'name' => 'name' 
                        )
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Background Color'),
                        'name' => 'FAVICON_NOTIFICATION_BACKGROUND_COLOR'						
                    ),
                    array(
                        'type' => 'color',
                        'label' => $this->l('Text Color'),
                        'name' => 'FAVICON_NOTIFICATION_TEXT_COLOR'						
                    ),
                ),
                'submit' => array(
                    'title' => $this->l('Save'),
                ),
            ),
        );
    }

    /* Set values for the inputs. */
    protected function getConfigFormValues()
    {
        return array(
            'FAVICON_NOTIFICATION_POSITION' => Configuration::get('FAVICON_NOTIFICATION_POSITION', "down"),
            'FAVICON_NOTIFICATION_SHAPE' => Configuration::get('FAVICON_NOTIFICATION_SHAPE', "circle"),
            'FAVICON_NOTIFICATION_ANIMATION' => Configuration::get('FAVICON_NOTIFICATION_ANIMATION', "slide"),
            'FAVICON_NOTIFICATION_BACKGROUND_COLOR' => Configuration::get('FAVICON_NOTIFICATION_BACKGROUND_COLOR', '#FFFFFF'),
            'FAVICON_NOTIFICATION_TEXT_COLOR' => Configuration::get('FAVICON_NOTIFICATION_TEXT_COLOR', '#FFFFFF'),
        );
    }

    /* Save form data. */
    protected function postProcess()
    {
        $form_values = $this->getConfigFormValues();

        foreach (array_keys($form_values) as $key) {
            Configuration::updateValue($key, Tools::getValue($key));
        }
    }

    /* Add the CSS & JavaScript files you want to be added on the FO. */
    public function hookHeader()
    {
        $this->context->controller->addJS($this->_path.'/views/libs/favico.js');
    }

    public function hookDisplayFooter($params)
    {
        $this->context->smarty->assign([
            'favicon_position' => Configuration::get('FAVICON_NOTIFICATION_POSITION'),
            'favicon_shape' => Configuration::get('FAVICON_NOTIFICATION_SHAPE'),
            'favicon_animation' => Configuration::get('FAVICON_NOTIFICATION_ANIMATION'),
            'favicon_bgcolor' => Configuration::get('FAVICON_NOTIFICATION_BACKGROUND_COLOR'),
            'favicon_txtcolor' => Configuration::get('FAVICON_NOTIFICATION_TEXT_COLOR')
        ]);
        return $this->fetch('module:favicon_notification/views/templates/front/footer.tpl');
    }
}
