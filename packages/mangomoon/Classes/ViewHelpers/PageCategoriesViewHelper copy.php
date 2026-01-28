<?php
namespace Mangomoon\Mangomoon\ViewHelpers;

use TYPO3\CMS\Core\Domain\Repository\PageRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;
use TYPO3\CMS\Core\Category\Collection\CategoryCollection;

/**
 * ViewHelper, um Kategorien einer Seite anzuzeigen
 *
 * Beispiel:
 * <code>
 * <v:pageCategories pageUid="{pageUid}" as="categories">
 *   <f:for each="{categories}" as="category">
 *     {category.title}
 *   </f:for>
 * </v:pageCategories>
 * </code>
 */
class PageCategoriesViewHelper extends AbstractViewHelper
{
    use CompileWithRenderStatic;

    /**
     * ViewHelper-Argumente initialisieren
     */
    public function initializeArguments(): void
    {
        $this->registerArgument('pageUid', 'int', 'UID der Seite, deren Kategorien angezeigt werden sollen', false);
        $this->registerArgument('as', 'string', 'Name der Variable, unter der die Kategorien gespeichert werden', true);
        $this->registerArgument('categoryUid', 'int', 'Optional: Filtern nach übergeordneter Kategorie-UID', false, 0);
    }

    /**
     * @param array $arguments
     * @param \Closure $renderChildrenClosure
     * @param RenderingContextInterface $renderingContext
     * @return mixed
     */
    public static function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    ) {
        $pageUid = $arguments['pageUid'] ?? $GLOBALS['TSFE']->id;
        $as = $arguments['as'];
        $categoryUid = (int)$arguments['categoryUid'];
        
        // Kategorien für die angegebene Seite abrufen
        $categories = self::getPageCategories($pageUid, $categoryUid);
        
        // Variable im Template-Kontext setzen
        $variableProvider = $renderingContext->getVariableProvider();
        $variableProvider->add($as, $categories);
        
        // ViewHelper-Inhalt rendern
        $output = $renderChildrenClosure();
        
        // Variable wieder entfernen
        $variableProvider->remove($as);
        
        return $output;
    }
    
    /**
     * Holt die Kategorien für die angegebene Seite
     * 
     * @param int $pageUid
     * @param int $categoryUid
     * @return array
     */
    protected static function getPageCategories(int $pageUid, int $categoryUid = 0): array
    {
        $pageRepository = GeneralUtility::makeInstance(PageRepository::class);
        $page = $pageRepository->getPage($pageUid);
        
        if (empty($page)) {
            return [];
        }
        
        // Kategoriesammlung für Pages mit der Tabellenkombination laden
        $categoryCollection = CategoryCollection::load(
            'pages',
            'categories',
            $pageUid
        );
        
        if ($categoryCollection === null) {
            return [];
        }
        
        $categories = $categoryCollection->toArray();
        
        // Wenn eine übergeordnete Kategorie angegeben wurde, filtern wir die Ergebnisse
        if ($categoryUid > 0) {
            $filteredCategories = [];
            foreach ($categories as $category) {
                if ((int)$category['parent'] === $categoryUid) {
                    $filteredCategories[] = $category;
                }
            }
            return $filteredCategories;
        }
        
        return $categories;
    }
}