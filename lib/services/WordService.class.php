<?php
class lexicon_WordService extends f_persistentdocument_DocumentService
{
	/**
	 * @var lexicon_WordService
	 */
	private static $instance;

	/**
	 * @return lexicon_WordService
	 */
	public static function getInstance()
	{
		if (self::$instance === null)
		{
			self::$instance = self::getServiceClassInstance(get_class());
		}
		return self::$instance;
	}

	/**
	 * @return lexicon_persistentdocument_word
	 */
	public function getNewDocumentInstance()
	{
		return $this->getNewDocumentInstanceByModelName('modules_lexicon/word');
	}

	/**
	 * Create a query based on 'modules_lexicon/word' model
	 * @return f_persistentdocument_criteria_Query
	 */
	public function createQuery()
	{
		return $this->pp->createQuery('modules_lexicon/word');
	}

	/**
	 * @param lexicon_persistentdocument_word $document
	 * @param Integer $parentNodeId Parent node ID where to save the document (optionnal => can be null !).
	 * @return void
	 */
	protected function preSave($document, $parentNodeId)
	{
	    $originalLabel = $document->getLabel();
	    if (!empty($originalLabel))
	    {
	        $document->setLabel(f_util_StringUtils::ucfirst($originalLabel));
	        $firstLetter = f_util_StringUtils::strip_accents($originalLabel);
	        $firstLetter = f_util_StringUtils::strtoupper(f_util_StringUtils::substr($firstLetter, 0, 1));
	        if (is_numeric($firstLetter))
	        {
	            $firstLetter = "5";
	        }
            $document->setFirstletter($firstLetter);
	    }
	    else
	    {
	        $document->setFirstletter(null);
	    }
	}


	/**
	 * @param lexicon_persistentdocument_word $document
	 * @param Integer $parentNodeId Parent node ID where to save the document.
	 * @return void
	 */
//	protected function preInsert($document, $parentNodeId = null)
//	{
//	}

	/**
	 * @param lexicon_persistentdocument_word $document
	 * @param Integer $parentNodeId Parent node ID where to save the document.
	 * @return void
	 */
//	protected function postInsert($document, $parentNodeId = null)
//	{
//	}

	/**
	 * @param lexicon_persistentdocument_word $document
	 * @param Integer $parentNodeId Parent node ID where to save the document.
	 * @return void
	 */
//	protected function preUpdate($document, $parentNodeId = null)
//	{
//	}

	/**
	 * @param lexicon_persistentdocument_word $document
	 * @param Integer $parentNodeId Parent node ID where to save the document.
	 * @return void
	 */
//	protected function postUpdate($document, $parentNodeId = null)
//	{
//	}

	/**
	 * @param lexicon_persistentdocument_word $document
	 * @param Integer $parentNodeId Parent node ID where to save the document.
	 * @return void
	 */
//	protected function postSave($document, $parentNodeId = null)
//	{
//	}

	/**
	 * @param lexicon_persistentdocument_word $document
	 * @return void
	 */
//	protected function preDelete($document)
//	{
//	}

	/**
	 * @param lexicon_persistentdocument_word $document
	 * @return void
	 */
//	protected function preDeleteLocalized($document)
//	{
//	}

	/**
	 * @param lexicon_persistentdocument_word $document
	 * @return void
	 */
//	protected function postDelete($document)
//	{
//	}

	/**
	 * @param lexicon_persistentdocument_word $document
	 * @return void
	 */
//	protected function postDeleteLocalized($document)
//	{
//	}

	/**
	 * @param lexicon_persistentdocument_word $document
	 * @return boolean true if the document is publishable, false if it is not.
	 */
//	public function isPublishable($document)
//	{
//		$result = parent::isPublishable($document);
//		return $result;
//	}


	/**
	 * Methode à surcharger pour effectuer des post traitement apres le changement de status du document
	 * utiliser $document->getPublicationstatus() pour retrouver le nouveau status du document.
	 * @param lexicon_persistentdocument_word $document
	 * @param String $oldPublicationStatus
	 * @param array<"cause" => String, "modifiedPropertyNames" => array, "oldPropertyValues" => array> $params
	 * @return void
	 */
//	protected function publicationStatusChanged($document, $oldPublicationStatus, $params)
//	{
//	}

	/**
	 * @param lexicon_persistentdocument_word $document
	 * @param String $tag
	 * @return void
	 */
//	public function tagAdded($document, $tag)
//	{
//	}

	/**
	 * @param lexicon_persistentdocument_word $document
	 * @param String $tag
	 * @return void
	 */
//	public function tagRemoved($document, $tag)
//	{
//	}

	/**
	 * @param lexicon_persistentdocument_word $fromDocument
	 * @param f_persistentdocument_PersistentDocument $toDocument
	 * @param String $tag
	 * @return void
	 */
//	public function tagMovedFrom($fromDocument, $toDocument, $tag)
//	{
//	}

	/**
	 * @param f_persistentdocument_PersistentDocument $fromDocument
	 * @param lexicon_persistentdocument_word $toDocument
	 * @param String $tag
	 * @return void
	 */
//	public function tagMovedTo($fromDocument, $toDocument, $tag)
//	{
//	}

	/**
	 * Called before the moveToOperation starts. The method is executed INSIDE a
	 * transaction.
	 *
	 * @param f_persistentdocument_PersistentDocument $document
	 * @param Integer $destId
	 */
//	protected function onMoveToStart($document, $destId)
//	{
//	}

	/**
	 * @param lexicon_persistentdocument_word $document
	 * @param Integer $destId
	 * @return void
	 */
//	protected function onDocumentMoved($document, $destId)
//	{
//	}

	/**
	 * this method is call before save the duplicate document.
	 * If this method not override in the document service, the document isn't duplicable.
	 * An IllegalOperationException is so launched.
	 *
	 * @param f_persistentdocument_PersistentDocument $newDocument
	 * @param f_persistentdocument_PersistentDocument $originalDocument
	 * @param Integer $parentNodeId
	 *
	 * @throws IllegalOperationException
	 */
//	protected function preDuplicate($newDocument, $originalDocument, $parentNodeId)
//	{
//		throw new IllegalOperationException('This document cannot be duplicated.');
//	}

	/**
	 * Enter description here...
	 *
	 * @param Integer $topicId
	 * @param String $firstLetter
	 * @return array<lexicon_persistentdocument_word>
	 */
	public function getWordsByTopicsByLetter($topicId, $firstLetter)
	{ 
		$query = $this->createQuery()
    	    ->add(Restrictions::published())
    	    ->add(Restrictions::descendentOf($topicId));
	        	    
		if (!empty($firstLetter))
		{
		    $query->add(Restrictions::eq('firstletter', $firstLetter));
		}

		$result = $query->find();
		if (count($result) > 1)
		{
		    usort($result, array("lexicon_WordService", "compareWord"));
		}
		return $result;
	}
	
	/**
	 * @param lexicon_persistentdocument_word $a
	 * @param lexicon_persistentdocument_word $b
	 */
	public function compareWord($a, $b)
	{
	    $fla = $a->getFirstletter();
	    $flb = $b->getFirstletter();
	    if ($fla == $flb)
	    {
	        $la = $a->getLabel();
	        $lb = $b->getLabel();
	        if ($la == $lb)
	        {
	            return 0;
	        } 
	        else
	        {
	            return ($la < $lb) ? -1 : 1;
	        } 
	    }
	    else
	    {
            return ($fla < $flb) ? -1 : 1;
	    }
	}
	
	/**
	 * @param Integer $topicId
	 * @return String[]
	 */
	public function getAvailableLetters($topicId)
	{
	    $query = $this->createQuery()->setProjection(Projections::groupProperty('firstletter', 'fs'))
	        ->add(Restrictions::published())
    	    ->add(Restrictions::descendentOf($topicId));

    	$rows = $query->find();
	    if (count($rows) > 0)
	    {
        	$result = array();
    	    foreach ($rows as $row)
    	    {
    	        $result[] = $row['fs'];
    	    }
    	    
    	    sort($result);
	    }
	    else
	    {
	        $result = array();
	    }
	    
	    return $result;
	}
}