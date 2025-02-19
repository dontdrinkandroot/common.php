<?php

namespace Dontdrinkandroot\Common\PHPStan;

use Dontdrinkandroot\Common\Asserted;
use Override;
use PhpParser\Node;
use PhpParser\Node\Expr\StaticCall;
use PHPStan\Analyser\Scope;
use PHPStan\Php\PhpVersion;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;
use PHPStan\Type\Constant\ConstantIntegerType;
use PHPStan\Type\MixedType;
use PHPStan\Type\TypeCombinator;
use PHPStan\Type\VerbosityLevel;

/**
 * @implements Rule<StaticCall>
 */
class RedundantAssert implements Rule
{
    public function __construct(private readonly PhpVersion $phpVersion)
    {
    }

    #[Override]
    public function getNodeType(): string
    {
        return StaticCall::class;
    }

    #[Override]
    public function processNode(Node $node, Scope $scope): array
    {
        if (
            !($node->class instanceof Node\Name)
            || $node->class->name !== Asserted::class
            || !$node->name instanceof Node\Identifier
            || !isset($node->args[0])
            || !(($firstArg = $node->args[0]) instanceof Node\Arg)
        ) {
            return [];
        }

        $methodName = $node->name->toString();
        $firstArgValue = $firstArg->value;
        $firstArgType = $scope->getType($firstArgValue);

        $errors = [];

        switch ($methodName) {
            case 'notNull':
                if (!$firstArgType instanceof MixedType && !TypeCombinator::containsNull($firstArgType)) {
                    $errors[] = RuleErrorBuilder::message(
                        sprintf(
                            "The value of type %s is not nullable, so the Asserted::notNull call is redundant.",
                            $firstArgType->describe(VerbosityLevel::typeOnly())
                        )
                    )
                        ->identifier('ddrCommon.redundantAssert')
                        ->build();
                }
                break;

            case 'string':
                if ($firstArgType->isString()->yes() && !TypeCombinator::containsNull($firstArgType)) {
                    $errors[] = RuleErrorBuilder::message(
                        sprintf(
                            "The value of type %s is always string, so the Asserted::string call is redundant.",
                            $firstArgType->describe(VerbosityLevel::typeOnly())
                        )
                    )
                        ->identifier('ddrCommon.redundantAssert')
                        ->build();
                }
                break;

            case 'stringOrNull':
                if ($firstArgType->isString()->yes() || $firstArgType->isNull()->yes()) {
                    $errors[] = RuleErrorBuilder::message(
                        sprintf(
                            "The value of type %s is always string or null, so the Asserted::stringOrNull call is redundant.",
                            $firstArgType->describe(VerbosityLevel::typeOnly())
                        )
                    )
                        ->identifier('ddrCommon.redundantAssert')
                        ->build();
                }
                break;

            case 'int':
                if ($firstArgType->isInteger()->yes() && !TypeCombinator::containsNull($firstArgType)) {
                    $errors[] = RuleErrorBuilder::message(
                        sprintf(
                            "The value of type %s is always int, so the Asserted::int call is redundant.",
                            $firstArgType->describe(VerbosityLevel::typeOnly())
                        )
                    )
                        ->identifier('ddrCommon.redundantAssert')
                        ->build();
                }
                break;

            case 'intOrNull':
                if ($firstArgType->isInteger()->yes() || $firstArgType->isNull()->yes()) {
                    $errors[] = RuleErrorBuilder::message(
                        sprintf(
                            "The value of type %s is always int or null, so the Asserted::intOrNull call is redundant.",
                            $firstArgType->describe(VerbosityLevel::typeOnly())
                        )
                    )
                        ->identifier('ddrCommon.redundantAssert')
                        ->build();
                }
                break;

            case 'float':
                if ($firstArgType->isFloat()->yes() && !TypeCombinator::containsNull($firstArgType)) {
                    $errors[] = RuleErrorBuilder::message(
                        sprintf(
                            "The value of type %s is always float, so the Asserted::float call is redundant.",
                            $firstArgType->describe(VerbosityLevel::typeOnly())
                        )
                    )
                        ->identifier('ddrCommon.redundantAssert')
                        ->build();
                }
                break;

            case 'floatOrNull':
                if ($firstArgType->isFloat()->yes() || $firstArgType->isNull()->yes()) {
                    $errors[] = RuleErrorBuilder::message(
                        sprintf(
                            "The value of type %s is always float or null, so the Asserted::floatOrNull call is redundant.",
                            $firstArgType->describe(VerbosityLevel::typeOnly())
                        )
                    )
                        ->identifier('ddrCommon.redundantAssert')
                        ->build();
                }
                break;

            case 'bool':
                if ($firstArgType->isBoolean()->yes() && !TypeCombinator::containsNull($firstArgType)) {
                    $errors[] = RuleErrorBuilder::message(
                        sprintf(
                            "The value of type %s is always bool, so the Asserted::bool call is redundant.",
                            $firstArgType->describe(VerbosityLevel::typeOnly())
                        )
                    )
                        ->identifier('ddrCommon.redundantAssert')
                        ->build();
                }
                break;

            case 'boolOrNull':
                if ($firstArgType->isBoolean()->yes() || $firstArgType->isNull()->yes()) {
                    $errors[] = RuleErrorBuilder::message(
                        sprintf(
                            "The value of type %s is always bool or null, so the Asserted::boolOrNull call is redundant.",
                            $firstArgType->describe(VerbosityLevel::typeOnly())
                        )
                    )
                        ->identifier('ddrCommon.redundantAssert')
                        ->build();
                }
                break;
            case 'nonEmptyString':
                if ($firstArgType->isString()->yes() && !$firstArgType->isNull()->yes() && $firstArgType->isNonEmptyString()->yes()) {
                    $errors[] = RuleErrorBuilder::message(
                        sprintf(
                            "The value of type %s is always a non-empty string, so the Asserted::nonEmptyString call is redundant.",
                            $firstArgType->describe(VerbosityLevel::typeOnly())
                        )
                    )
                        ->identifier('ddrCommon.redundantAssert')
                        ->build();
                }
                break;
            case 'array':
                if ($firstArgType->isArray()->yes() && !TypeCombinator::containsNull($firstArgType)) {
                    $errors[] = RuleErrorBuilder::message(
                        sprintf(
                            "The value of type %s is always an array, so the Asserted::array call is redundant.",
                            $firstArgType->describe(VerbosityLevel::typeOnly())
                        )
                    )
                        ->identifier('ddrCommon.redundantAssert')
                        ->build();
                }
                break;
            case 'arrayOrNull':
                if ($firstArgType->isArray()->yes() || $firstArgType->isNull()->yes()) {
                    $errors[] = RuleErrorBuilder::message(
                        sprintf(
                            "The value of type %s is always an array or null, so the Asserted::arrayOrNull call is redundant.",
                            $firstArgType->describe(VerbosityLevel::typeOnly())
                        )
                    )
                        ->identifier('ddrCommon.redundantAssert')
                        ->build();
                }
                break;
            case 'iterable':
                if ($firstArgType->isIterable()->yes() && !TypeCombinator::containsNull($firstArgType)) {
                    $errors[] = RuleErrorBuilder::message(
                        sprintf(
                            "The value of type %s is always an iterable, so the Asserted::iterable call is redundant.",
                            $firstArgType->describe(VerbosityLevel::typeOnly())
                        )
                    )
                        ->identifier('ddrCommon.redundantAssert')
                        ->build();
                }
                break;
            case 'iterableOrNull':
                if ($firstArgType->isIterable()->yes() || $firstArgType->isNull()->yes()) {
                    $errors[] = RuleErrorBuilder::message(
                        sprintf(
                            "The value of type %s is always an iterable or null, so the Asserted::iterableOrNull call is redundant.",
                            $firstArgType->describe(VerbosityLevel::typeOnly())
                        )
                    )
                        ->identifier('ddrCommon.redundantAssert')
                        ->build();
                }
                break;
            case 'notFalse':
                if ($firstArgType->isFalse()->no() && !TypeCombinator::containsNull($firstArgType)) {
                    $errors[] = RuleErrorBuilder::message(
                        sprintf(
                            "The value of type %s is never false, so the Asserted::notFalse call is redundant.",
                            $firstArgType->describe(VerbosityLevel::typeOnly())
                        )
                    )
                        ->identifier('ddrCommon.redundantAssert')
                        ->build();
                }
                break;
            case 'positiveInt':
                if (
                    $firstArgType->isInteger()->yes()
                    && (new ConstantIntegerType(0))->isSmallerThan($firstArgType, $this->phpVersion)->yes()
                    && !TypeCombinator::containsNull($firstArgType)
                ) {
                    $errors[] = RuleErrorBuilder::message(
                        sprintf(
                            "The value of type %s is always a positive int, so the Asserted::positiveInt call is redundant.",
                            $firstArgType->describe(VerbosityLevel::typeOnly())
                        )
                    )
                        ->identifier('ddrCommon.redundantAssert')
                        ->build();
                }
                break;
            case 'positiveIntOrNull':
                if (
                    $firstArgType->isInteger()->yes()
                    && (new ConstantIntegerType(0))->isSmallerThan($firstArgType, $this->phpVersion)->yes()
                    || $firstArgType->isNull()->yes()
                ) {
                    $errors[] = RuleErrorBuilder::message(
                        sprintf(
                            "The value of type %s is always a positive int or null, so the Asserted::positiveIntOrNull call is redundant.",
                            $firstArgType->describe(VerbosityLevel::typeOnly())
                        )
                    )
                        ->identifier('ddrCommon.redundantAssert')
                        ->build();
                }
                break;
            case 'instanceOf':
                if (
                    !isset($node->args[1])
                    || !(($secondArg = $node->args[1]) instanceof Node\Arg)
                    || !(($secondArgValue = $secondArg->value) instanceof Node\Expr\ClassConstFetch)
                    || !(($secondArgValueClass = $secondArgValue->class) instanceof Node\Name)
                ) {
                    break;
                }

                if (
                    $firstArgType->isNull()->no()
                    && $firstArgType->isObject()->yes()
                    /** @phpstan-ignore method.notFound */
                    && $firstArgType->isInstanceOf($secondArgValueClass->name)->yes()
                ) {
                    $errors[] = RuleErrorBuilder::message(
                        sprintf(
                            "The value of type %s is always an instance of %s, so the Asserted::instanceOf call is redundant.",
                            $firstArgType->describe(VerbosityLevel::typeOnly()),
                            $secondArgValueClass->name
                        )
                    )
                        ->identifier('ddrCommon.redundantAssert')
                        ->build();
                }
                break;
            case 'instanceOfOrNull':
                if (
                    !isset($node->args[1])
                    || !(($secondArg = $node->args[1]) instanceof Node\Arg)
                    || !(($secondArgValue = $secondArg->value) instanceof Node\Expr\ClassConstFetch)
                    || !(($secondArgValueClass = $secondArgValue->class) instanceof Node\Name)
                ) {
                    break;
                }

                if (
                    $firstArgType->isNull()->yes()
                    || (
                        $firstArgType->isObject()->yes()
                        /** @phpstan-ignore method.notFound */
                        && $firstArgType->isInstanceOf($secondArgValueClass->name)->yes()
                    )
                ) {
                    $errors[] = RuleErrorBuilder::message(
                        sprintf(
                            "The value of type %s is always an instance of %s or null, so the Asserted::instanceOfOrNull call is redundant.",
                            $firstArgType->describe(VerbosityLevel::typeOnly()),
                            $secondArgValueClass->name
                        )
                    )
                        ->identifier('ddrCommon.redundantAssert')
                        ->build();
                }
                break;
        }

        return $errors;
    }
}
