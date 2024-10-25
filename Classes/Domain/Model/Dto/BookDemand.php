<?php

declare(strict_types=1);

namespace Extcode\Books\Domain\Model\Dto;

/*
 * This file is part of the package extcode/books.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

class BookDemand extends AbstractEntity
{
    /**
     * @var string
     */
    protected $sku = '';

    /**
     * @var string
     */
    protected $title = '';

    /**
     * @var array
     */
    protected $categories = [];

    /**
     * @var string
     */
    protected $order = '';

    /**
     * @var int
     */
    protected $limit = 0;

    /**
     * @var string
     */
    protected $action = '';

    /**
     * @var string
     */
    protected $class = '';

    /**
     * @return string
     */
    public function getSku(): string
    {
        return $this->sku;
    }

    public function setSku(string $sku): void
    {
        $this->sku = $sku;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getCategories(): array
    {
        return $this->categories;
    }

    public function setCategories(array $categories): void
    {
        $this->categories = $categories;
    }

    public function getOrder(): string
    {
        return $this->order;
    }

    public function setOrder(string $order): void
    {
        $this->order = $order;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function setLimit(int $limit): void
    {
        $this->limit = $limit;
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function setAction(string $action): void
    {
        $this->action = $action;
    }

    public function getClass(): string
    {
        return $this->class;
    }

    public function setClass(string $class): void
    {
        $this->class = $class;
    }

    public function setActionAndClass(string $action, string $controller): void
    {
        $this->action = $action;
        $this->class = $controller;
    }
}
