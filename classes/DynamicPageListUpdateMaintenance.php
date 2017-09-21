<?php
/*
 * Check if page is created after all other jobs are done in update.php maintenance script
 */
class DynamicPageListUpdateMaintenance extends LoggedUpdateMaintenance {

	protected function doDBUpdates() {
		//Make sure page "Template:Extension DPL" exists
		$title = Title::newFromText( 'Template:Extension DPL' );

		if ( !$title->exists() ) {

			$oWikiPage = WikiPage::factory( $title );

			$oContentHandler = $oWikiPage->getContentHandler();
			$oContent = $oContentHandler->makeContent(
					"<noinclude>This page was automatically created. It serves as an anchor page for all '''[[Special:WhatLinksHere/Template:Extension_DPL|invocations]]''' of [http://mediawiki.org/wiki/Extension:DynamicPageList Extension:DynamicPageList (DPL)].</noinclude>",
					$title
					);

			$oWikiPage->doEditContent( $oContent, $title, EDIT_NEW | EDIT_FORCE_BOT );
		}
	}

	protected function getUpdateKey() {
		return 'dynamic-page-list-update-maintenance';
	}

}
