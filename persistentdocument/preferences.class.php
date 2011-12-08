<?php
/**
 * @package lexicon
 */
class lexicon_persistentdocument_preferences extends lexicon_persistentdocument_preferencesbase 
{
	/**
	 * Define the label of the tree node of the document.
	 * By default, this method returns the label property value.
	 * @return string
	 */
	public function getTreeNodeLabel()
	{
		return LocaleService::getInstance()->trans('m.lexicon.bo.general.module-name', array('ucf'));
	}
}