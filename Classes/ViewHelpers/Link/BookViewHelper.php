<?php

declare(strict_types=1);

namespace Extcode\Books\ViewHelpers\Link;

use Extcode\Books\Domain\Model\Book;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\MathUtility;
use TYPO3\CMS\Extbase\Mvc\RequestInterface;
use TYPO3\CMS\Extbase\Mvc\Web\Routing\UriBuilder;
use TYPO3\CMS\Fluid\Core\Rendering\RenderingContext;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper;

/*
 * This file is part of the package extcode/books.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */
class BookViewHelper extends AbstractTagBasedViewHelper
{
    /**
     * @var string
     */
    protected $tagName = 'a';

    public function initializeArguments(): void
    {
        parent::initializeArguments();
        $this->registerUniversalTagAttributes();
        $this->registerTagAttribute('name', 'string', 'Specifies the name of an anchor');
        $this->registerTagAttribute('rel', 'string', 'Specifies the relationship between the current document and the linked document');
        $this->registerTagAttribute('rev', 'string', 'Specifies the relationship between the linked document and the current document');
        $this->registerTagAttribute('target', 'string', 'Specifies where to open the linked document');
        $this->registerArgument('action', 'string', 'Target action');
        $this->registerArgument('controller', 'string', 'Target controller. If NULL current controllerName is used');
        $this->registerArgument('extensionName', 'string', 'Target Extension Name (without `tx_` prefix and no underscores). If NULL the current extension name is used');
        $this->registerArgument('pluginName', 'string', 'Target plugin. If empty, the current plugin name is used');
        $this->registerArgument('pageUid', 'int', 'Target page. See TypoLink destination');
        $this->registerArgument('pageType', 'int', 'Type of the target page. See typolink.parameter');
        $this->registerArgument('noCache', 'bool', 'Set this to disable caching for the target page. You should not need this.');
        $this->registerArgument('section', 'string', 'The anchor to be added to the URI');
        $this->registerArgument('format', 'string', 'The requested format, e.g. ".html');
        $this->registerArgument('linkAccessRestrictedPages', 'bool', 'If set, links pointing to access restricted pages will still link to the page even though the page cannot be accessed.');
        $this->registerArgument('additionalParams', 'array', 'Additional query parameters that won\'t be prefixed like $arguments (overrule $arguments)');
        $this->registerArgument('absolute', 'bool', 'If set, the URI of the rendered link is absolute');
        $this->registerArgument('addQueryString', 'bool', 'If set, the current query parameters will be kept in the URI');
        $this->registerArgument('argumentsToBeExcludedFromQueryString', 'array', 'Arguments to be removed from the URI. Only active if $addQueryString = TRUE');
        $this->registerArgument('arguments', 'array', 'Arguments for the controller action, associative array');

        $this->registerArgument('book', Book::class, 'book', true);
        $this->registerArgument('settings', 'array', 'settings array', true);
    }

    public function render(): string
    {
        /** @var RenderingContext $renderingContext */
        $renderingContext = $this->renderingContext;
        $request = $renderingContext->getRequest();
        if (!$request instanceof RequestInterface) {
            throw new \RuntimeException(
                'ViewHelper f:link.action can be used only in extbase context and needs a request implementing extbase RequestInterface.',
                1639818540
            );
        }

        $action = $this->arguments['action'];
        $controller = $this->arguments['controller'];
        $extensionName = $this->arguments['extensionName'];
        $pluginName = $this->arguments['pluginName'];
        $pageUid = (int)$this->arguments['pageUid'] ?: null;
        $pageType = (int)$this->arguments['pageType'];
        $noCache = (bool)$this->arguments['noCache'];
        $section = (string)$this->arguments['section'];
        $format = (string)$this->arguments['format'];
        $linkAccessRestrictedPages = (bool)$this->arguments['linkAccessRestrictedPages'];
        $additionalParams = (array)$this->arguments['additionalParams'];
        $absolute = (bool)$this->arguments['absolute'];
        $addQueryString = (bool)$this->arguments['addQueryString'];
        $argumentsToBeExcludedFromQueryString = (array)$this->arguments['argumentsToBeExcludedFromQueryString'];

        $book = $this->arguments['book'];

        if ($book->getCategory() && $book->getCategory()->getBookShowPid()) {
            $pluginName = 'SingleBook';
            $pageUid = $book->getCategory()->getBookShowPid();
        } elseif ($this->arguments['settings']['showPageUid'] ?? false) {
            $pluginName = 'SingleBook';
            $pageUid = $this->arguments['settings']['showPageUid'];
        } else {
            $pluginName = 'Books';
        }
        $action = 'show';
        $this->arguments['arguments']['book'] = $book;

        $parameters = $this->arguments['arguments'];

        $uriBuilder = GeneralUtility::makeInstance(UriBuilder::class);
        $uriBuilder
            ->reset()
            ->setRequest($request)
            ->setTargetPageType($pageType)
            ->setNoCache($noCache)
            ->setSection($section)
            ->setFormat($format)
            ->setLinkAccessRestrictedPages($linkAccessRestrictedPages)
            ->setArguments($additionalParams)
            ->setCreateAbsoluteUri($absolute)
            ->setAddQueryString($addQueryString)
            ->setArgumentsToBeExcludedFromQueryString($argumentsToBeExcludedFromQueryString)
        ;

        if (MathUtility::canBeInterpretedAsInteger($pageUid)) {
            $uriBuilder->setTargetPageUid((int)$pageUid);
        }

        $uri = $uriBuilder->uriFor($action, $parameters, $controller, $extensionName, $pluginName);
        if ($uri === '') {
            return $this->renderChildren();
        }
        $this->tag->addAttribute('href', $uri);
        $this->tag->setContent($this->renderChildren());
        $this->tag->forceClosingTag(true);
        return $this->tag->render();
    }
}
