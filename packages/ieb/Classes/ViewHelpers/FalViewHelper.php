<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\ViewHelpers;

use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Resource\ResourceFactory;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Frontend\Resource\FileCollector;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;

class FalViewHelper extends AbstractViewHelper
{
    use CompileWithRenderStatic;

    protected $escapeOutput = false;

    public function initializeArguments(): void
    {

        $this->registerArgument(
            'path',
            'string',
            'Path',
            true
        );
        $this->registerArgument(
            'as',
            'string',
            'This parameter specifies the name of the variable that will be used for the returned ' .
            'ViewHelper result.',
            false,
            'file'
        );
    }

    /**
     * @param array $arguments
     * @param \Closure $renderChildrenClosure
     * @param RenderingContextInterface $renderingContext
     * @return mixed
     */
    public static function renderStatic(array $arguments, \Closure $renderChildrenClosure, RenderingContextInterface $renderingContext)
    {
        $templateVariableContainer = $renderingContext->getVariableProvider();

        $resources = GeneralUtility::makeInstance(ResourceFactory::class);
        try {
            $file = $resources->getFileObjectFromCombinedIdentifier($arguments['path']);
        } catch (\Exception $e) {
            $file = null;
        }
        $templateVariableContainer->add($arguments['as'], $file);

        $content = $renderChildrenClosure();

        $templateVariableContainer->remove($arguments['as']);

        return $content;
    }
}