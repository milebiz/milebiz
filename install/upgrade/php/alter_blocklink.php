<?php
/**
 * MILEBIZ �����̳�
 * ============================================================================
 * ��Ȩ���� 2011-20__ ��������
 * ��վ��ַ: http://www.milebiz.com
 * ============================================================================
 * $Author: zhourh $
 */

function alter_blocklink()
{
	// No one will know if the table does not exist :] Thanks Damien for your solution ;)
	DB::getInstance()->execute('ALTER TABLE  `'._DB_PREFIX_.'blocklink_lang` CHANGE  `id_link`  `id_blocklink` INT( 10 ) UNSIGNED NOT NULL');
	
	DB::getInstance()->execute('ALTER TABLE  `'._DB_PREFIX_.'blocklink` CHANGE  `id_link`  `id_blocklink` INT( 10 ) UNSIGNED NOT NULL');
			
}

