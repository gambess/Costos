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
use Costo\SystemBundle\Model\CuentaQuery;
use Costo\SystemBundle\Model\Gasto;
use Costo\SystemBundle\Model\GastoPeer;
use Costo\SystemBundle\Model\GastoQuery;

/**
 * Base class that represents a query for the 'gasto' table.
 *
 *
 *
 * @method GastoQuery orderByIdGasto($order = Criteria::ASC) Order by the id_gasto column
 * @method GastoQuery orderByFkCuenta($order = Criteria::ASC) Order by the fk_cuenta column
 * @method GastoQuery orderByNombreGasto($order = Criteria::ASC) Order by the nombre_gasto column
 * @method GastoQuery orderByCostoGasto($order = Criteria::ASC) Order by the costo_gasto column
 * @method GastoQuery orderByFechaEmisionGasto($order = Criteria::ASC) Order by the fecha_emision_gasto column
 * @method GastoQuery orderByFechaPagoGasto($order = Criteria::ASC) Order by the fecha_pago_gasto column
 * @method GastoQuery orderByNumeroDocGasto($order = Criteria::ASC) Order by the numero_doc_gasto column
 * @method GastoQuery orderByFechaCreacionGasto($order = Criteria::ASC) Order by the fecha_creacion_gasto column
 * @method GastoQuery orderByFechaModificacionGasto($order = Criteria::ASC) Order by the fecha_modificacion_gasto column
 *
 * @method GastoQuery groupByIdGasto() Group by the id_gasto column
 * @method GastoQuery groupByFkCuenta() Group by the fk_cuenta column
 * @method GastoQuery groupByNombreGasto() Group by the nombre_gasto column
 * @method GastoQuery groupByCostoGasto() Group by the costo_gasto column
 * @method GastoQuery groupByFechaEmisionGasto() Group by the fecha_emision_gasto column
 * @method GastoQuery groupByFechaPagoGasto() Group by the fecha_pago_gasto column
 * @method GastoQuery groupByNumeroDocGasto() Group by the numero_doc_gasto column
 * @method GastoQuery groupByFechaCreacionGasto() Group by the fecha_creacion_gasto column
 * @method GastoQuery groupByFechaModificacionGasto() Group by the fecha_modificacion_gasto column
 *
 * @method GastoQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method GastoQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method GastoQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method GastoQuery leftJoinCuenta($relationAlias = null) Adds a LEFT JOIN clause to the query using the Cuenta relation
 * @method GastoQuery rightJoinCuenta($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Cuenta relation
 * @method GastoQuery innerJoinCuenta($relationAlias = null) Adds a INNER JOIN clause to the query using the Cuenta relation
 *
 * @method Gasto findOne(PropelPDO $con = null) Return the first Gasto matching the query
 * @method Gasto findOneOrCreate(PropelPDO $con = null) Return the first Gasto matching the query, or a new Gasto object populated from the query conditions when no match is found
 *
 * @method Gasto findOneByFkCuenta(int $fk_cuenta) Return the first Gasto filtered by the fk_cuenta column
 * @method Gasto findOneByNombreGasto(string $nombre_gasto) Return the first Gasto filtered by the nombre_gasto column
 * @method Gasto findOneByCostoGasto(double $costo_gasto) Return the first Gasto filtered by the costo_gasto column
 * @method Gasto findOneByFechaEmisionGasto(string $fecha_emision_gasto) Return the first Gasto filtered by the fecha_emision_gasto column
 * @method Gasto findOneByFechaPagoGasto(string $fecha_pago_gasto) Return the first Gasto filtered by the fecha_pago_gasto column
 * @method Gasto findOneByNumeroDocGasto(string $numero_doc_gasto) Return the first Gasto filtered by the numero_doc_gasto column
 * @method Gasto findOneByFechaCreacionGasto(string $fecha_creacion_gasto) Return the first Gasto filtered by the fecha_creacion_gasto column
 * @method Gasto findOneByFechaModificacionGasto(string $fecha_modificacion_gasto) Return the first Gasto filtered by the fecha_modificacion_gasto column
 *
 * @method array findByIdGasto(int $id_gasto) Return Gasto objects filtered by the id_gasto column
 * @method array findByFkCuenta(int $fk_cuenta) Return Gasto objects filtered by the fk_cuenta column
 * @method array findByNombreGasto(string $nombre_gasto) Return Gasto objects filtered by the nombre_gasto column
 * @method array findByCostoGasto(double $costo_gasto) Return Gasto objects filtered by the costo_gasto column
 * @method array findByFechaEmisionGasto(string $fecha_emision_gasto) Return Gasto objects filtered by the fecha_emision_gasto column
 * @method array findByFechaPagoGasto(string $fecha_pago_gasto) Return Gasto objects filtered by the fecha_pago_gasto column
 * @method array findByNumeroDocGasto(string $numero_doc_gasto) Return Gasto objects filtered by the numero_doc_gasto column
 * @method array findByFechaCreacionGasto(string $fecha_creacion_gasto) Return Gasto objects filtered by the fecha_creacion_gasto column
 * @method array findByFechaModificacionGasto(string $fecha_modificacion_gasto) Return Gasto objects filtered by the fecha_modificacion_gasto column
 *
 * @package    propel.generator.src.Costo.SystemBundle.Model.om
 */
abstract class BaseGastoQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseGastoQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'testing', $modelName = 'Costo\\SystemBundle\\Model\\Gasto', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new GastoQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   GastoQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return GastoQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof GastoQuery) {
            return $criteria;
        }
        $query = new GastoQuery();
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
     * @return   Gasto|Gasto[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = GastoPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(GastoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Gasto A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneByIdGasto($key, $con = null)
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
     * @return                 Gasto A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id_gasto`, `fk_cuenta`, `nombre_gasto`, `costo_gasto`, `fecha_emision_gasto`, `fecha_pago_gasto`, `numero_doc_gasto`, `fecha_creacion_gasto`, `fecha_modificacion_gasto` FROM `gasto` WHERE `id_gasto` = :p0';
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
            $obj = new Gasto();
            $obj->hydrate($row);
            GastoPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Gasto|Gasto[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Gasto[]|mixed the list of results, formatted by the current formatter
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
     * @return GastoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(GastoPeer::ID_GASTO, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return GastoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(GastoPeer::ID_GASTO, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id_gasto column
     *
     * Example usage:
     * <code>
     * $query->filterByIdGasto(1234); // WHERE id_gasto = 1234
     * $query->filterByIdGasto(array(12, 34)); // WHERE id_gasto IN (12, 34)
     * $query->filterByIdGasto(array('min' => 12)); // WHERE id_gasto >= 12
     * $query->filterByIdGasto(array('max' => 12)); // WHERE id_gasto <= 12
     * </code>
     *
     * @param     mixed $idGasto The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return GastoQuery The current query, for fluid interface
     */
    public function filterByIdGasto($idGasto = null, $comparison = null)
    {
        if (is_array($idGasto)) {
            $useMinMax = false;
            if (isset($idGasto['min'])) {
                $this->addUsingAlias(GastoPeer::ID_GASTO, $idGasto['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idGasto['max'])) {
                $this->addUsingAlias(GastoPeer::ID_GASTO, $idGasto['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GastoPeer::ID_GASTO, $idGasto, $comparison);
    }

    /**
     * Filter the query on the fk_cuenta column
     *
     * Example usage:
     * <code>
     * $query->filterByFkCuenta(1234); // WHERE fk_cuenta = 1234
     * $query->filterByFkCuenta(array(12, 34)); // WHERE fk_cuenta IN (12, 34)
     * $query->filterByFkCuenta(array('min' => 12)); // WHERE fk_cuenta >= 12
     * $query->filterByFkCuenta(array('max' => 12)); // WHERE fk_cuenta <= 12
     * </code>
     *
     * @see       filterByCuenta()
     *
     * @param     mixed $fkCuenta The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return GastoQuery The current query, for fluid interface
     */
    public function filterByFkCuenta($fkCuenta = null, $comparison = null)
    {
        if (is_array($fkCuenta)) {
            $useMinMax = false;
            if (isset($fkCuenta['min'])) {
                $this->addUsingAlias(GastoPeer::FK_CUENTA, $fkCuenta['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkCuenta['max'])) {
                $this->addUsingAlias(GastoPeer::FK_CUENTA, $fkCuenta['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GastoPeer::FK_CUENTA, $fkCuenta, $comparison);
    }

    /**
     * Filter the query on the nombre_gasto column
     *
     * Example usage:
     * <code>
     * $query->filterByNombreGasto('fooValue');   // WHERE nombre_gasto = 'fooValue'
     * $query->filterByNombreGasto('%fooValue%'); // WHERE nombre_gasto LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nombreGasto The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return GastoQuery The current query, for fluid interface
     */
    public function filterByNombreGasto($nombreGasto = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nombreGasto)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $nombreGasto)) {
                $nombreGasto = str_replace('*', '%', $nombreGasto);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(GastoPeer::NOMBRE_GASTO, $nombreGasto, $comparison);
    }

    /**
     * Filter the query on the costo_gasto column
     *
     * Example usage:
     * <code>
     * $query->filterByCostoGasto(1234); // WHERE costo_gasto = 1234
     * $query->filterByCostoGasto(array(12, 34)); // WHERE costo_gasto IN (12, 34)
     * $query->filterByCostoGasto(array('min' => 12)); // WHERE costo_gasto >= 12
     * $query->filterByCostoGasto(array('max' => 12)); // WHERE costo_gasto <= 12
     * </code>
     *
     * @param     mixed $costoGasto The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return GastoQuery The current query, for fluid interface
     */
    public function filterByCostoGasto($costoGasto = null, $comparison = null)
    {
        if (is_array($costoGasto)) {
            $useMinMax = false;
            if (isset($costoGasto['min'])) {
                $this->addUsingAlias(GastoPeer::COSTO_GASTO, $costoGasto['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($costoGasto['max'])) {
                $this->addUsingAlias(GastoPeer::COSTO_GASTO, $costoGasto['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GastoPeer::COSTO_GASTO, $costoGasto, $comparison);
    }

    /**
     * Filter the query on the fecha_emision_gasto column
     *
     * Example usage:
     * <code>
     * $query->filterByFechaEmisionGasto('2011-03-14'); // WHERE fecha_emision_gasto = '2011-03-14'
     * $query->filterByFechaEmisionGasto('now'); // WHERE fecha_emision_gasto = '2011-03-14'
     * $query->filterByFechaEmisionGasto(array('max' => 'yesterday')); // WHERE fecha_emision_gasto > '2011-03-13'
     * </code>
     *
     * @param     mixed $fechaEmisionGasto The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return GastoQuery The current query, for fluid interface
     */
    public function filterByFechaEmisionGasto($fechaEmisionGasto = null, $comparison = null)
    {
        if (is_array($fechaEmisionGasto)) {
            $useMinMax = false;
            if (isset($fechaEmisionGasto['min'])) {
                $this->addUsingAlias(GastoPeer::FECHA_EMISION_GASTO, $fechaEmisionGasto['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fechaEmisionGasto['max'])) {
                $this->addUsingAlias(GastoPeer::FECHA_EMISION_GASTO, $fechaEmisionGasto['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GastoPeer::FECHA_EMISION_GASTO, $fechaEmisionGasto, $comparison);
    }

    /**
     * Filter the query on the fecha_pago_gasto column
     *
     * Example usage:
     * <code>
     * $query->filterByFechaPagoGasto('2011-03-14'); // WHERE fecha_pago_gasto = '2011-03-14'
     * $query->filterByFechaPagoGasto('now'); // WHERE fecha_pago_gasto = '2011-03-14'
     * $query->filterByFechaPagoGasto(array('max' => 'yesterday')); // WHERE fecha_pago_gasto > '2011-03-13'
     * </code>
     *
     * @param     mixed $fechaPagoGasto The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return GastoQuery The current query, for fluid interface
     */
    public function filterByFechaPagoGasto($fechaPagoGasto = null, $comparison = null)
    {
        if (is_array($fechaPagoGasto)) {
            $useMinMax = false;
            if (isset($fechaPagoGasto['min'])) {
                $this->addUsingAlias(GastoPeer::FECHA_PAGO_GASTO, $fechaPagoGasto['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fechaPagoGasto['max'])) {
                $this->addUsingAlias(GastoPeer::FECHA_PAGO_GASTO, $fechaPagoGasto['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GastoPeer::FECHA_PAGO_GASTO, $fechaPagoGasto, $comparison);
    }

    /**
     * Filter the query on the numero_doc_gasto column
     *
     * Example usage:
     * <code>
     * $query->filterByNumeroDocGasto('fooValue');   // WHERE numero_doc_gasto = 'fooValue'
     * $query->filterByNumeroDocGasto('%fooValue%'); // WHERE numero_doc_gasto LIKE '%fooValue%'
     * </code>
     *
     * @param     string $numeroDocGasto The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return GastoQuery The current query, for fluid interface
     */
    public function filterByNumeroDocGasto($numeroDocGasto = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($numeroDocGasto)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $numeroDocGasto)) {
                $numeroDocGasto = str_replace('*', '%', $numeroDocGasto);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(GastoPeer::NUMERO_DOC_GASTO, $numeroDocGasto, $comparison);
    }

    /**
     * Filter the query on the fecha_creacion_gasto column
     *
     * Example usage:
     * <code>
     * $query->filterByFechaCreacionGasto('2011-03-14'); // WHERE fecha_creacion_gasto = '2011-03-14'
     * $query->filterByFechaCreacionGasto('now'); // WHERE fecha_creacion_gasto = '2011-03-14'
     * $query->filterByFechaCreacionGasto(array('max' => 'yesterday')); // WHERE fecha_creacion_gasto > '2011-03-13'
     * </code>
     *
     * @param     mixed $fechaCreacionGasto The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return GastoQuery The current query, for fluid interface
     */
    public function filterByFechaCreacionGasto($fechaCreacionGasto = null, $comparison = null)
    {
        if (is_array($fechaCreacionGasto)) {
            $useMinMax = false;
            if (isset($fechaCreacionGasto['min'])) {
                $this->addUsingAlias(GastoPeer::FECHA_CREACION_GASTO, $fechaCreacionGasto['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fechaCreacionGasto['max'])) {
                $this->addUsingAlias(GastoPeer::FECHA_CREACION_GASTO, $fechaCreacionGasto['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GastoPeer::FECHA_CREACION_GASTO, $fechaCreacionGasto, $comparison);
    }

    /**
     * Filter the query on the fecha_modificacion_gasto column
     *
     * Example usage:
     * <code>
     * $query->filterByFechaModificacionGasto('2011-03-14'); // WHERE fecha_modificacion_gasto = '2011-03-14'
     * $query->filterByFechaModificacionGasto('now'); // WHERE fecha_modificacion_gasto = '2011-03-14'
     * $query->filterByFechaModificacionGasto(array('max' => 'yesterday')); // WHERE fecha_modificacion_gasto > '2011-03-13'
     * </code>
     *
     * @param     mixed $fechaModificacionGasto The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return GastoQuery The current query, for fluid interface
     */
    public function filterByFechaModificacionGasto($fechaModificacionGasto = null, $comparison = null)
    {
        if (is_array($fechaModificacionGasto)) {
            $useMinMax = false;
            if (isset($fechaModificacionGasto['min'])) {
                $this->addUsingAlias(GastoPeer::FECHA_MODIFICACION_GASTO, $fechaModificacionGasto['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fechaModificacionGasto['max'])) {
                $this->addUsingAlias(GastoPeer::FECHA_MODIFICACION_GASTO, $fechaModificacionGasto['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GastoPeer::FECHA_MODIFICACION_GASTO, $fechaModificacionGasto, $comparison);
    }

    /**
     * Filter the query by a related Cuenta object
     *
     * @param   Cuenta|PropelObjectCollection $cuenta The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 GastoQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByCuenta($cuenta, $comparison = null)
    {
        if ($cuenta instanceof Cuenta) {
            return $this
                ->addUsingAlias(GastoPeer::FK_CUENTA, $cuenta->getIdCuenta(), $comparison);
        } elseif ($cuenta instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(GastoPeer::FK_CUENTA, $cuenta->toKeyValue('PrimaryKey', 'IdCuenta'), $comparison);
        } else {
            throw new PropelException('filterByCuenta() only accepts arguments of type Cuenta or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Cuenta relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return GastoQuery The current query, for fluid interface
     */
    public function joinCuenta($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Cuenta');

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
            $this->addJoinObject($join, 'Cuenta');
        }

        return $this;
    }

    /**
     * Use the Cuenta relation Cuenta object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Costo\SystemBundle\Model\CuentaQuery A secondary query class using the current class as primary query
     */
    public function useCuentaQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCuenta($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Cuenta', '\Costo\SystemBundle\Model\CuentaQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Gasto $gasto Object to remove from the list of results
     *
     * @return GastoQuery The current query, for fluid interface
     */
    public function prune($gasto = null)
    {
        if ($gasto) {
            $this->addUsingAlias(GastoPeer::ID_GASTO, $gasto->getIdGasto(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Code to execute before every DELETE statement
     *
     * @param     PropelPDO $con The connection object used by the query
     */
    protected function basePreDelete(PropelPDO $con)
    {
        // aggregate_column_relation behavior
        $this->findRelatedCuentas($con);

        return $this->preDelete($con);
    }

    /**
     * Code to execute after every DELETE statement
     *
     * @param     int $affectedRows the number of deleted rows
     * @param     PropelPDO $con The connection object used by the query
     */
    protected function basePostDelete($affectedRows, PropelPDO $con)
    {
        // aggregate_column_relation behavior
        $this->updateRelatedCuentas($con);

        return $this->postDelete($affectedRows, $con);
    }

    /**
     * Code to execute before every UPDATE statement
     *
     * @param     array $values The associatiove array of columns and values for the update
     * @param     PropelPDO $con The connection object used by the query
     * @param     boolean $forceIndividualSaves If false (default), the resulting call is a BasePeer::doUpdate(), ortherwise it is a series of save() calls on all the found objects
     */
    protected function basePreUpdate(&$values, PropelPDO $con, $forceIndividualSaves = false)
    {
        // aggregate_column_relation behavior
        $this->findRelatedCuentas($con);

        return $this->preUpdate($values, $con, $forceIndividualSaves);
    }

    /**
     * Code to execute after every UPDATE statement
     *
     * @param     int $affectedRows the number of udated rows
     * @param     PropelPDO $con The connection object used by the query
     */
    protected function basePostUpdate($affectedRows, PropelPDO $con)
    {
        // aggregate_column_relation behavior
        $this->updateRelatedCuentas($con);

        return $this->postUpdate($affectedRows, $con);
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     GastoQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(GastoPeer::FECHA_MODIFICACION_GASTO, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     GastoQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(GastoPeer::FECHA_MODIFICACION_GASTO);
    }

    /**
     * Order by update date asc
     *
     * @return     GastoQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(GastoPeer::FECHA_MODIFICACION_GASTO);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     GastoQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(GastoPeer::FECHA_CREACION_GASTO, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     GastoQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(GastoPeer::FECHA_CREACION_GASTO);
    }

    /**
     * Order by create date asc
     *
     * @return     GastoQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(GastoPeer::FECHA_CREACION_GASTO);
    }
    // aggregate_column_relation behavior

    /**
     * Finds the related Cuenta objects and keep them for later
     *
     * @param PropelPDO $con A connection object
     */
    protected function findRelatedCuentas($con)
    {
        $criteria = clone $this;
        if ($this->useAliasInSQL) {
            $alias = $this->getModelAlias();
            $criteria->removeAlias($alias);
        } else {
            $alias = '';
        }
        $this->cuentas = CuentaQuery::create()
            ->joinGasto($alias)
            ->mergeWith($criteria)
            ->find($con);
    }

    protected function updateRelatedCuentas($con)
    {
        foreach ($this->cuentas as $cuenta) {
            $cuenta->updateValorCuenta($con);
        }
        $this->cuentas = array();
    }

}
