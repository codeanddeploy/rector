<?php

declare (strict_types=1);
namespace Rector\Php82\Rector\Class_;

use PhpParser\Node;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\Property;
use Rector\Core\NodeAnalyzer\ClassAnalyzer;
use Rector\Core\Rector\AbstractRector;
use Rector\Core\ValueObject\MethodName;
use Rector\Core\ValueObject\PhpVersionFeature;
use Rector\Core\ValueObject\Visibility;
use Rector\Php80\NodeAnalyzer\PhpAttributeAnalyzer;
use Rector\Privatization\NodeManipulator\VisibilityManipulator;
use Rector\VersionBonding\Contract\MinPhpVersionInterface;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;
/**
 * @changelog https://wiki.php.net/rfc/readonly_classes
 *
 * @see \Rector\Tests\Php82\Rector\Class_\ReadOnlyClassRector\ReadOnlyClassRectorTest
 */
final class ReadOnlyClassRector extends \Rector\Core\Rector\AbstractRector implements \Rector\VersionBonding\Contract\MinPhpVersionInterface
{
    /**
     * @var string
     */
    private const ATTRIBUTE = 'AllowDynamicProperties';
    /**
     * @readonly
     * @var \Rector\Core\NodeAnalyzer\ClassAnalyzer
     */
    private $classAnalyzer;
    /**
     * @readonly
     * @var \Rector\Privatization\NodeManipulator\VisibilityManipulator
     */
    private $visibilityManipulator;
    /**
     * @readonly
     * @var \Rector\Php80\NodeAnalyzer\PhpAttributeAnalyzer
     */
    private $phpAttributeAnalyzer;
    public function __construct(\Rector\Core\NodeAnalyzer\ClassAnalyzer $classAnalyzer, \Rector\Privatization\NodeManipulator\VisibilityManipulator $visibilityManipulator, \Rector\Php80\NodeAnalyzer\PhpAttributeAnalyzer $phpAttributeAnalyzer)
    {
        $this->classAnalyzer = $classAnalyzer;
        $this->visibilityManipulator = $visibilityManipulator;
        $this->phpAttributeAnalyzer = $phpAttributeAnalyzer;
    }
    public function getRuleDefinition() : \Symplify\RuleDocGenerator\ValueObject\RuleDefinition
    {
        return new \Symplify\RuleDocGenerator\ValueObject\RuleDefinition('Decorate read-only class with `readonly` attribute', [new \Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample(<<<'CODE_SAMPLE'
final class SomeClass
{
    public function __construct(
        private readonly string $name
    ) {
    }
}
CODE_SAMPLE
, <<<'CODE_SAMPLE'
final readonly class SomeClass
{
    public function __construct(
        private string $name
    ) {
    }
}
CODE_SAMPLE
)]);
    }
    /**
     * @return array<class-string<Node>>
     */
    public function getNodeTypes() : array
    {
        return [\PhpParser\Node\Stmt\Class_::class];
    }
    /**
     * @param Class_ $node
     */
    public function refactor(\PhpParser\Node $node) : ?\PhpParser\Node
    {
        if ($this->shouldSkip($node)) {
            return null;
        }
        $this->visibilityManipulator->makeReadonly($node);
        $constructClassMethod = $node->getMethod(\Rector\Core\ValueObject\MethodName::CONSTRUCT);
        if ($constructClassMethod instanceof \PhpParser\Node\Stmt\ClassMethod) {
            foreach ($constructClassMethod->getParams() as $param) {
                $this->visibilityManipulator->removeReadonly($param);
            }
        }
        foreach ($node->getProperties() as $property) {
            $this->visibilityManipulator->removeReadonly($property);
        }
        return $node;
    }
    public function provideMinPhpVersion() : int
    {
        return \Rector\Core\ValueObject\PhpVersionFeature::READONLY_CLASS;
    }
    private function shouldSkip(\PhpParser\Node\Stmt\Class_ $class) : bool
    {
        // need to have test fixture once feature added to  nikic/PHP-Parser
        if ($this->visibilityManipulator->hasVisibility($class, \Rector\Core\ValueObject\Visibility::READONLY)) {
            return \true;
        }
        if ($this->classAnalyzer->isAnonymousClass($class)) {
            return \true;
        }
        if (!$class->isFinal()) {
            return \true;
        }
        if ($this->phpAttributeAnalyzer->hasPhpAttribute($class, self::ATTRIBUTE)) {
            return \true;
        }
        $properties = $class->getProperties();
        if ($this->hasWritableProperty($properties)) {
            return \true;
        }
        $constructClassMethod = $class->getMethod(\Rector\Core\ValueObject\MethodName::CONSTRUCT);
        if (!$constructClassMethod instanceof \PhpParser\Node\Stmt\ClassMethod) {
            // no __construct means no property promotion, skip if class has no property defined
            return $properties === [];
        }
        $params = $constructClassMethod->getParams();
        if ($params === []) {
            // no params means no property promotion, skip if class has no property defined
            return $properties === [];
        }
        foreach ($params as $param) {
            // has non-property promotion, skip
            if (!$this->visibilityManipulator->hasVisibility($param, \Rector\Core\ValueObject\Visibility::READONLY)) {
                return \true;
            }
        }
        return \false;
    }
    /**
     * @param Property[] $properties
     */
    private function hasWritableProperty(array $properties) : bool
    {
        foreach ($properties as $property) {
            if (!$property->isReadonly()) {
                return \true;
            }
        }
        return \false;
    }
}
