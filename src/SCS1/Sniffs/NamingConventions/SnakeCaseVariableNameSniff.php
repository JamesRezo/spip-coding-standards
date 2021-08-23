<?php

namespace Spip\CodingStandards\SCS1\Sniffs\NamingConventions;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\AbstractVariableSniff;
use PHP_CodeSniffer\Util\Tokens;
use Spip\CodingStandards\Strings\SnakeCase;

class SnakeCaseVariableNameSniff extends AbstractVariableSniff
{
    protected function processVariable(File $phpcsFile, $stackPtr)
    {
        $tokens  = $phpcsFile->getTokens();
        $varName = ltrim($tokens[$stackPtr]['content'], '$');

        // If it's a php reserved var, then its ok.
        if (isset($this->phpReservedVars[$varName]) === true) {
            return;
        }

        $objOperator = $phpcsFile->findNext([T_WHITESPACE], ($stackPtr + 1), null, true);
        if ($tokens[$objOperator]['code'] === T_OBJECT_OPERATOR
            || $tokens[$objOperator]['code'] === T_NULLSAFE_OBJECT_OPERATOR
        ) {
            // Check to see if we are using a variable from an object.
            $var = $phpcsFile->findNext([T_WHITESPACE], ($objOperator + 1), null, true);
            if ($tokens[$var]['code'] === T_STRING) {
                $bracket = $phpcsFile->findNext([T_WHITESPACE], ($var + 1), null, true);
                if ($tokens[$bracket]['code'] !== T_OPEN_PARENTHESIS) {
                    $objVarName = $tokens[$var]['content'];

                    // There is no way for us to know if the var is public or
                    // private, so we have to ignore a leading underscore if there is
                    // one and just check the main part of the variable name.
                    $originalVarName = $objVarName;
                    if (substr($objVarName, 0, 1) === '_') {
                        $objVarName = substr($objVarName, 1);
                    }

                    if (!SnakeCase::isSnakeCase($objVarName)) {
                        $suggestedName = SnakeCase::toSnakeCase($originalVarName);
                        $error = 'Member variable "%s" is not in valid snake_case format (Suggested name: %s)';
                        $data  = [$originalVarName, $suggestedName];
                        $phpcsFile->addError($error, $var, 'MemberNotSnakeCase', $data);
                    }
                }//end if
            }//end if
        }//end if

        $objOperator = $phpcsFile->findPrevious(T_WHITESPACE, ($stackPtr - 1), null, true);
        if ($tokens[$objOperator]['code'] === T_DOUBLE_COLON) {
            // The variable lives within a class, and is referenced like
            // this: MyClass::$_variable, so we don't know its scope.
            $objVarName = $varName;
            if (substr($objVarName, 0, 1) === '_') {
                $objVarName = substr($objVarName, 1);
            }

            if (!SnakeCase::isSnakeCase($objVarName)) {
                $suggestedName = SnakeCase::toSnakeCase($varName);
                $error = 'Member variable "%s" is not in valid snake_case format (Suggested name: %s)';
                $data  = [$tokens[$stackPtr]['content'], $suggestedName];
                $phpcsFile->addError($error, $stackPtr, 'MemberNotSnakeCase', $data);
            }

            return;
        }

        // There is no way for us to know if the var is public or private,
        // so we have to ignore a leading underscore if there is one and just
        // check the main part of the variable name.
        $originalVarName = $varName;
        if (substr($varName, 0, 1) === '_') {
            $inClass = $phpcsFile->hasCondition($stackPtr, Tokens::$ooScopeTokens);
            if ($inClass === true) {
                $varName = substr($varName, 1);
            }
        }

        if (!SnakeCase::isSnakeCase($varName)) {
            $suggestedName = SnakeCase::toSnakeCase($originalVarName);
            $error = 'Variable "%s" is not in valid snake case format (Suggested name: %s)';
            $data  = [$originalVarName, $suggestedName];
            $phpcsFile->addError($error, $stackPtr, 'NotSnakeCase', $data);
        }
    }

    protected function processMemberVar(File $phpcsFile, $stackPtr)
    {
        // We don't care about member vars
    }

    protected function processVariableInString(File $phpcsFile, $stackPtr)
    {
        // We don't care about member vars
    }
}
