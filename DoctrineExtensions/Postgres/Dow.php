<?php

namespace MESD\DoctrineExtensions\DateFunctionsBundle\DoctrineExtensions\Postgres;

use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\AST\Functions\FunctionNode;

/**
 *  ExtractDowFunction ::=
 *      "DOW" "(" ArthimeticPrimary ")"
 *
 */

class Dow extends FunctionNode
{
    public $date;

    /**
     *  @override
     */
    public function getSql(\Doctrine\ORM\Query\SqlWalker $sqlWalker) {
        return "extract(dow from " . $sqlWalker->walkArithmeticPrimary($this->date) . ")";
    }

    public function parse(\Doctrine\ORM\Query\Parser $parser) {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);

        $this->date = $parser->ArithmeticPrimary();

        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }
}