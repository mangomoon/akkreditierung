<?php

namespace Mangomoon\Mangomoon\ViewHelpers;

use TYPO3\CMS\Core\Resource\FileRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;
use TYPO3\CMS\Core\Database\ConnectionPool;


class SysCategoryViewHelper extends \TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper {
    use CompileWithRenderStatic;
    /**
     * @var bool
     */
    protected $escapeOutput = false;
    /**
     * Initialize arguments.
     *
     * @throws \TYPO3Fluid\Fluid\Core\ViewHelper\Exception
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('data', 'array', 'Data of current record', true);
        $this->registerArgument('as', 'string', 'Name of variable to create', false, 'items');
    }
    /**
     * @param array $arguments
     * @param \Closure $renderChildrenClosure
     * @param RenderingContextInterface $renderingContext
     * @return string
     */
    public static function renderStatic(array $arguments, \Closure $renderChildrenClosure, RenderingContextInterface $renderingContext) {
        $variableProvider = $renderingContext->getVariableProvider();
        if (is_array($arguments['data']) && $arguments['data']['uid']) {
            $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('sys_category');
            $queryBuilder->getRestrictions()
                ->removeAll();
            $query = $queryBuilder
                ->select('*')
                ->from('sys_category')
                ->join('sys_category', 'sys_category_record_mm', 'MM', $queryBuilder->expr()->andX(
                    $queryBuilder->expr()->eq('MM.uid_foreign', $arguments['data']['uid']),
                    $queryBuilder->expr()->eq('MM.uid_local','sys_category.uid')));
            $result = $query->execute();
            $items = [];
            while ($row = $result->fetch()) {
                $items[] = $row;
            }
        } else {
            $items = null;
        }
        $variableProvider->add($arguments['as'], $items);
        $content = $renderChildrenClosure();
        $variableProvider->remove($arguments['as']);
        return $content;
    }

}