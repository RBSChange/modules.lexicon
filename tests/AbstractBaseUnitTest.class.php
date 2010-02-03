<?php
abstract class lexicon_tests_AbstractBaseUnitTest extends lexicon_tests_AbstractBaseTest
{
	/**
	 * @return void
	 */
	public function prepareTestCase()
	{
		$this->resetDatabase();
	}
}