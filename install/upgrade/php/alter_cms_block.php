<?php
/*
* ___COPY__RIGHT___
*/

function alter_cms_block()
{
	// No one will know if the table does not exist :] Thanks Damien for your solution ;)
	DB::getInstance()->execute('ALTER TABLE  `'._DB_PREFIX_.'cms_block_lang` CHANGE  `id_block_cms`  `id_cms_block` INT( 10 ) UNSIGNED NOT NULL');
	
	DB::getInstance()->execute('ALTER TABLE  `'._DB_PREFIX_.'cms_block` CHANGE  `id_block_cms`  `id_cms_block` INT( 10 ) UNSIGNED NOT NULL');
	
	DB::getInstance()->execute('ALTER TABLE  `'._DB_PREFIX_.'cms_block_page` CHANGE  `id_block_cms`  `id_cms_block` INT( 10 ) UNSIGNED NOT NULL');
	
	DB::getInstance()->execute('ALTER TABLE  `'._DB_PREFIX_.'cms_block_page` CHANGE  `id_block_cms_page`  `id_cms_block_page` INT( 10 ) UNSIGNED NOT NULL AUTO_INCREMENT');
		
}

