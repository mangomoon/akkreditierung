<?php
declare(strict_types=1);

namespace GeorgRinger\Ieb\ViewHelpers;

use GeorgRinger\Ieb\Domain\Repository\AnsuchenArchivRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;

class AnsuchenOldVersionLoaderViewHelper extends AbstractViewHelper
{
    use CompileWithRenderStatic;

    protected $escapeOutput = false;

    public function initializeArguments(): void
    {

        $this->registerArgument('nummer', 'string', 'Ansuchen Nummer', true);
        $this->registerArgument('as', 'string', '', false, 'oldVersions');
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

        $repository = GeneralUtility::makeInstance(AnsuchenArchivRepository::class);
        $rows = $repository->getAllVersionsByNumber($arguments['nummer']);

        $templateVariableContainer->add($arguments['as'], $rows);

        $content = $renderChildrenClosure();

        $templateVariableContainer->remove($arguments['as']);

        return $content;
    }
}