<?php

namespace Costo\SystemBundle\Model\om;

use \Criteria;
use \Exception;
use \ModelCriteria;
use \PDO;
use \Propel;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use Costo\SystemBundle\Model\Venta;
use Costo\SystemBundle\Model\VentaPeer;
use Costo\SystemBundle\Model\VentaQuery;

/**
 * Base class that represents a query for the 'venta' table.
 *
 *
 *
 * @method VentaQuery orderByIdVenta($order = Criteria::ASC) Order by the id_venta column
 * @method VentaQuery orderByFechaVenta($order = Criteria::ASC) Order by the fecha_venta column
 * @method VentaQuery orderByTotalVenta($order = Criteria::ASC) Order by the total_venta column
 * @method VentaQuery orderByFormalTotalVenta($order = Criteria::ASC) Order by the formal_total_venta column
 * @method VentaQuery orderByInformalTotalVenta($order = Criteria::ASC) Order by the informal_total_venta column
 * @method VentaQuery orderByTotalIvaVentaFormal($order = Criteria::ASC) Order by the total_iva_venta_formal column
 * @method VentaQuery orderByDetalleVenta($order = Criteria::ASC) Order by the detalle_venta column
 * @method VentaQuery orderByFechaCreacionVenta($order = Criteria::ASC) Order by the fecha_creacion_venta column
 * @method VentaQuery orderByFechaModificacionVenta($order = Criteria::ASC) Order by the fecha_modificacion_venta column
 *
 * @method VentaQuery groupByIdVenta() Group by the id_venta column
 * @method VentaQuery groupByFechaVenta() Group by the fecha_venta column
 * @method VentaQuery groupByTotalVenta() Group by the total_venta column
 * @method VentaQuery groupByFormalTotalVenta() Group by the formal_total_venta column
 * @method VentaQuery groupByInformalTotalVenta() Group by the informal_total_venta column
 * @method VentaQuery groupByTotalIvaVentaFormal() Group by the total_iva_venta_formal column
 * @method VentaQuery groupByDetalleVenta() Group by the detalle_venta column
 * @method VentaQuery groupByFechaCreacionVenta() Group by the fecha_creacion_venta column
 * @method VentaQuery groupByFechaModificacionVenta() Group by the fecha_modificacion_venta column
 *
 * @method VentaQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method VentaQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method VentaQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method Venta findOne(PropelPDO $con = null) Return the first Venta matching the query
 * @method Venta findOneOrCreate(PropelPDO $con = null) Return the first Venta matching the query, or a new Venta object populated from the query conditions when no match is found
 *
 * @method Venta findOneByFechaVenta(string $fecha_venta) Return the first Venta filtered by the fecha_venta column
 * @method Venta findOneByTotalVenta(double $total_venta) Return the first Venta filtered by the total_venta column
 * @method Venta findOneByFormalTotalVenta(double $formal_total_venta) Return the first Venta filtered by the formal_total_venta column
 * @method Venta findOneByInformalTotalVenta(double $informal_total_venta) Return the first Venta filtered by the informal_total_venta column
 * @method Venta findOneByTotalIvaVentaFormal(double $total_iva_venta_formal) Return the first Venta filtered by the total_iva_venta_formal column
 * @method Venta findOneByDetalleVenta(string $detalle_venta) Return the first Venta filtered by the detalle_venta column
 * @method Venta findOneByFechaCreacionVenta(string $fecha_creacion_venta) Return the first Venta filtered by the fecha_creacion_venta column
 * @method Venta findOneByFechaModificacionVenta(string $fecha_modificacion_venta) Return the first Venta filtered by the fecha_modificacion_venta column
 *
 * @method array findByIdVenta(int $id_venta) Return Venta objects filtered by the id_venta column
 * @method array findByFechaVenta(string $fecha_venta) Return Venta objects filtered by the fecha_venta column
 * @method array findByTotalVenta(double $total_venta) Return Venta objects filtered by the total_venta column
 * @method array findByFormalTotalVenta(double $formal_total_venta) Return Venta objects filtered by the formal_total_venta column
 * @method array findByInformalTotalVenta(double $informal_total_venta) Return Venta objects filtered by the informal_total_venta column
 * @method array findByTotalIvaVentaFormal(double $total_iva_venta_formal) Return Venta objects filtered by the total_iva_venta_formal column
 * @method array findByDetalleVenta(string $detalle_venta) Return Venta objects filtered by the detalle_venta column
 * @method array findByFechaCreacionVenta(string $fecha_creacion_venta) Return Venta objects filtered by the fecha_creacion_venta column
 * @method array findByFechaModificacionVenta(string $fecha_modificacion_venta) Return Venta objects filtered by the fecha_modificacion_venta column
 *
 * @package    propel.generator.src.Costo.SystemBundle.Model.om
 */
abstract class BaseVentaQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseVentaQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'testing', $modelName = 'Costo\\SystemBundle\\Model\\Venta', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new VentaQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   VentaQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return VentaQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof VentaQuery) {
            return $criteria;
        }
        $query = new VentaQuery();
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
     * @return   Venta|Venta[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = VentaPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(VentaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Venta A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneByIdVenta($key, $con = null)
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
     * @return                 Venta A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id_venta`, `fecha_venta`, `total_venta`, `formal_total_venta`, `informal_total_venta`, `total_iva_venta_formal`, `detalle_venta`, `fecha_creacion_venta`, `fecha_modificacion_venta` FROM `venta` WHERE `id_venta` = :p0';
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
            $obj = new Venta();
            $obj->hydrate($row);
            VentaPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Venta|Venta[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Venta[]|mixed the list of results, formatted by the current formatter
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
     * @return VentaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(VentaPeer::ID_VENTA, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return VentaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(VentaPeer::ID_VENTA, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id_venta column
     *
     * Example usage:
     * <code>
     * $query->filterByIdVenta(1234); // WHERE id_venta = 1234
     * $query->filterByIdVenta(array(12, 34)); // WHERE id_venta IN (12, 34)
     * $query->filterByIdVenta(array('min' => 12)); // WHERE id_venta >= 12
     * $query->filterByIdVenta(array('max' => 12)); // WHERE id_venta <= 12
     * </code>
     *
     * @param     mixed $idVenta The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return VentaQuery The current query, for fluid interface
     */
    public function filterByIdVenta($idVenta = null, $comparison = null)
    {
        if (is_array($idVenta)) {
            $useMinMax = false;
            if (isset($idVenta['min'])) {
                $this->addUsingAlias(VentaPeer::ID_VENTA, $idVenta['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idVenta['max'])) {
                $this->addUsingAlias(VentaPeer::ID_VENTA, $idVenta['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VentaPeer::ID_VENTA, $idVenta, $comparison);
    }

    /**
     * Filter the query on the fecha_venta column
     *
     * Example usage:
     * <code>
     * $query->filterByFechaVenta('2011-03-14'); // WHERE fecha_venta = '2011-03-14'
     * $query->filterByFechaVenta('now'); // WHERE fecha_venta = '2011-03-14'
     * $query->filterByFechaVenta(array('max' => 'yesterday')); // WHERE fecha_venta > '2011-03-13'
     * </code>
     *
     * @param     mixed $fechaVenta The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return VentaQuery The current query, for fluid interface
     */
    public function filterByFechaVenta($fechaVenta = null, $comparison = null)
    {
        if (is_array($fechaVenta)) {
            $useMinMax = false;
            if (isset($fechaVenta['min'])) {
                $this->addUsingAlias(VentaPeer::FECHA_VENTA, $fechaVenta['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fechaVenta['max'])) {
                $this->addUsingAlias(VentaPeer::FECHA_VENTA, $fechaVenta['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VentaPeer::FECHA_VENTA, $fechaVenta, $comparison);
    }

    /**
     * Filter the query on the total_venta column
     *
     * Example usage:
     * <code>
     * $query->filterByTotalVenta(1234); // WHERE total_venta = 1234
     * $query->filterByTotalVenta(array(12, 34)); // WHERE total_venta IN (12, 34)
     * $query->filterByTotalVenta(array('min' => 12)); // WHERE total_venta >= 12
     * $query->filterByTotalVenta(array('max' => 12)); // WHERE total_venta <= 12
     * </code>
     *
     * @param     mixed $totalVenta The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return VentaQuery The current query, for fluid interface
     */
    public function filterByTotalVenta($totalVenta = null, $comparison = null)
    {
        if (is_array($totalVenta)) {
            $useMinMax = false;
            if (isset($totalVenta['min'])) {
                $this->addUsingAlias(VentaPeer::TOTAL_VENTA, $totalVenta['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($totalVenta['max'])) {
                $this->addUsingAlias(VentaPeer::TOTAL_VENTA, $totalVenta['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VentaPeer::TOTAL_VENTA, $totalVenta, $comparison);
    }

    /**
     * Filter the query on the formal_total_venta column
     *
     * Example usage:
     * <code>
     * $query->filterByFormalTotalVenta(1234); // WHERE formal_total_venta = 1234
     * $query->filterByFormalTotalVenta(array(12, 34)); // WHERE formal_total_venta IN (12, 34)
     * $query->filterByFormalTotalVenta(array('min' => 12)); // WHERE formal_total_venta >= 12
     * $query->filterByFormalTotalVenta(array('max' => 12)); // WHERE formal_total_venta <= 12
     * </code>
     *
     * @param     mixed $formalTotalVenta The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return VentaQuery The current query, for fluid interface
     */
    public function filterByFormalTotalVenta($formalTotalVenta = null, $comparison = null)
    {
        if (is_array($formalTotalVenta)) {
            $useMinMax = false;
            if (isset($formalTotalVenta['min'])) {
                $this->addUsingAlias(VentaPeer::FORMAL_TOTAL_VENTA, $formalTotalVenta['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($formalTotalVenta['max'])) {
                $this->addUsingAlias(VentaPeer::FORMAL_TOTAL_VENTA, $formalTotalVenta['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VentaPeer::FORMAL_TOTAL_VENTA, $formalTotalVenta, $comparison);
    }

    /**
     * Filter the query on the informal_total_venta column
     *
     * Example usage:
     * <code>
     * $query->filterByInformalTotalVenta(1234); // WHERE informal_total_venta = 1234
     * $query->filterByInformalTotalVenta(array(12, 34)); // WHERE informal_total_venta IN (12, 34)
     * $query->filterByInformalTotalVenta(array('min' => 12)); // WHERE informal_total_venta >= 12
     * $query->filterByInformalTotalVenta(array('max' => 12)); // WHERE informal_total_venta <= 12
     * </code>
     *
     * @param     mixed $informalTotalVenta The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return VentaQuery The current query, for fluid interface
     */
    public function filterByInformalTotalVenta($informalTotalVenta = null, $comparison = null)
    {
        if (is_array($informalTotalVenta)) {
            $useMinMax = false;
            if (isset($informalTotalVenta['min'])) {
                $this->addUsingAlias(VentaPeer::INFORMAL_TOTAL_VENTA, $informalTotalVenta['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($informalTotalVenta['max'])) {
                $this->addUsingAlias(VentaPeer::INFORMAL_TOTAL_VENTA, $informalTotalVenta['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VentaPeer::INFORMAL_TOTAL_VENTA, $informalTotalVenta, $comparison);
    }

    /**
     * Filter the query on the total_iva_venta_formal column
     *
     * Example usage:
     * <code>
     * $query->filterByTotalIvaVentaFormal(1234); // WHERE total_iva_venta_formal = 1234
     * $query->filterByTotalIvaVentaFormal(array(12, 34)); // WHERE total_iva_venta_formal IN (12, 34)
     * $query->filterByTotalIvaVentaFormal(array('min' => 12)); // WHERE total_iva_venta_formal >= 12
     * $query->filterByTotalIvaVentaFormal(array('max' => 12)); // WHERE total_iva_venta_formal <= 12
     * </code>
     *
     * @param     mixed $totalIvaVentaFormal The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return VentaQuery The current query, for fluid interface
     */
    public function filterByTotalIvaVentaFormal($totalIvaVentaFormal = null, $comparison = null)
    {
        if (is_array($totalIvaVentaFormal)) {
            $useMinMax = false;
            if (isset($totalIvaVentaFormal['min'])) {
                $this->addUsingAlias(VentaPeer::TOTAL_IVA_VENTA_FORMAL, $totalIvaVentaFormal['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($totalIvaVentaFormal['max'])) {
                $this->addUsingAlias(VentaPeer::TOTAL_IVA_VENTA_FORMAL, $totalIvaVentaFormal['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VentaPeer::TOTAL_IVA_VENTA_FORMAL, $totalIvaVentaFormal, $comparison);
    }

    /**
     * Filter the query on the detalle_venta column
     *
     * Example usage:
     * <code>
     * $query->filterByDetalleVenta('fooValue');   // WHERE detalle_venta = 'fooValue'
     * $query->filterByDetalleVenta('%fooValue%'); // WHERE detalle_venta LIKE '%fooValue%'
     * </code>
     *
     * @param     string $detalleVenta The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return VentaQuery The current query, for fluid interface
     */
    public function filterByDetalleVenta($detalleVenta = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($detalleVenta)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $detalleVenta)) {
                $detalleVenta = str_replace('*', '%', $detalleVenta);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(VentaPeer::DETALLE_VENTA, $detalleVenta, $comparison);
    }

    /**
     * Filter the query on the fecha_creacion_venta column
     *
     * Example usage:
     * <code>
     * $query->filterByFechaCreacionVenta('2011-03-14'); // WHERE fecha_creacion_venta = '2011-03-14'
     * $query->filterByFechaCreacionVenta('now'); // WHERE fecha_creacion_venta = '2011-03-14'
     * $query->filterByFechaCreacionVenta(array('max' => 'yesterday')); // WHERE fecha_creacion_venta > '2011-03-13'
     * </code>
     *
     * @param     mixed $fechaCreacionVenta The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return VentaQuery The current query, for fluid interface
     */
    public function filterByFechaCreacionVenta($fechaCreacionVenta = null, $comparison = null)
    {
        if (is_array($fechaCreacionVenta)) {
            $useMinMax = false;
            if (isset($fechaCreacionVenta['min'])) {
                $this->addUsingAlias(VentaPeer::FECHA_CREACION_VENTA, $fechaCreacionVenta['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fechaCreacionVenta['max'])) {
                $this->addUsingAlias(VentaPeer::FECHA_CREACION_VENTA, $fechaCreacionVenta['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VentaPeer::FECHA_CREACION_VENTA, $fechaCreacionVenta, $comparison);
    }

    /**
     * Filter the query on the fecha_modificacion_venta column
     *
     * Example usage:
     * <code>
     * $query->filterByFechaModificacionVenta('2011-03-14'); // WHERE fecha_modificacion_venta = '2011-03-14'
     * $query->filterByFechaModificacionVenta('now'); // WHERE fecha_modificacion_venta = '2011-03-14'
     * $query->filterByFechaModificacionVenta(array('max' => 'yesterday')); // WHERE fecha_modificacion_venta > '2011-03-13'
     * </code>
     *
     * @param     mixed $fechaModificacionVenta The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return VentaQuery The current query, for fluid interface
     */
    public function filterByFechaModificacionVenta($fechaModificacionVenta = null, $comparison = null)
    {
        if (is_array($fechaModificacionVenta)) {
            $useMinMax = false;
            if (isset($fechaModificacionVenta['min'])) {
                $this->addUsingAlias(VentaPeer::FECHA_MODIFICACION_VENTA, $fechaModificacionVenta['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fechaModificacionVenta['max'])) {
                $this->addUsingAlias(VentaPeer::FECHA_MODIFICACION_VENTA, $fechaModificacionVenta['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VentaPeer::FECHA_MODIFICACION_VENTA, $fechaModificacionVenta, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   Venta $venta Object to remove from the list of results
     *
     * @return VentaQuery The current query, for fluid interface
     */
    public function prune($venta = null)
    {
        if ($venta) {
            $this->addUsingAlias(VentaPeer::ID_VENTA, $venta->getIdVenta(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     VentaQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(VentaPeer::FECHA_MODIFICACION_VENTA, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     VentaQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(VentaPeer::FECHA_MODIFICACION_VENTA);
    }

    /**
     * Order by update date asc
     *
     * @return     VentaQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(VentaPeer::FECHA_MODIFICACION_VENTA);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     VentaQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(VentaPeer::FECHA_CREACION_VENTA, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     VentaQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(VentaPeer::FECHA_CREACION_VENTA);
    }

    /**
     * Order by create date asc
     *
     * @return     VentaQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(VentaPeer::FECHA_CREACION_VENTA);
    }
}
