<?php
/**
 * Pimcore Api Platform Bundle
 *
 * LICENSE
 *
 * This source file is subject to the GNU General Public License version 3 (GPLv3)
 * For the full copyright and license information, please view the LICENSE.md and gpl-3.0.txt
 * files that are distributed with this source code.
 *
 * @copyright  Copyright (c) 2016-2019 w-vision AG (https://www.w-vision.ch)
 * @license    https://github.com/w-vision/DataDefinitions/blob/master/gpl-3.0.txt GNU General Public License version 3 (GPLv3)
 */

namespace Wvision\Bundle\PimcoreApiPlatformBundle\Bridge\Pimcore\Serializer;

use Pimcore\Model\DataObject\Fieldcollection\Data\AbstractData;
use Symfony\Component\Serializer\Mapping\ClassMetadataInterface;

class FieldCollectionDefinitionSerializerLoader extends AbstractDefinitionSerializerLoader
{
    public function loadClassMetadata(ClassMetadataInterface $classMetadata)
    {
        $class = $classMetadata->getName();

        if (!is_subclass_of($class, AbstractData::class)) {
            return $classMetadata;
        }

        $tempInstance = $classMetadata->getReflectionClass()->newInstanceWithoutConstructor();

        if (!$tempInstance instanceof AbstractData) {
            return $classMetadata;
        }

        return $this->loadFromDefinition($classMetadata, $tempInstance->getDefinition());
    }
}
