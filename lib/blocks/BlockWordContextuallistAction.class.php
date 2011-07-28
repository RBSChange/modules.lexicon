<?php
class lexicon_BlockWordContextuallistAction extends website_BlockAction
{
	public function getCacheSpecifications()
	{
		return array("modules_lexicon/word", "modules_lexicon/preferences");
	}

	public function getCacheKeyParameters($request)
	{
		return array_merge($this->buildCacheKeyParameters(array('fl', paginator_Paginator::PAGEINDEX_PARAMETER_NAME)),
		array("context->id" => $this->getHandler()->getContext()->getId(),
		         "lang->id" => RequestContext::getInstance()->getLang()));
	}

	/**
	 * @see f_mvc_Action::execute()
	 *
	 * @param f_mvc_Request $request
	 * @param f_mvc_Response $response
	 * @return String
	 */
	function execute($request, $response)
	{
		// Get the parent topic
		$ancestor = $this->getContext()->getAncestorIds();
		$topicId = f_util_ArrayUtils::lastElement($ancestor);
		$wordService = lexicon_WordService::getInstance();
		$letters = $wordService->getAvailableLetters($topicId);

		if (f_util_ArrayUtils::isEmpty($letters))
		{
			return "NoTerm";				
		}
		
		$firstletter = $request->getParameter('fl');
		$navigation = array();

		$allTermsNav =  array('label' => f_Locale::translate('&modules.lexicon.frontoffice.n;'),
         'title' => f_Locale::translate('&modules.lexicon.frontoffice.all-terms-title;'));
		if ($firstletter != "")
		{
			$allTermsNav['href'] = LinkHelper::getCurrentUrl(array('lexiconParam' => array('fl' => '', paginator_Paginator::PAGEINDEX_PARAMETER_NAME => 1)));
		}
		$navigation[] = $allTermsNav;

		foreach ($letters as $letter)
		{
			$link = array('label' => f_Locale::translate('&modules.lexicon.frontoffice.N' . $letter . ';'),
          'title' => f_Locale::translate('&modules.lexicon.frontoffice.a-letter-terms;', array("letter" => $letter)));
			if ($firstletter != $letter)
			{
				$link['href'] = LinkHelper::getCurrentUrl(array('lexiconParam' => array('fl' => $letter, paginator_Paginator::PAGEINDEX_PARAMETER_NAME => 1)));
			}
			$navigation[] = $link;
		}

		$request->setAttribute('navigation', $navigation);
		$request->setAttribute('current', f_Locale::translate('&modules.lexicon.frontoffice.N' . $firstletter . ';'));

		$items = $wordService->getWordsByTopicsByLetter($topicId, $firstletter);

		// Get the preference of module
		$nbItemPerPage = lexicon_PreferencesService::getInstance()->getNbItemPerPage();

		// Set the paginator
		$paginator = new paginator_Paginator('lexicon', $request->getParameter(paginator_Paginator::PAGEINDEX_PARAMETER_NAME, 1), $items, $nbItemPerPage);
		$paginator->setListName(f_Locale::translate('&modules.lexicon.frontoffice.terms-listName;'));
		$request->setAttribute('paginator', $paginator);

		return block_BlockView::SUCCESS;
	}
}