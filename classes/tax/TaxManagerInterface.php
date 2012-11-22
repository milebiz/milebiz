<?php
/*
* ___COPY__RIGHT___
*/


/**
* A TaxManager define a way to retrieve tax.
*/
interface TaxManagerInterface
{
	/**
	* This method determine if the tax manager is available for the specified address.
	*
	* @param Address $address
	* @param string $type
	*
	* @return TaxManager
   */
	public static function isAvailableForThisAddress(Address $address);

	/**
	* Return the tax calculator associated to this address
	*
	* @return TaxCalculator
	*/
	public function getTaxCalculator();
}

