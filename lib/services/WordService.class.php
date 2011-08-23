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
			self::$instance = new self();
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
	
	/**
	 * @param lexicon_persistentdocument_word $document
	 * @param string $moduleName
	 * @param string $treeType
	 * @param array<string, string> $nodeAttributes
	 */	
	public function addTreeAttributes($document, $moduleName, $treeType, &$nodeAttributes)
	{
	    $nodeAttributes['firstletter'] = $document->getFirstletter();
	}
}