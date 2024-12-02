<?php

namespace Dontdrinkandroot\Common\Psalm;

use Dontdrinkandroot\Common\Asserted;
use Override;
use PhpParser\Node\Expr\StaticCall;
use Psalm\CodeLocation;
use Psalm\Issue\RedundantCondition;
use Psalm\IssueBuffer;
use Psalm\Plugin\EventHandler\AfterMethodCallAnalysisInterface;
use Psalm\Plugin\EventHandler\Event\AfterMethodCallAnalysisEvent;
use Psalm\Plugin\PluginEntryPointInterface;
use Psalm\Plugin\RegistrationInterface;
use SimpleXMLElement;

class CommonPlugin implements PluginEntryPointInterface, AfterMethodCallAnalysisInterface
{
    #[Override]
    public function __invoke(RegistrationInterface $registration, ?SimpleXMLElement $config = null): void
    {
        $registration->registerHooksFromClass(self::class);
    }

    #[Override]
    public static function afterMethodCallAnalysis(AfterMethodCallAnalysisEvent $event): void
    {
        $expr = $event->getExpr();
        if (
            $expr instanceof StaticCall
            && $expr->class->getAttribute('resolvedName') === Asserted::class
        ) {
            $firstArg = $expr->args[0];
            $firstArgType = $event->getStatementsSource()->getNodeTypeProvider()->getType($firstArg->value);
            if (null !== $firstArgType) {
                switch ($expr->name->name) {
                    case 'notNull':
                        if (!$firstArgType->hasMixed() && !$firstArgType->hasNull()) {
                            IssueBuffer::accepts(
                                new RedundantCondition(
                                    'The value of type ' . $firstArgType . ' is not nullable, so the Asserted::notNull call is redundant.',
                                    new CodeLocation($event->getStatementsSource(), $expr),
                                    null
                                ),
                                $event->getStatementsSource()->getSuppressedIssues()
                            );
                        }
                        break;
                    case 'string':
                        if ($firstArgType->isString() && !$firstArgType->hasNull()) {
                            IssueBuffer::accepts(
                                new RedundantCondition(
                                    'The value of type ' . $firstArgType . ' is always string, so the Asserted::string call is redundant.',
                                    new CodeLocation($event->getStatementsSource(), $expr),
                                    null
                                ),
                                $event->getStatementsSource()->getSuppressedIssues()
                            );
                        }
                        break;
                    case 'stringOrNull':
                        if ($firstArgType->isString() || $firstArgType->isNull()) {
                            IssueBuffer::accepts(
                                new RedundantCondition(
                                    'The value of type ' . $firstArgType . ' is always string or null, so the Asserted::stringOrNull call is redundant.',
                                    new CodeLocation($event->getStatementsSource(), $expr),
                                    null
                                ),
                                $event->getStatementsSource()->getSuppressedIssues()
                            );
                        }
                        break;
                    case 'int':
                        if ($firstArgType->isInt() && !$firstArgType->hasNull()) {
                            IssueBuffer::accepts(
                                new RedundantCondition(
                                    'The value of type ' . $firstArgType . ' is always int, so the Asserted::int call is redundant.',
                                    new CodeLocation($event->getStatementsSource(), $expr),
                                    null
                                ),
                                $event->getStatementsSource()->getSuppressedIssues()
                            );
                        }
                        break;
                    case 'intOrNull':
                        if ($firstArgType->isInt() || $firstArgType->isNull()) {
                            IssueBuffer::accepts(
                                new RedundantCondition(
                                    'The value of type ' . $firstArgType . ' is always int or null, so the Asserted::intOrNull call is redundant.',
                                    new CodeLocation($event->getStatementsSource(), $expr),
                                    null
                                ),
                                $event->getStatementsSource()->getSuppressedIssues()
                            );
                        }
                        break;
                    case 'float':
                        if ($firstArgType->isFloat() && !$firstArgType->hasNull()) {
                            IssueBuffer::accepts(
                                new RedundantCondition(
                                    'The value of type ' . $firstArgType . ' is always int, so the Asserted::float call is redundant.',
                                    new CodeLocation($event->getStatementsSource(), $expr),
                                    null
                                ),
                                $event->getStatementsSource()->getSuppressedIssues()
                            );
                        }
                        break;
                    case 'floatOrNull':
                        if ($firstArgType->isFloat() || $firstArgType->isNull()) {
                            IssueBuffer::accepts(
                                new RedundantCondition(
                                    'The value of type ' . $firstArgType . ' is always int or null, so the Asserted::floatOrNull call is redundant.',
                                    new CodeLocation($event->getStatementsSource(), $expr),
                                    null
                                ),
                                $event->getStatementsSource()->getSuppressedIssues()
                            );
                        }
                        break;
                    case 'bool':
                        if ($firstArgType->isBool() && !$firstArgType->hasNull()) {
                            IssueBuffer::accepts(
                                new RedundantCondition(
                                    'The value of type ' . $firstArgType . ' is always int, so the Asserted::bool call is redundant.',
                                    new CodeLocation($event->getStatementsSource(), $expr),
                                    null
                                ),
                                $event->getStatementsSource()->getSuppressedIssues()
                            );
                        }
                        break;
                    case 'boolOrNull':
                        if ($firstArgType->isBool() || $firstArgType->isNull()) {
                            IssueBuffer::accepts(
                                new RedundantCondition(
                                    'The value of type ' . $firstArgType . ' is always int or null, so the Asserted::boolOrNull call is redundant.',
                                    new CodeLocation($event->getStatementsSource(), $expr),
                                    null
                                ),
                                $event->getStatementsSource()->getSuppressedIssues()
                            );
                        }
                        break;
                }
            }
        }
    }
}
