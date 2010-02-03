<?php
/**
 * lexicon_persistentdocument_preferences
 * @package lexicon
 */
class lexicon_persistentdocument_preferences extends lexicon_persistentdocument_preferencesbase 
{
	/**
	 * @see f_persistentdocument_PersistentDocumentImpl::getLabel()
	 *
	 * @return String
	 */
	public function getLabel()
	{
		return f_Locale::translateUI(parent::getLabel());
	}
}