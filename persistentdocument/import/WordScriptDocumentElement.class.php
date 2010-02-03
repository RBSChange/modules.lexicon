<?php
class lexicon_WordScriptDocumentElement extends import_ScriptDocumentElement
{
    /**
     * @return lexicon_persistentdocument_word
     */
    protected function initPersistentDocument()
    {
    	return lexicon_WordService::getInstance()->getNewDocumentInstance();
    }
}