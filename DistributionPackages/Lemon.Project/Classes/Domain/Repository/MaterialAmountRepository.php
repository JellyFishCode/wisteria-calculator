<?php

namespace Lemon\Project\Domain\Repository;

/*
 * This file is part of the Lemon.Project package.
 */

use Lemon\Project\Domain\Model\ContributionPointsEntry;
use Lemon\Project\Domain\Model\Material;
use Neos\Flow\Annotations as Flow;
use Neos\Flow\Persistence\QueryResultInterface;
use Neos\Flow\Persistence\Repository;

/**
 * @Flow\Scope("singleton")
 */
class MaterialAmountRepository extends Repository
{
    public function findByContributionPointsEntryAndMaterial(
        ContributionPointsEntry $contributionPointsEntry,
        Material $material
    ): QueryResultInterface {
        $query = $this->createQuery();
        $query->matching(
            $query->logicalAnd(
                $query->equals('contributionPointsEntry', $contributionPointsEntry),
                $query->equals('material', $material)
            )
        );
        return $query->execute();
    }
}
