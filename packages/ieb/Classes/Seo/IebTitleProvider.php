<?php

declare(strict_types=1);

namespace GeorgRinger\Ieb\Seo;


use TYPO3\CMS\Core\PageTitle\AbstractPageTitleProvider;

class IebTitleProvider extends AbstractPageTitleProvider
{
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }
}
