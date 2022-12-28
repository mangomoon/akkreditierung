<?php

declare(strict_types=1);

namespace GeorgRinger\Ieb\Controller;


use Psr\Http\Message\ResponseInterface;

/**
 * This file is part of the "ieb" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2022 Georg Ringer <mail@ringer.it>
 */
class WidgetController extends BaseController
{

    public function indexAction(): ResponseInterface
    {
        return $this->htmlResponse();
    }

}
