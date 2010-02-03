<?php
class lexicon_PreferencesScriptDocumentElement extends import_ScriptDocumentElement
{
    /**
     * @return lexicon_persistentdocument_preferences
     */
    protected function initPersistentDocument()
    {
    	$document = ModuleService::getInstance()->getPreferencesDocument('lexicon');
    	return ($document !== null) ? $document : lexicon_PreferencesService::getInstance()->getNewDocumentInstance();
    }
}