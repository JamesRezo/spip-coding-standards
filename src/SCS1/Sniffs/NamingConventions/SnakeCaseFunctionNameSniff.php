<?php

namespace Spip\CodingStandards\SCS1\Sniffs\NamingConventions;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Standards\PEAR\Sniffs\NamingConventions\ValidFunctionNameSniff as PEARValidFunctionNameSniff;
use Spip\CodingStandards\Strings\SnakeCase;

class SnakeCaseFunctionNameSniff extends PEARValidFunctionNameSniff
{
    /**
     * {@inheritdoc}
     */
    public function processTokenOutsideScope(File $phpcsFile, $stackPtr)
    {
        $functionName = $phpcsFile->getDeclarationName($stackPtr);
        if ($functionName === null) {
            return;
        }

        $errorData = [$functionName];

        // Does this function claim to be magical?
        if (preg_match('|^__[^_]|', $functionName) !== 0) {
            $error = 'Function name "%s" is invalid; only PHP magic methods should be prefixed with a double underscore';
            $phpcsFile->addError($error, $stackPtr, 'DoubleUnderscore', $errorData);

            $functionName = ltrim($functionName, '_');
        }

        if(preg_match(',^(balise|boucle|critere|iterateur)_([a-z0-9_]+),i', $functionName, $matches)) {
            $fullName = $functionName;

            $functionPrefix = strtolower($matches[1]);
            if ($functionPrefix !== $matches[1]) {
                $error = 'Special function name "%s" is invalid; Prefix %s must be in lowercase"';
                $phpcsFile->addError($error, $stackPtr, 'PrefixLowerCase', [$fullName, $functionPrefix]);
            }

            $functionName = $matches[2];
            $functionSuffix = '';
            if (preg_match(',_(contexte|dist|dyn|stat)$,i', $functionName, $matches2)) {
                $functionSuffix = strtolower($matches2[1]);
                if ($functionSuffix !== $matches2[1]) {
                    $error = 'Special function name "%s" is invalid; Suffix %s must be in lowercase"';
                    $phpcsFile->addError($error, $stackPtr, 'SuffixLowerCase', [$fullName, $functionSuffix]);
                }
            }

            if ($functionSuffix) {
                if ($functionPrefix !== 'balise' && $functionSuffix !== 'dist') {
                    $error = 'Special function name "%s" is invalid; Suffix %s is not allowed with prefix %s"';
                    $phpcsFile->addError($error, $stackPtr, 'SuffixNotAllowed', [$fullName, $functionSuffix, $functionPrefix]);
                }
                $functionName = preg_replace(",_$matches2[1]$,", '', $functionName);
            }

            if ($functionPrefix == 'critere') {
                return;
            }

            if ($functionName !== strtoupper($functionName)) {
                $error = 'Special function name "%s" is invalid; Body %s must be in uppercase"';
                $phpcsFile->addError($error, $stackPtr, 'ScreamingSnakeCase', [$fullName, $functionName]);
            }
        } elseif (!SnakeCase::isSnakeCase($functionName)) {
            $phpcsFile->addError(
                'Function name "%s" is not in snake case format (Suggested name: %s)',
                $stackPtr,
                'NotSnakeCase',
                [$functionName, SnakeCase::toSnakeCase($functionName)]
            );
        }
    }
}
