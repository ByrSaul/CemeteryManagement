<?php

namespace CemeteryManagement\Contracts\Repositories;

use CemeteryManagement\Entities\AbstractEntity;
use CemeteryManagement\Exceptions\NotFoundException;
use CemeteryManagement\ValueObjects\Collections\PaginatedEntityCollection;
use CemeteryManagement\ValueObjects\Data\FiltersInfo;

/**
 * Abstract contract for repositories of single-key entities
 *
 * @package Proaktiv
 */
interface AbstractSpecificRevisionRepository extends AbstractRepository
{
    /**
     * Returns an entity from the repository, handled by its id
     *
     * @param   mixed  $entityId  Entity Id to find
     *
     * @return  AbstractEntity
     * @throws  NotFoundException
     */
    public function get(mixed $entityId): AbstractEntity;

    /**
     * Returns a AQL PT Revision entity finding it by its AQL PT Revision Id
     *
     * @param   int      $id                    AQL PT Revision Id
     *
     * @return  AbstractEntity
     * @throws  InvalidArgumentException
     */
    public function getById(int $id): ?AbstractEntity;

    /**
     * Returns a AQL PT Revision entity finding it by its AQL PT Revision Id
     *
     * @param   int      $aqlRevisionId        AQL Revision Id
     *
     * @return  AbstractEntity
     * @throws  InvalidArgumentException
     */
    public function getByAqlRevisionId(int $aqlRevisionId): ?AbstractEntity;

    /**
     * Return a AQL PT Revision entity finding by its AQL Revision Id
     *
     * @param   int      $aqlRevisionId        AQL Revision Id
     * @return AbstractEntity|null
     */
    public function getSpecificRevisionByAqlRevisionId(int $aqlRevisionId): ?AbstractEntity;

    /**
     * Retrieves paginated entity records from the system for AQL Revision PT
     *
     * Pagination information will be attached to retrieved Collection.
     *
     * @param   string        $partial   Partial AQL Revision PT entity
     * @param   string        $orderBy   Field used in the record ordering of the Collection.
     * @param   int           $perPage   Listed items per page.
     * @param   int           $page      Page number to be retrieved.
     * @param   bool          $reversed  If the Field ordering of the Collection should be reversed.
     * @param   FiltersInfo  $filters   Filters for the pagination.
     *
     * @return PaginatedEntityCollection
     */
    public function listPaginatedRevisions(
        string $partial,
        string $orderBy,
        int $perPage,
        int $page = 1,
        bool $reversed = false,
        ?FiltersInfo $filters = null
    ): PaginatedEntityCollection;
}
