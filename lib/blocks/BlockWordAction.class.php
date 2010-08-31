<?php
class lexicon_BlockWordAction extends website_BlockAction
{
	/**
	 * @see f_mvc_Action::execute()
	 *
	 * @param f_mvc_Request $request
	 * @param f_mvc_Response $response
	 * @return String
	 */
	function execute($request, $response)
    {
        $request->setAttribute('item', $this->getDocumentParameter());
        return block_BlockView::SUCCESS;
    }
}