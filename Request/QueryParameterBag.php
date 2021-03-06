<?php

namespace ArturDoruch\ListBundle\Request;

use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;

/**
 * Helps getting request query parameters related to pagination.
 *
 * @author Artur Doruch <arturdoruch@interia.pl>
 */
class QueryParameterBag
{
    /**
     * @var ParameterBag
     */
    private $query;


    public function __construct(Request $request)
    {
        $this->query = $request->query;
    }

    /**
     * @return int
     */
    public function getPage()
    {
        return $this->query->getInt(QueryParameterNames::getPage());
    }

    /**
     * @param int $default
     *
     * @return int
     */
    public function getLimit(int $default)
    {
        return $this->query->getInt(QueryParameterNames::getLimit(), $default);
    }

    /**
     * @param string $defaultField The default sort field.
     * @param string $direction The default sort direction. One of values: "asc", "desc".
     *
     * @return array
     */
    public function getSort(string $defaultField = null, string $direction = 'asc')
    {
        $default = $defaultField ? QuerySort::create($defaultField, $direction) : null;

        if ($value = $this->query->get(QueryParameterNames::getSort(), $default)) {
            return QuerySort::parse($value);
        }

        return [];
    }
}
