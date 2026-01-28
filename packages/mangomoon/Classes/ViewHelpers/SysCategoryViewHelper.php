<?php
namespace Mangomoon\Mangomoon\ViewHelpers;

use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use PDO;

class SysCategoryViewHelper extends AbstractViewHelper
{

    protected $escapeOutput = false;

    public function initializeArguments(): void
    {
        parent::initializeArguments();
        $this->registerArgument('data', 'array', 'Data of current record', true);
        $this->registerArgument('as', 'string', 'Name of variable to create', false, 'items');
    }

    public function render(): string {
        $items = null;
        $arguments = $this->arguments; // Ensure arguments are accessed correctly
        if (is_array($arguments['data']) && !empty($arguments['data']['uid'])) {
            $connectionPool = GeneralUtility::makeInstance(ConnectionPool::class);
            $queryBuilder = $connectionPool->getQueryBuilderForTable('sys_category');
            
            $queryBuilder->getRestrictions()->removeAll();
            
            try {
                $result = $queryBuilder
                    ->select('c.*')
                    ->from('sys_category', 'c')
                    ->join(
                        'c', 
                        'sys_category_record_mm', 
                        'mm', 
                        $queryBuilder->expr()->and(
                            $queryBuilder->expr()->eq(
                                'mm.uid_foreign', 
                                $queryBuilder->createNamedParameter((int)$arguments['data']['uid'], PDO::PARAM_INT)
                            ),
                            $queryBuilder->expr()->eq(
                                'mm.uid_local', 
                                'c.uid'
                            )
                        )
                    )
                    ->executeQuery();

                $items = $result->fetchAllAssociative();
            } catch (\Doctrine\DBAL\Exception $e) {
                // Log the error for debugging purposes
                // GeneralUtility::sysLog(
                //     'Database query error: ' . $e->getMessage(),
                //     'mangomoon',
                //     GeneralUtility::SYSLOG_SEVERITY_ERROR
                // );
                $items = [];
            }
        }

        $variableProvider = $this->renderingContext->getVariableProvider();
        $variableProvider->add($arguments['as'], $items);
        $content = $this->renderChildren();
        $variableProvider->remove($arguments['as']);
        
        return $content;
    }
}