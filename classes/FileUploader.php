<?php
/*
* ___COPY__RIGHT___
*/

class FileUploaderCore
{
	protected $allowedExtensions = array();
	protected $file;
	protected $sizeLimit;

	public function __construct(array $allowedExtensions = array(), $sizeLimit = 10485760)
	{
		$allowedExtensions = array_map('strtolower', $allowedExtensions);

		$this->allowedExtensions = $allowedExtensions;
		$this->sizeLimit = $sizeLimit;

        if (isset($_GET['qqfile']))
            $this->file = new QqUploadedFileXhr();
        elseif (isset($_FILES['qqfile']))
            $this->file = new QqUploadedFileForm();
        else
            $this->file = false;
	}

	protected function toBytes($str)
	{
		$val = trim($str);
		$last = strtolower($str[strlen($str) - 1]);
		switch ($last)
		{
			case 'g': $val *= 1024;
			case 'm': $val *= 1024;
			case 'k': $val *= 1024;
		}
		return $val;
	}

	/**
	 * Returns array('success'=>true) or array('error'=>'error message')
	 */
	public function handleUpload()
	{
		if (!$this->file)
			return array('error' => Tools::displayError('No files were uploaded.'));

		$size = $this->file->getSize();

		if ($size == 0)
			return array('error' => Tools::displayError('File is empty'));
		if ($size > $this->sizeLimit)
			return array('error' => Tools::displayError('File is too large'));

		$pathinfo = pathinfo($this->file->getName());
		$these = implode(', ', $this->allowedExtensions);
		if (!isset($pathinfo['extension']))
			return array('error' => Tools::displayError('File has an invalid extension, it should be one of').$these.'.');
		$ext = $pathinfo['extension'];
		if ($this->allowedExtensions && !in_array(strtolower($ext), $this->allowedExtensions))
			return array('error' => Tools::displayError('File has an invalid extension, it should be one of').$these.'.');

		return $this->file->save();

	}
}

class QqUploadedFileForm
{
    /**
     * Save the file to the specified path
     * @return boolean TRUE on success
     */
	public function save()
	{
		$product = new Product($_GET['id_product']);
		if (!Validate::isLoadedObject($product))
			return array('error' => Tools::displayError('Cannot add image because product creation failed.'));
		else
		{
			$image = new Image();
			$image->id_product = (int)$product->id;
			$image->position = Image::getHighestPosition($product->id) + 1;
			if (!Image::getCover($image->id_product))
				$image->cover = 1;
			else
				$image->cover = 0;
			if (!$image->add())
				return array('error' => Tools::displayError('Error while creating additional image'));
			else
				return $this->copyImage($product->id, $image->id);
		}
	}

	public function copyImage($id_product, $id_image, $method = 'auto')
	{
		$image = new Image($id_image);
		if (!$new_path = $image->getPathForCreation())
			return array('error' => Tools::displayError('An error occurred during new folder creation'));
		if (!($tmpName = tempnam(_PS_TMP_IMG_DIR_, 'PS')) || !move_uploaded_file($_FILES['qqfile']['tmp_name'], $tmpName))
			return array('error' => Tools::displayError('An error occurred during the image upload'));
		elseif (!ImageManager::resize($tmpName, $new_path.'.'.$image->image_format))
			return array('error' => Tools::displayError('An error occurred while copying image.'));
		elseif ($method == 'auto')
		{
			$imagesTypes = ImageType::getImagesTypes('products');
			foreach ($imagesTypes as $imageType)
			{
				if (!ImageManager::resize($tmpName, $new_path.'-'.stripslashes($imageType['name']).'.'.$image->image_format, $imageType['width'], $imageType['height'], $image->image_format))
					return array('error' => Tools::displayError('An error occurred while copying image:').' '.stripslashes($imageType['name']));
			}
		}
		unlink($tmpName);
		Hook::exec('actionWatermark', array('id_image' => $id_image, 'id_product' => $id_product));

		if (!$image->update())
			return array('error' => Tools::displayError('Error while updating status'));
		$img = array('id_image' => $image->id, 'position' => $image->position, 'cover' => $image->cover, 'name' => $this->getName());
		return array('success' => $img);
	}

    public function getName()
    {
        return $_FILES['qqfile']['name'];
    }

    public function getSize()
    {
        return $_FILES['qqfile']['size'];
    }
}
/**
 * Handle file uploads via XMLHttpRequest
 */
class QqUploadedFileXhr
{
	/**
	 * Save the file to the specified path
	 * @return boolean TRUE on success
	 */
	public function upload($path)
	{
		$input = fopen('php://input', 'r');
		$temp = tmpfile();
		$realSize = stream_copy_to_stream($input, $temp);
		fclose($input);
		if ($realSize != $this->getSize())
			return false;
		$target = fopen($path, 'w');
		fseek($temp, 0, SEEK_SET);
		stream_copy_to_stream($temp, $target);
		fclose($target);

		return true;
	}

	public function save()
	{
		$product = new Product($_GET['id_product']);
		if (!Validate::isLoadedObject($product))
			return array('error' => Tools::displayError('Cannot add image because product creation failed.'));
		else
		{
			$image = new Image();
			$image->id_product = (int)($product->id);
			$image->position = Image::getHighestPosition($product->id) + 1;
			if (!Image::getCover($image->id_product))
				$image->cover = 1;
			else
				$image->cover = 0;
			if (!$image->add())
				return array('error' => Tools::displayError('Error while creating additional image'));
			else
				return $this->copyImage($product->id, $image->id);
		}
	}

	public function copyImage($id_product, $id_image, $method = 'auto')
	{
		$image = new Image($id_image);
		if (!$new_path = $image->getPathForCreation())
			return array('error' => Tools::displayError('An error occurred during new folder creation'));
		if (!($tmpName = tempnam(_PS_TMP_IMG_DIR_, 'PS')) || !$this->upload($tmpName))
			return array('error' => Tools::displayError('An error occurred during the image upload'));
		elseif (!ImageManager::resize($tmpName, $new_path.'.'.$image->image_format))
			return array('error' => Tools::displayError('An error occurred while copying image.'));
		elseif ($method == 'auto')
		{
			$imagesTypes = ImageType::getImagesTypes('products');
			foreach ($imagesTypes as $imageType)
			{
				/*
					$theme = (Shop::isFeatureActive() ? '-'.$imageType['id_theme'] : '');
					if (!ImageManager::resize($tmpName, $new_path.'-'.stripslashes($imageType['name']).$theme.'.'.$image->image_format, $imageType['width'], $imageType['height'], $image->image_format))
						return array('error' => Tools::displayError('An error occurred while copying image:').' '.stripslashes($imageType['name']));
				*/
				if (!ImageManager::resize($tmpName, $new_path.'-'.stripslashes($imageType['name']).'.'.$image->image_format, $imageType['width'], $imageType['height'], $image->image_format))
					return array('error' => Tools::displayError('An error occurred while copying image:').' '.stripslashes($imageType['name']));
			}
		}
		unlink($tmpName);
		Hook::exec('actionWatermark', array('id_image' => $id_image, 'id_product' => $id_product));

		if (!$image->update())
			return array('error' => Tools::displayError('Error while updating status'));
		$img = array('id_image' => $image->id, 'position' => $image->position, 'cover' => $image->cover, 'name' => $this->getName());
		return array('success' => $img);
	}

	public function getName()
	{
		return $_GET['qqfile'];
	}

	public function getSize()
	{
		if (isset($_SERVER['CONTENT_LENGTH']))
			return (int)$_SERVER['CONTENT_LENGTH'];
		else
			throw new Exception('Getting content length is not supported.');
	}
}
