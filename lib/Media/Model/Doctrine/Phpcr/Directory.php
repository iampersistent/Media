<?php

namespace Media\Model\Doctrine\Phpcr;

use Doctrine\Common\Collections\ArrayCollection;
use Media\DirectoryInterface;
use Media\HierarchyInterface;
use Media\Entity\BaseMedia;

class Directory extends BaseMedia implements DirectoryInterface
{
    /**
     * @var Object $parent
     */
    protected $parent;

    /**
     * @var HierarchyInterface[] $children
     */
    protected $children;

    public function __construct($name = null)
    {
        $this->children = new ArrayCollection();
    }

    /**
     * @param mixed $parent
     */
    public function setParent($parent)
    {
        $this->parent = $parent;

        if ($parent instanceof Directory) {
            $parent->addChild($this);
        }
    }

    /**
     * @return mixed
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Returns the contents of this directory.
     *
     * @return HierarchyInterface[]
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Add a child to this directory
     *
     * @param HierarchyInterface $child
     */
    public function addChild(HierarchyInterface $child)
    {
        $this->children->add($child);
    }
}
