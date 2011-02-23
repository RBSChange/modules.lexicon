<?php
class lexicon_persistentdocument_word extends lexicon_persistentdocument_wordbase implements indexer_IndexableDocument
{
	/**
	 * Get the indexable document
	 * @return indexer_IndexedDocument
	 */
	public function getIndexedDocument()
	{
		$indexedDoc = new indexer_IndexedDocument();
		$indexedDoc->setId($this->getId());
		$indexedDoc->setDocumentModel('modules_lexicon/word');
		$indexedDoc->setLabel($this->getLabel());
		$indexedDoc->setLang(RequestContext::getInstance()->getLang());
		$indexedDoc->setText(f_util_StringUtils::htmlToText($this->getDefinition()));
		Framework::debug(__METHOD__ . var_export($indexedDoc, true));
		return $indexedDoc;
	}
}