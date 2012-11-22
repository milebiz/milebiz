<?php
/*
* ___COPY__RIGHT___
*/

class AdminPreferencesControllerCore extends AdminController
{

	public function __construct()
	{
		$this->context = Context::getContext();
		$this->className = 'Configuration';
		$this->table = 'configuration';

		// Prevent classes which extend AdminPreferences to load useless data
		if (get_class($this) == 'AdminPreferencesController')
		{
			$round_mode = array(
				array(
					'value' => PS_ROUND_UP,
					'name' => $this->l('superior')
				),
				array(
					'value' => PS_ROUND_DOWN,
					'name' => $this->l('inferior')
				),
				array(
					'value' => PS_ROUND_HALF,
					'name' => $this->l('classical')
				)
			);

			$fields = array(
				'PS_SSL_ENABLED' => array(
					'title' => $this->l('Enable SSL'),
					'desc' => $this->l('If your hosting provider allows SSL, you can activate SSL encryption (https://) for customer account identification and order processing'),
					'validation' => 'isBool',
					'cast' => 'intval',
					'type' => 'bool',
					'default' => '0'
				),
				'PS_TOKEN_ENABLE' => array(
					'title' => $this->l('Increase Front Office security'),
					'desc' => $this->l('Enable or disable token on the Front Office in order to improve MileBiz security'),
					'validation' => 'isBool',
					'cast' => 'intval',
					'type' => 'bool',
					'default' => '0',
					'visibility' => Shop::CONTEXT_ALL
				),
				'PS_PRICE_ROUND_MODE' => array(
					'title' => $this->l('Round mode'),
					'desc' => $this->l('You can choose how to round prices: always round superior; always round inferior, or classic rounding'),
					'validation' => 'isInt',
					'cast' => 'intval',
					'type' => 'select',
					'list' => $round_mode,
					'identifier' => 'value'
				),
				'PS_DISPLAY_SUPPLIERS' => array(
					'title' => $this->l('Display suppliers and manufacturers'),
					'desc' => $this->l('Display suppliers and manufacturers lists even if corresponding blocks are disabled'),
					'validation' => 'isBool',
					'cast' => 'intval',
					'type' => 'bool'
				),
				'PS_MULTISHOP_FEATURE_ACTIVE' => array(
					'title' => $this->l('Enable Multistore'),
					'desc' => $this->l('Multistore feature allows you to manage several shops with one back-office. If this feature is enabled, a "Multistore" page will be available in the "Advanced Parameters" menu.'),
					'validation' => 'isBool',
					'cast' => 'intval',
					'type' => 'bool',
					'visibility' => Shop::CONTEXT_ALL
				),
			);

			// No HTTPS activation if you haven't already.
			if (!Tools::usingSecureMode() && !Configuration::get('PS_SSL_ENABLED'))
			{
				$fields['PS_SSL_ENABLED']['type'] = 'disabled';
				$fields['PS_SSL_ENABLED']['disabled'] = '<a href="https://'.Tools::getShopDomainSsl().Tools::safeOutput($_SERVER['REQUEST_URI']).'">'.
					$this->l('Please click here to use HTTPS protocol before enabling SSL.').'</a>';
			}

			$this->fields_options = array(
				'general' => array(
					'title' =>	$this->l('General'),
					'icon' =>	'tab-preferences',
					'fields' =>	$fields,
					'submit' => array('title' => $this->l('   Save   '), 'class' => 'button'),
				),
			);
		}

		parent::__construct();
	}

	/**
	 * Enable / disable multishop menu if multishop feature is activated
	 *
	 * @param string $value
	 */
	public function updateOptionPsMultishopFeatureActive($value)
	{
		Configuration::updateValue('PS_MULTISHOP_FEATURE_ACTIVE', $value);

		$tab = Tab::getInstanceFromClassName('AdminShopGroup');
		$tab->active = (bool)Configuration::get('PS_MULTISHOP_FEATURE_ACTIVE');
		$tab->update();
	}
}
