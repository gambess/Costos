<?php

namespace Costo\SystemBundle\Model\om;

use \Criteria;
use \Exception;
use \ModelCriteria;
use \ModelJoin;
use \PDO;
use \Propel;
use \PropelCollection;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use Costo\SystemBundle\Model\Cuenta;
use Costo\SystemBundle\Model\CuentaPeer;
use Costo\SystemBundle\Model\CuentaQuery;
use Costo\SystemBundle\Model\Gasto;

/**
 * Base class that represents a query for the 'cuenta' table.
 *
 *
 *
 * @method CuentaQuery orderByIdCuenta($order = Criteria::ASC) Order by the id_cuenta column
 * @method CuentaQuery orderByNombreCuenta($order = Criteria::ASC) Order by the nombre_cuenta column
 * @method CuentaQuery orderByValorCuenta($order = Criteria::ASC) Order by the valor_cuenta column
 * @method CuentaQuery orderByTipoCuenta($order = Criteria::ASC) Order by the tipo_cuenta column
 * @method CuentaQuery orderByUserCreaCuenta($order = Criteria::ASC) Order by the user_crea_cuenta column
 * @method CuentaQuery orderByFechaCreacionCuenta($order = Criteria::ASC) Order by the fecha_creacion_cuenta column
 * @method CuentaQuery orderByFechaModificacionCuenta($order = Criteria::ASC) Order by the fecha_modificacion_cuenta column
 *
 * @method CuentaQuery groupByIdCuenta() Group by the id_cuenta column
 * @method CuentaQuery groupByNombreCuenta() Group by the nombre_cuenta column
 * @method CuentaQuery groupByValorCuenta() Group by the valor_cuenta column
 * @method CuentaQuery groupByTipoCuenta() Group by the tipo_cuenta column
 * @method CuentaQuery groupByUserCreaCuenta() Group by the user_crea_cuenta column
 * @method CuentaQuery groupByFechaCreacionCuenta() Group by the fecha_creacion_cuenta column
 * @method CuentaQuery groupByFechaModificacionCuenta() Group by the fecha_modificacion_cuenta column
 *
 * @method CuentaQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method CuentaQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method CuentaQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method CuentaQuery leftJoinGasto($relationAlias = null) Adds a LEFT JOIN clause to the query using the Gasto relation
 * @method CuentaQuery rightJoinGasto($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Gasto relation
 * @method CuentaQuery innerJoinGasto($relationAlias = null) Adds a INNER JOIN clause to the query using the Gasto relation
 *
 * @method Cuenta findOne(PropelPDO $con = null) Return the first Cuenta matching the query
 * @method Cuenta findOneOrCreate(PropelPDO $con = null) Return the first Cuenta matching the query, or a new Cuenta object populated from the query conditions when no match is found
 *
 * @method Cuenta findOneByNombreCuenta(string $nombre_cuenta) Return the first Cuenta filtered by the nombre_cuenta column
 * @method Cuenta findOneByValorCuenta(double $valor_cuenta) Return the first Cuenta filtered by the valor_cuenta column
 * @method Cuenta findOneByTipoCuenta(string $tipo_cuenta) Return the first Cuenta filtered by the tipo_cuenta column
 * @method Cuenta findOneByUserCreaCuenta(string $user_crea_cuenta) Return the first Cuenta filtered by the user_crea_cuenta column
 * @method Cuenta findOneByFechaCreacionCuenta(string $fecha_creacion_cuenta) Return the first Cuenta filtered by the fecha_creacion_cuenta column
 * @method Cuenta findOneByFechaModificacionCuenta(string $fecha_modificacion_cuenta) Return the first Cuenta filtered by the fecha_modificacion_cuenta column
 *
 * @method array findByIdCuenta(int $id_cuenta) Return Cuenta objects filtered by the id_cuenta column
 * @method array findByNombreCuenta(string $nombre_cuenta) Return Cuenta objects filtered by the nombre_cuenta column
 * @method array findByValorCuenta(double $valor_cuenta) Return Cuenta objects filtered by the valor_cuenta column
 * @method array findByTipoCuenta(string $tipo_cuenta) Return Cuenta objects filtered by the tipo_cuenta column
 * @method array findByUserCreaCuenta(string $user_crea_cuenta) Return Cuenta objects filtered by the user_crea_cuenta column
 * @method array findByFechaCreacionCuenta(string $fecha_creacion_cuenta) Return Cuenta objects filtered by the fecha_creacion_cuenta column
 * @method array findByFechaModificacionCuenta(string $fecha_modificacion_cuenta) Return Cuenta objects filtered by the fecha_modificacion_cuenta column
 *
 * @package    propel.generator.src.Costo.SystemBundle.Model.om
 */
abstract class BaseCuentaQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseCuentaQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'testing', $modelName = 'Costo\\SystemBundle\\Model\\Cuenta', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new CuentaQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   CuentaQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return CuentaQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof CuentaQuery) {
            return $criteria;
        }
        $query = new CuentaQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return   Cuenta|Cuenta[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = CuentaPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(CuentaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Alias of findPk to use instance pooling
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 Cuenta A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneByIdCuenta($key, $con = null)
     {
        return $this->findPk($key, $con);
     }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 Cuenta A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id_cuenta`, `nombre_cuenta`, `valor_cuenta`, `tipo_cuenta`, `user_crea_cuenta`, `fecha_creacion_cuenta`, `fecha_modificacion_cuenta` FROM `cuenta` WHERE `id_cuenta` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new Cuenta();
            $obj->hydrate($row);
            CuentaPeer::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return Cuenta|Cuenta[]|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|Cuenta[]|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($stmt);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return CuentaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CuentaPeer::ID_CUENTA, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return CuentaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CuentaPeer::ID_CUENTA, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id_cuenta column
     *
     * Example usage:
     * <code>
     * $query->filterByIdCuenta(1234); // WHERE id_cuenta = 1234
     * $query->filterByIdCuenta(array(12, 34)); // WHERE id_cuenta IN (12, 34)
     * $query->filterByIdCuenta(array('min' => 12)); // WHERE id_cuenta >= 12
     * $query->filterByIdCuenta(array('max' => 12)); // WHERE id_cuenta <= 12
     * </code>
     *
     * @param     mixed $idCuenta The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CuentaQuery The current query, for fluid interface
     */
    public function filterByIdCuenta($idCuenta = null, $comparison = null)
    {
        if (is_array($idCuenta)) {
            $useMinMax = false;
            if (isset($idCuenta['min'])) {
                $this->addUsingAlias(CuentaPeer::ID_CUENTA, $idCuenta['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idCuenta['max'])) {
                $this->addUsingAlias(CuentaPeer::ID_CUENTA, $idCuenta['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CuentaPeer::ID_CUENTA, $idCuenta, $comparison);
    }

    /**
     * Filter the query on the nombre_cuenta column
     *
     * Example usage:
     * <code>
     * $query->filterByNombreCuenta('fooValue');   // WHERE nombre_cuenta = 'fooValue'
     * $query->filterByNombreCuenta('%fooValue%'); // WHERE nombre_cuenta LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nombreCuenta The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CuentaQuery The current query, for fluid interface
     */
    public function filterByNombreCuenta($nombreCuenta = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nombreCuenta)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $nombreCuenta)) {
                $nombreCuenta = str_replace('*', '%', $nombreCuenta);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CuentaPeer::NOMBRE_CUENTA, $nombreCuenta, $comparison);
    }

    /**
     * Filter the query on the valor_cuenta column
     *
     * Example usage:
     * <code>
     * $query->filterByValorCuenta(1234); // WHERE valor_cuenta = 1234
     * $query->filterByValorCuenta(array(12, 34)); // WHERE valor_cuenta IN (12, 34)
     * $query->filterByValorCuenta(array('min' => 12)); // WHERE valor_cuenta >= 12
     * $query->filterByValorCuenta(array('max' => 12)); // WHERE valor_cuenta <= 12
     * </code>
     *
     * @param     mixed $valorCuenta The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CuentaQuery The current query, for fluid interface
     */
    public function filterByValorCuenta($valorCuenta = null, $comparison = null)
    {
        if (is_array($valorCuenta)) {
            $useMinMax = false;
            if (isset($valorCuenta['min'])) {
                $this->addUsingAlias(CuentaPeer::VALOR_CUENTA, $valorCuenta['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($valorCuenta['max'])) {
                $this->addUsingAlias(CuentaPeer::VALOR_CUENTA, $valorCuenta['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CuentaPeer::VALOR_CUENTA, $valorCuenta, $comparison);
    }

    /**
     * Filter the query on the tipo_cuenta column
     *
     * Example usage:
     * <code>
     * $query->filterByTipoCuenta('fooValue');   // WHERE tipo_cuenta = 'fooValue'
     * $query->filterByTipoCuenta('%fooValue%'); // WHERE tipo_cuenta LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tipoCuenta The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CuentaQuery The current query, for fluid interface
     */
    public function filterByTipoCuenta($tipoCuenta = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tipoCuenta)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tipoCuenta)) {
                $tipoCuenta = str_replace('*', '%', $tipoCuenta);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CuentaPeer::TIPO_CUENTA, $tipoCuenta, $comparison);
    }

    /**
     * Filter the query on the user_crea_cuenta column
     *
     * Example usage:
     * <code>
     * $query->filterByUserCreaCuenta('fooValue');   // WHERE user_crea_cuenta = 'fooValue'
     * $query->filterByUserCreaCuenta('%fooValue%'); // WHERE user_crea_cuenta LIKE '%fooValue%'
     * </code>
     *
     * @param     string $userCreaCuenta The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CuentaQuery The current query, for fluid interface
     */
    public function filterByUserCreaCuenta($userCreaCuenta = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($userCreaCuenta)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $userCreaCuenta)) {
                $userCreaCuenta = str_replace('*', '%', $userCreaCuenta);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CuentaPeer::USER_CREA_CUENTA, $userCreaCuenta, $comparison);
    }

    /**
     * Filter the query on the fecha_creacion_cuenta column
     *
     * Example usage:
     * <code>
     * $query->filterByFechaCreacionCuenta('2011-03-14'); // WHERE fecha_creacion_cuenta = '2011-03-14'
     * $query->filterByFechaCreacionCuenta('now'); // WHERE fecha_creacion_cuenta = '2011-03-14'
     * $query->filterByFechaCreacionCuenta(array('max' => 'yesterday')); // WHERE fecha_creacion_cuenta > '2011-03-13'
     * </code>
     *
     * @param     mixed $fechaCreacionCuenta The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CuentaQuery The current query, for fluid interface
     */
    public function filterByFechaCreacionCuenta($fechaCreacionCuenta = null, $comparison = null)
    {
        if (is_array($fechaCreacionCuenta)) {
            $useMinMax = false;
            if (isset($fechaCreacionCuenta['min'])) {
                $this->addUsingAlias(CuentaPeer::FECHA_CREACION_CUENTA, $fechaCreacionCuenta['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fechaCreacionCuenta['max'])) {
                $this->addUsingAlias(CuentaPeer::FECHA_CREACION_CUENTA, $fechaCreacionCuenta['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CuentaPeer::FECHA_CREACION_CUENTA, $fechaCreacionCuenta, $comparison);
    }

    /**
     * Filter the query on the fecha_modificacion_cuenta column
     *
     * Example usage:
     * <code>
     * $query->filterByFechaModificacionCuenta('2011-03-14'); // WHERE fecha_modificacion_cuenta = '2011-03-14'
     * $query->filterByFechaModificacionCuenta('now'); // WHERE fecha_modificacion_cuenta = '2011-03-14'
     * $query->filterByFechaModificacionCuenta(array('max' => 'yesterday')); // WHERE fecha_modificacion_cuenta > '2011-03-13'
     * </code>
     *
     * @param     mixed $fechaModificacionCuenta The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CuentaQuery The current query, for fluid interface
     */
    public function filterByFechaModificacionCuenta($fechaModificacionCuenta = null, $comparison = null)
    {
        if (is_array($fechaModificacionCuenta)) {
            $useMinMax = false;
            if (isset($fechaModificacionCuenta['min'])) {
                $this->addUsingAlias(CuentaPeer::FECHA_MODIFICACION_CUENTA, $fechaModificacionCuenta['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fechaModificacionCuenta['max'])) {
                $this->addUsingAlias(CuentaPeer::FECHA_MODIFICACION_CUENTA, $fechaModificacionCuenta['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CuentaPeer::FECHA_MODIFICACION_CUENTA, $fechaModificacionCuenta, $comparison);
    }

    /**
     * Filter the query by a related Gasto object
     *
     * @param   Gasto|PropelObjectCollection $gasto  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 CuentaQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByGasto($gasto, $comparison = null)
    {
        if ($gasto instanceof Gasto) {
            return $this
                ->addUsingAlias(CuentaPeer::ID_CUENTA, $gasto->getFkCuenta(), $comparison);
        } elseif ($gasto instanceof PropelObjectCollection) {
            return $this
                ->useGastoQuery()
                ->filterByPrimaryKeys($gasto->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByGasto() only accepts arguments of type Gasto or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Gasto relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return CuentaQuery The current query, for fluid interface
     */
    public function joinGasto($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Gasto');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Gasto');
        }

        return $this;
    }

    /**
     * Use the Gasto relation Gasto object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Costo\SystemBundle\Model\GastoQuery A secondary query class using the current class as primary query
     */
    public function useGastoQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinGasto($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Gasto', '\Costo\SystemBundle\Model\GastoQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Cuenta $cuenta Object to remove from the list of results
     *
     * @return CuentaQuery The current query, for fluid interface
     */
    public function prune($cuenta = null)
    {
        if ($cuenta) {
            $this->addUsingAlias(CuentaPeer::ID_CUENTA, $cuenta->getIdCuenta(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     CuentaQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(CuentaPeer::FECHA_MODIFICACION_CUENTA, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     CuentaQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(CuentaPeer::FECHA_MODIFICACION_CUENTA);
    }

    /**
     * Order by update date asc
     *
     * @return     CuentaQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(CuentaPeer::FECHA_MODIFICACION_CUENTA);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     CuentaQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(CuentaPeer::FECHA_CREACION_CUENTA, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     CuentaQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(CuentaPeer::FECHA_CREACION_CUENTA);
    }

    /**
     * Order by create date asc
     *
     * @return     CuentaQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(CuentaPeer::FECHA_CREACION_CUENTA);
    }
}
