<?php
/*
* ___COPY__RIGHT___
*/

class AttachmentControllerCore extends FrontController
{
	public function postProcess()
	{
		$a = new Attachment(Tools::getValue('id_attachment'), $this->context->language->id);
		if (!$a->id)
			Tools::redirect('index.php');

		header('Content-Transfer-Encoding: binary');
		header('Content-Type: '.$a->mime);
		header('Content-Length: '.filesize(_PS_DOWNLOAD_DIR_.$a->file));
		header('Content-Disposition: attachment; filename="'.utf8_decode($a->file_name).'"');
		readfile(_PS_DOWNLOAD_DIR_.$a->file);
		exit;
	}
}