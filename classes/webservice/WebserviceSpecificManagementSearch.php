<?php
/**
 * MILEBIZ �����̳�
 * ============================================================================
 * ��Ȩ���� 2011-20__ ��������Ƽ����޹�˾��
 * ��վ��ַ: http://www.milebiz.com
 * ============================================================================
 * $Author: zhourh $
 */

class WebserviceSpecificManagementSearchCore implements WebserviceSpecificManagementInterface
{
	protected $objOutput;
	protected $output;
	protected $wsObject;

	// ------------------------------------------------
	// GETTERS & SETTERS
	// ------------------------------------------------

	public function setObjectOutput(WebserviceOutputBuilderCore $obj)
	{
		$this->objOutput = $obj;
		return $this;
	}

	public function setWsObject(WebserviceRequestCore $obj)
	{
		$this->wsObject = $obj;
		return $this;
	}

	public function getWsObject()
	{
		return $this->wsObject;
	}
	public function getObjectOutput()
	{
		return $this->objOutput;
	}

	public function setUrlSegment($segments)
	{
		$this->urlSegment = $segments;
		return $this;
	}

	public function getUrlSegment()
	{
		return $this->urlSegment;
	}

	/**
	 * Management of search
	 *
	 */
	public function manage()
	{
		if (!isset($this->wsObject->urlFragments['query']) || !isset($this->wsObject->urlFragments['language']))
			throw new WebserviceException('You have to set both the \'language\' and \'query\' parameters to get a result', array(100, 400));
		$objects_products = array();
		$objects_categories = array();
		$objects_products['empty'] = new Product();
		$objects_categories['empty'] = new Category();

		$this->_resourceConfiguration = $objects_products['empty']->getWebserviceParameters();

		if (!$this->wsObject->setFieldsToDisplay())
			return false;

		$results = Search::find($this->wsObject->urlFragments['language'], $this->wsObject->urlFragments['query'], 1, 1, 'position', 'desc', true, false);
		$categories = array();
		foreach ($results AS $result)
		{
			$current = new Product($result['id_product']);
			$objects_products[] = $current;
			$categories_result = $current->getWsCategories();
			foreach ($categories_result as $category_result)
				foreach ($category_result as $id)
					$categories[] = $id;
		}
		$categories = array_unique($categories);
		foreach ($categories as $id)
			$objects_categories[] = new Category($id);

		$this->output .= $this->objOutput->getContent($objects_products, null, $this->wsObject->fieldsToDisplay, $this->wsObject->depth, WebserviceOutputBuilder::VIEW_LIST, false);
		// @todo allow fields of type category and product
		// $this->_resourceConfiguration = $objects_categories['empty']->getWebserviceParameters();
		// if (!$this->setFieldsToDisplay())
			// return false;

		$this->output .= $this->objOutput->getContent($objects_categories, null, $this->wsObject->fieldsToDisplay, $this->wsObject->depth, WebserviceOutputBuilder::VIEW_LIST, false);
	}

	/**
	 * This must be return a string with specific values as WebserviceRequest expects.
	 *
	 * @return string
	 */
	public function getContent()
	{
		return $this->objOutput->getObjectRender()->overrideContent($this->output);
	}
}