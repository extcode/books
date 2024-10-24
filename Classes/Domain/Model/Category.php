<?php

declare(strict_types=1);

namespace Extcode\Books\Domain\Model;

/*
 * This file is part of the package extcode/books.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

class Category extends \TYPO3\CMS\Extbase\Domain\Model\Category
{
    protected int $bookListPid;

    protected int $bookShowPid;

    public function getBookListPid(): ?int
    {
        return $this->bookListPid;
    }

    public function getBookShowPid(): ?int
    {
        return $this->bookShowPid;
    }
}
