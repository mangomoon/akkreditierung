<?php
namespace Mangomoon\Mangomoon\ViewHelpers;

use TYPO3\CMS\Core\Domain\Repository\PageRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;
use TYPO3\CMS\Core\Category\Collection\CategoryCollection;

class PageCategoriesViewHelper extends AbstractViewHelper
{
    protected $escapeOutput = false;

    public function initializeArguments()
    {
        $this->registerArgument('pageUid', 'int', 'Page UID to load categories for', false);
        $this->registerArgument('as', 'string', 'Name der Variable, unter der die Kategorien gespeichert werden', true);
    }

    public function render(): string
    {
        $pageUid = $this->arguments['pageUid'];
        
        if (!$pageUid) {
            $pageUid = $this->getTypoScriptFrontendController()->id ?? 0;
        }

        if (!$pageUid) {
            $categories = [];
        } else {
            $queryBuilder = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Database\ConnectionPool::class)
                ->getQueryBuilderForTable('sys_category');
                
            $categories = $queryBuilder
                ->select('sys_category.*')
                ->from('sys_category')
                ->join(
                    'sys_category',
                    'sys_category_record_mm',
                    'mm',
                    $queryBuilder->expr()->eq('sys_category.uid', $queryBuilder->quoteIdentifier('mm.uid_local'))
                )
                ->where(
                    $queryBuilder->expr()->eq('mm.uid_foreign', $queryBuilder->createNamedParameter($pageUid, 'integer')),
                    $queryBuilder->expr()->eq('mm.tablenames', $queryBuilder->createNamedParameter('pages')),
                    $queryBuilder->expr()->eq('sys_category.deleted', 0),
                    $queryBuilder->expr()->eq('sys_category.hidden', 0)
                )
                ->orderBy('mm.sorting', 'ASC')
                ->executeQuery()
                ->fetchAllAssociative();
        }

        $this->templateVariableContainer->add($this->arguments['as'], $categories);
        return '';
    }

    protected function getTypoScriptFrontendController(): ?\TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController
    {
        return $GLOBALS['TSFE'] ?? null;
    }
    
}