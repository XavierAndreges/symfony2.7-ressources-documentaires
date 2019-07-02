<?php

namespace DocBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * WorkRepository.
 */
class WorkRepository extends EntityRepository
{
	 /**
     * Get every work
     *
     * @return array
     */
    public function getWorks()
    {
        $qb = $this->createQueryBuilder('r');

        return $qb->getQuery()->getResult();
    }

    /**
     * Get work with workType
     *
     * @return array
     */
    public function getWorksWithWorkType($workType)
    {
        $qb = $this->createQueryBuilder('r')
        -> where ('r.workType = :workType')
        -> setParameter('workType', $workType);

        return $qb->getQuery()->getResult();
    }

    /**
     * Get work with techno
     *
     * @return array
     */
    public function getWorksWithTechno($techno)
    {
        $qb = $this->createQueryBuilder('r')
        -> where (':techno MEMBER OF r.technos')
        -> setParameter('techno', $techno);

        return $qb->getQuery()->getResult();
    }

    /**
     * Get work with criteria
     *
     * @return array
     */
    public function getWorksWithCriteria(array $criteria, $dateOrder)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb ->select('w')
            ->from('DocBundle:Work', 'w');

        if ($dateOrder !== null) {
           $qb  ->orderBy('w.dateStart', $dateOrder);
        } else {
					$qb  ->orderBy('w.id', "DESC");
				}

        if ($criteria['workType'] !== null) {
            $qb -> where ('w.workType = :workType')
                -> setParameter('workType', $criteria['workType']);
        }

        if ($criteria['techno'] !== null) {
            $qb -> andWhere(':techno MEMBER OF w.technos')
                -> setParameter('techno', $criteria['techno']);
        }

        return $qb->getQuery()->getResult();
    }

}
