<?php
class lexicon_PreferencesService extends f_persistentdocument_DocumentService
{
	/**
	 * @var lexicon_PreferencesService
	 */
	private static $instance;

	/**
	 * @return lexicon_PreferencesService
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
	 * @return lexicon_persistentdocument_preferences
	 */
	public function getNewDocumentInstance()
	{
		return $this->getNewDocumentInstanceByModelName('modules_lexicon/preferences');
	}

	/**
	 * Create a query based on 'modules_lexicon/preferences' model
	 * @return f_persistentdocument_criteria_Query
	 */
	public function createQuery()
	{
		return $this->getPersistentProvider()->createQuery('modules_lexicon/preferences');
	}

	/**
	 * @param lexicon_persistentdocument_preferences $document
	 * @param Integer $parentNodeId Parent node ID where to save the document (optionnal => can be null !).
	 * @return void
	 */
	protected function preSave($document, $parentNodeId)
	{
		$document->setLabel('lexicon');
	}

	/**
	 * @var lexicon_persistentdocument_preferences
	 */
	private $preferenceDocument;
	
	/**
	 * 
	 * @return lexicon_persistentdocument_preferences
	 */
	private function getPreferenceDocument()
	{
	    if ($this->preferenceDocument === NULL)
	    {
	        $this->preferenceDocument = $this->createQuery()->findUnique();
	        if ($this->preferenceDocument === NULL)
	        {
	            $this->preferenceDocument = $this->getNewDocumentInstance();
	            $this->save($this->preferenceDocument);
	        }
	    }
	    return $this->preferenceDocument;
	}
	
	/**
	 * @return Integer
	 */
	public function getNbItemPerPage()
	{
	    return $this->getPreferenceDocument()->getNbItem();
	}
}