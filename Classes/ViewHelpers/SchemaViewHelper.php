<?php

declare(strict_types=1);

namespace Extcode\Books\ViewHelpers;

/*
 * This file is part of the package extcode/books.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use Extcode\Books\Domain\Model\Book;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class SchemaViewHelper extends AbstractViewHelper
{
    /**
     * Output is escaped already. We must not escape children, to avoid double encoding.
     *
     * @var bool
     */
    protected $escapeOutput = false;

    public function initializeArguments(): void
    {
        parent::initializeArguments();

        $this->registerArgument(
            'book',
            Book::class,
            'book',
            true
        );
    }

    public function render(): string
    {
        $book = $this->arguments['book'];

        $schemaBook = [
            '@context' => 'https://schema.org',
            '@type' => 'Book',
            'additionalType' => 'Product',
            'name' => $book->getTitle(),
            'author' => $book->getAuthor(),
        ];

        return json_encode($schemaBook);
    }
}
