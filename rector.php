<?php

declare(strict_types=1);

use Rector\Arguments\Rector\ClassMethod\ArgumentAdderRector;
use Rector\CodeQuality\Rector\Array_\CallableThisArrayToAnonymousFunctionRector;
use Rector\CodingStyle\Rector\ClassConst\VarConstantCommentRector;
use Rector\CodingStyle\Rector\ClassMethod\UnSpreadOperatorRector;
use Rector\Config\RectorConfig;
use Rector\Core\Configuration\Option;
use Rector\DeadCode\Rector\ClassMethod\RemoveUnusedConstructorParamRector;
use Rector\EarlyReturn\Rector\If_\ChangeAndIfToEarlyReturnRector;
use Rector\EarlyReturn\Rector\If_\ChangeOrIfReturnToEarlyReturnRector;
use Rector\Naming\Rector\Assign\RenameVariableToMatchMethodCallReturnTypeRector;
use Rector\Naming\Rector\Class_\RenamePropertyToMatchTypeRector;
use Rector\Naming\Rector\ClassMethod\RenameParamToMatchTypeRector;
use Rector\Naming\Rector\ClassMethod\RenameVariableToMatchNewTypeRector;
use Rector\Php80\Rector\FunctionLike\UnionTypesRector;
use Rector\Php81\Rector\Class_\MyCLabsClassToEnumRector;
use Rector\Php81\Rector\Class_\SpatieEnumClassToEnumRector;
use Rector\Php81\Rector\ClassConst\FinalizePublicClassConstantRector;
use Rector\Php81\Rector\ClassMethod\NewInInitializerRector;
use Rector\Php81\Rector\FuncCall\Php81ResourceReturnToObjectRector;
use Rector\Privatization\Rector\Class_\ChangeReadOnlyVariableWithDefaultValueToConstantRector;
use Rector\Privatization\Rector\Property\ChangeReadOnlyPropertyWithDefaultValueToConstantRector;
use Rector\Set\ValueObject\SetList;
use Rector\TypeDeclaration\Rector\ClassMethod\AddArrayParamDocTypeRector;
use Rector\TypeDeclaration\Rector\ClassMethod\AddArrayReturnDocTypeRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->skip([__DIR__ . '/var/']);
    $rectorConfig->paths([__DIR__ . '/src']);
    $parameters = $rectorConfig->parameters();

    $rectorConfig->import(SetList::DEAD_CODE);
    $rectorConfig->import(SetList::ACTION_INJECTION_TO_CONSTRUCTOR_INJECTION);
    $rectorConfig->import(SetList::CODE_QUALITY);
    $rectorConfig->import(SetList::CODING_STYLE);
    $rectorConfig->import(SetList::DEAD_CODE);
    $rectorConfig->import(SetList::EARLY_RETURN);
    $rectorConfig->import(SetList::NAMING);
    $rectorConfig->import(SetList::PHP_74);
    $rectorConfig->import(SetList::PHP_80);
    $rectorConfig->import(SetList::PRIVATIZATION);
    $rectorConfig->import(SetList::PSR_4);
    $rectorConfig->import(SetList::TYPE_DECLARATION);

    $parameters->set(
        Option::SKIP,
        [
            ChangeAndIfToEarlyReturnRector::class,
            ChangeOrIfReturnToEarlyReturnRector::class,
            ChangeReadOnlyPropertyWithDefaultValueToConstantRector::class,
            ChangeReadOnlyVariableWithDefaultValueToConstantRector::class,
            RemoveUnusedConstructorParamRector::class,
            RenameParamToMatchTypeRector::class,
            RenamePropertyToMatchTypeRector::class,
            UnSpreadOperatorRector::class,
            VarConstantCommentRector::class,
            AddArrayReturnDocTypeRector::class,
            AddArrayParamDocTypeRector::class,
            ArgumentAdderRector::class,
            RenameVariableToMatchMethodCallReturnTypeRector::class,
            RenameVariableToMatchNewTypeRector::class,
            UnionTypesRector::class,
            CallableThisArrayToAnonymousFunctionRector::class,
            FinalizePublicClassConstantRector::class,
            MyCLabsClassToEnumRector::class,
            NewInInitializerRector::class,
            Php81ResourceReturnToObjectRector::class,
            SpatieEnumClassToEnumRector::class,
        ]
    );
};
