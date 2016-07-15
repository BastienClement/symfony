<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Serializer\Mapping;

/**
 * {@inheritdoc}
 *
 * @author Kévin Dunglas <dunglas@gmail.com>
 */
class AttributeMetadata implements AttributeMetadataInterface
{
    /**
     * @internal This property is public in order to reduce the size of the
     *           class' serialized representation. Do not access it. Use
     *           {@link getName()} instead.
     */
    public $name;

    /**
     * @var string
     *
     * @internal This property is public in order to reduce the size of the
     *           class' serialized representation. Do not access it. Use
     *           {@link getGroups()} instead.
     */
    public $accessorGetter;

    /**
     * @var string
     *
     * @internal This property is public in order to reduce the size of the
     *           class' serialized representation. Do not access it. Use
     *           {@link getGroups()} instead.
     */
    public $accessorSetter;

    /**
     * @var bool
     *
     * @internal This property is public in order to reduce the size of the
     *           class' serialized representation. Do not access it. Use
     *           {@link getGroups()} instead.
     */
    public $exclude;

    /**
     * @var bool
     *
     * @internal This property is public in order to reduce the size of the
     *           class' serialized representation. Do not access it. Use
     *           {@link getGroups()} instead.
     */
    public $expose;

    /**
     * @internal This property is public in order to reduce the size of the
     *           class' serialized representation. Do not access it. Use
     *           {@link getGroups()} instead.
     */
    public $groups = array();

    /**
     * @var int|null
     *
     * @internal This property is public in order to reduce the size of the
     *           class' serialized representation. Do not access it. Use
     *           {@link getMaxDepth()} instead.
     */
    public $maxDepth;

    /**
     * @var bool
     *
     * @internal This property is public in order to reduce the size of the
     *           class' serialized representation. Do not access it. Use
     *           {@link getGroups()} instead.
     */
    public $readOnly;

    /**
     * @var string
     *
     * @internal This property is public in order to reduce the size of the
     *           class' serialized representation. Do not access it. Use
     *           {@link getGroups()} instead.
     */
    public $serializedName;

    /**
     * @var string
     *
     * @internal This property is public in order to reduce the size of the
     *           class' serialized representation. Do not access it. Use
     *           {@link getGroups()} instead.
     */
    public $type;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getAccessorGetter()
    {
        return $this->accessorGetter;
    }

    /**
     * @param string $accessorGetter
     *
     * @return AttributeMetadata
     */
    public function setAccessorGetter($accessorGetter)
    {
        $this->accessorGetter = $accessorGetter;

        return $this;
    }

    /**
     * @return string
     */
    public function getAccessorSetter()
    {
        return $this->accessorSetter;
    }

    /**
     * @param string $accessorSetter
     *
     * @return AttributeMetadata
     */
    public function setAccessorSetter($accessorSetter)
    {
        $this->accessorSetter = $accessorSetter;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getExclude()
    {
        return $this->exclude;
    }

    /**
     * @param boolean $exclude
     *
     * @return AttributeMetadata
     */
    public function setExclude($exclude)
    {
        $this->exclude = $exclude;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getExpose()
    {
        return $this->expose;
    }

    /**
     * @param boolean $expose
     *
     * @return AttributeMetadata
     */
    public function setExpose($expose)
    {
        $this->expose = $expose;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function addGroup($group)
    {
        if (!\in_array($group, $this->groups)) {
            $this->groups[] = $group;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * {@inheritdoc}
     */
    public function setMaxDepth($maxDepth)
    {
        $this->maxDepth = $maxDepth;
    }

    /**
     * {@inheritdoc}
     */
    public function getMaxDepth()
    {
        return $this->maxDepth;
    }

    /**
     * @return boolean
     */
    public function getReadOnly()
    {
        return $this->readOnly;
    }

    /**
     * @param boolean $readOnly
     *
     * @return AttributeMetadata
     */
    public function setReadOnly($readOnly)
    {
        $this->readOnly = $readOnly;

        return $this;
    }

    /**
     * @return string
     */
    public function getSerializedName()
    {
        return $this->serializedName;
    }

    /**
     * @param string $serializedName
     *
     * @return AttributeMetadata
     */
    public function setSerializedName($serializedName)
    {
        $this->serializedName = $serializedName;

        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return AttributeMetadata
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function merge(AttributeMetadataInterface $attributeMetadata)
    {
        foreach ($attributeMetadata->getGroups() as $group) {
            $this->addGroup($group);
        }

        // Overwrite only if not defined
        if (null === $this->accessorGetter) {
            $this->accessorGetter = $attributeMetadata->getAccessorGetter();
        }
        if (null === $this->accessorSetter) {
            $this->accessorSetter = $attributeMetadata->getAccessorSetter();
        }
        if (null === $this->exclude) {
            $this->exclude = $attributeMetadata->getExclude();
        }
        if (null === $this->expose) {
            $this->expose = $attributeMetadata->getExpose();
        }
        if (null === $this->maxDepth) {
            $this->maxDepth = $attributeMetadata->getMaxDepth();
        }
        if (null === $this->readOnly) {
            $this->readOnly = $attributeMetadata->getReadOnly();
        }
        if (null === $this->serializedName) {
            $this->serializedName = $attributeMetadata->getSerializedName();
        }
        if (null === $this->type) {
            $this->type = $attributeMetadata->getType();
        }
    }

    /**
     * Returns the names of the properties that should be serialized.
     *
     * @return string[]
     */
    public function __sleep()
    {
        return array(
            'name',
            'accessorGetter',
            'accessorSetter',
            'exclude',
            'expose',
            'groups',
            'maxDepth',
            'readOnly',
            'serializedName',
            'type',
        );
    }
}
