<?php
class lexicon_ActionBase extends f_action_BaseAction
{
	
	/**
	 * Returns the lexicon_PreferencesService to handle documents of type "modules_lexicon/preferences".
	 *
	 * @return lexicon_PreferencesService
	 */
	public function getPreferencesService()
	{
		return lexicon_PreferencesService::getInstance();
	}
	
	/**
	 * Returns the lexicon_WordService to handle documents of type "modules_lexicon/word".
	 *
	 * @return lexicon_WordService
	 */
	public function getWordService()
	{
		return lexicon_WordService::getInstance();
	}
	
}