<?php

namespace App\Model\Orm\Facade;

use App\Entity\BaseEntity;
use Nettrine\DBAL\DI\DbalExtension;


abstract class BaseFacade
{
	protected $fulltextProperties = [];
    private $entityManager;

    /**
	 * @param BaseEntity $entity
	 * @param bool $flush
	 *
	 * @return $this
	 */
	public function persist(BaseEntity $entity, $flush = TRUE) {
		$this->entityManager->persist($entity);
		if ($flush) {
			$this->entityManager->flush($entity);
		}
		return $this;
	}

    /**
     * @throws \Doctrine\ORM\OptimisticLockException
     */
	public function flush()
    {
        $this->entityManager->flush();
    }
	
	/**
	 * Default method for obtaining entities for Entity Collection
	 * @param array $args
	 * @return array
	 */
	public function entityCollectionResults($args): array
    {
		return $this->datatableWhere($args)->createQuery()->getResult();
	}
	
	/**
	 * Formats property with possible alias
	 * @param string $property
	 * @param string $alias
	 * @return string
	 */
	protected function formatProperty($property, $alias = NULL) {
		if (strpos($property, '.') !== FALSE) {
			return $property;
		}
		return ($alias !== NULL ? $alias . '.' : '') . $property;
	}
	
	/**
	 * Method for creating array of where conditions
	 * @param array $args
	 * @param string $alias
	 * @return array
	 */
	protected function createAndWhere($args, $alias = NULL): array
    {
		return [];
	}
	
	/**
	 * Method for creating array of mandatory where conditions used on every datatable query
	 * @param array $args
	 * @param string $alias
	 * @return array
	 */
	protected function createMandatoryAndWhere($args, $alias = NULL) {
		return [];
	}
	
	/**
	 * Method for creating array of fulltext where conditions
	 * @param array $args
	 * @param string $alias
	 * @return array
	 */
	protected function createOrWhere($args, $alias = NULL) {
		$where = [];
		foreach ($this->fulltextProperties as $prop) {
		    if(isset($args['fulltext'])){
                $where[$this->formatProperty($prop, $alias) . ' LIKE ?'] = "%{$args['fulltext']}%";
            }
		}
		return $where;
	}
	
	private function applyOrAndWhere(DqlSelection $selection, $args, $alias = NULL) {
		$or = $this->createOrWhere($args, $alias);
		if (!is_array($or)) {
			throw new InvalidArgumentException("Method 'createOrWhere' in class '" . get_called_class() . "' returned '" . gettype($or) . "' but array was expected.");
		}
		if (!empty($or)) {
			$selection->orWhere($or);
		}
		$and = $this->createAndWhere($args, $alias);
		if (!is_array($and)) {
			throw new InvalidArgumentException("Method 'createAndWhere' in class '" . get_called_class() . "' returned '" . gettype($and) . "' but array was expected.");
		}
		if (!empty($and)) {
			$selection->where($and);
		}
		return $this->applyMandatoryAndWhere($selection, $args, $alias);
	}
	
	private function applyMandatoryAndWhere(DqlSelection $selection, $args, $alias = NULL) {
		$and = $this->createMandatoryAndWhere($args, $alias);
		if (!is_array($and)) {
			throw new InvalidArgumentException("Method 'createMandatoryAndWhere' in class '" . get_called_class() . "' returned '" . gettype($and) . "' but array was expected.");
		}
		if (!empty($and)) {
			$selection->where($and);
		}
		return $selection;
	}
	
	/**
	 * Default method for obtaining a Datatable results count
	 * @param array $args
	 * @return integer
	 */
	public function datatableCount($args)
	{
		return $this->applyMandatoryAndWhere($this->createDatatableCountSelection($args, 'tbl'), $args, 'tbl')
				->createQuery()
				->getSingleScalarResult();
	}
	
	protected function createDatatableCountSelection($args, $alias = 'tbl')
	{
		return $this->entityManager
				->createSelection()
				->select('COUNT(tbl.id)')
				->from($this->repository->getClassName(), $alias);
	}


	/**
	 * Default method for obtaining entities for Datatable
	 * @param array $args
	 * @param array $format
	 * @return array
	 */
	public function datatableResults($args, $format)
	{
		$selection = $this->datatableWhere($args);
		if(isset($format['orderBy'])) {
			if ($selection instanceof DqlSelection) {
				$selection->order($format['orderBy'][0] . ' ' . (empty($format['orderBy'][1]) ? 'ASC' : $format['orderBy'][1]));
			} else {
				call_user_func_array([$selection, 'order'], $format['orderBy']);
			}
		}
		$query = $selection->createQuery();
		if(isset($format['limit'])) {
			$query->setMaxResults($format['limit']);
		}
		if(isset($format['offset'])) {
			$query->setFirstResult($format['offset']);
		}
		return $query->getResult();
	}
	
	/**
	 * Creates selection for dataable results
	 * @param array $args
	 * @return DqlSelection
	 */
	protected function datatableWhere($args)
	{
		return $this->applyOrAndWhere($this->repositorySelection('tbl'), $args, 'tbl');
	}
	
	/**
	 * @param string $alias
	 * @return DqlSelection
	 */
	protected function repositorySelection($alias) {
		return $this->repository->select($alias);
	}
	
}
