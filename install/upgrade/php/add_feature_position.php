<?php
/*
* ___COPY__RIGHT___
*/

function add_feature_position()
{
	$features = Db::getInstance()->executeS('
	SELECT `id_feature`
	FROM `'._DB_PREFIX_.'feature`');
	$i = 0;
	if (sizeof($features) && is_array($features))
		foreach ($features as $feature)
		{
			Db::getInstance()->execute('
			UPDATE `'._DB_PREFIX_.'feature` 
			SET `position` = '.$i++.'
			WHERE `id_feature` = '.(int)$feature['id_feature']);
		}
}