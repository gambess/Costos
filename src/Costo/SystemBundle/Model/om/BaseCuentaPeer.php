<?php

namespace Costo\SystemBundle\Model\om;

use \BasePeer;
use \Criteria;
use \PDO;
use \PDOStatement;
use \Propel;
use \PropelException;
use \PropelPDO;
use Costo\SystemBundle\Model\Cuenta;
use Costo\SystemBundle\Model\CuentaPeer;
use Costo\SystemBundle\Model\map\CuentaTableMap;

/**
 * Base static class for performing query and update operations on the 'cuenta' table.
 *
 *
 *
 * @package propel.generator.src.Costo.SystemBundle.Model.om
 */
abstract class BaseCuentaPeer
{

    /** the default database name for this class */
    const DATABASE_NAME = 'testing';

    /** the table name for this class */
    const TABLE_NAME = 'cuenta';

    /** the related Propel class for this table */
    const OM_CLASS = 'Costo\\SystemBundle\\Model\\Cuenta';

    /** the related TableMap class for this table */
    const TM_CLASS = 'CuentaTableMap';

    /** The total number of columns. */
    const NUM_COLUMNS = 7;

    /** The number of lazy-loaded columns. */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
    const NUM_HYDRATE_COLUMNS = 7;

    /** the column name for the id_cuenta field */
    const ID_CUENTA = 'cuenta.id_cuenta';

    /** the column name for the nombre_cuenta field */
    const NOMBRE_CUENTA = 'cuenta.nombre_cuenta';

    /** the column name for the valor_cuenta field */
    const VALOR_CUENTA = 'cuenta.valor_cuenta';

    /** the column name for the tipo_cuenta field */
    const TIPO_CUENTA = 'cuenta.tipo_cuenta';

    /** the column name for the user_crea_cuenta field */
    const USER_CREA_CUENTA = 'cuenta.user_crea_cuenta';

    /** the column name for the fecha_creacion_cuenta field */
    const FECHA_CREACION_CUENTA = 'cuenta.fecha_creacion_cuenta';

    /** the column name for the fecha_modificacion_cuenta field */
    const FECHA_MODIFICACION_CUENTA = 'cuenta.fecha_modificacion_cuenta';

    /** The enumerated values for the tipo_cuenta field */
    const TIPO_CUENTA_FORMAL = 'FORMAL';
    const TIPO_CUENTA_INFORMAL = 'INFORMAL';

    /** The default string format for model objects of the related table **/
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * An identiy map to hold any loaded instances of Cuenta objects.
     * This must be public so that other peer classes can access this when hydrating from JOIN
     * queries.
     * @var        array Cuenta[]
     */
    public static $instances = array();


    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. CuentaPeer::$fieldNames[CuentaPeer::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        BasePeer::TYPE_PHPNAME => array ('IdCuenta', 'NombreCuenta', 'ValorCuenta', 'TipoCuenta', 'UserCreaCuenta', 'FechaCreacionCuenta', 'FechaModificacionCuenta', ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('idCuenta', 'nombreCuenta', 'valorCuenta', 'tipoCuenta', 'userCreaCuenta', 'fechaCreacionCuenta', 'fechaModificacionCuenta', ),
        BasePeer::TYPE_COLNAME => array (CuentaPeer::ID_CUENTA, CuentaPeer::NOMBRE_CUENTA, CuentaPeer::VALOR_CUENTA, CuentaPeer::TIPO_CUENTA, CuentaPeer::USER_CREA_CUENTA, CuentaPeer::FECHA_CREACION_CUENTA, CuentaPeer::FECHA_MODIFICACION_CUENTA, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID_CUENTA', 'NOMBRE_CUENTA', 'VALOR_CUENTA', 'TIPO_CUENTA', 'USER_CREA_CUENTA', 'FECHA_CREACION_CUENTA', 'FECHA_MODIFICACION_CUENTA', ),
        BasePeer::TYPE_FIELDNAME => array ('id_cuenta', 'nombre_cuenta', 'valor_cuenta', 'tipo_cuenta', 'user_crea_cuenta', 'fecha_creacion_cuenta', 'fecha_modificacion_cuenta', ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. CuentaPeer::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        BasePeer::TYPE_PHPNAME => array ('IdCuenta' => 0, 'NombreCuenta' => 1, 'ValorCuenta' => 2, 'TipoCuenta' => 3, 'UserCreaCuenta' => 4, 'FechaCreacionCuenta' => 5, 'FechaModificacionCuenta' => 6, ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('idCuenta' => 0, 'nombreCuenta' => 1, 'valorCuenta' => 2, 'tipoCuenta' => 3, 'userCreaCuenta' => 4, 'fechaCreacionCuenta' => 5, 'fechaModificacionCuenta' => 6, ),
        BasePeer::TYPE_COLNAME => array (CuentaPeer::ID_CUENTA => 0, CuentaPeer::NOMBRE_CUENTA => 1, CuentaPeer::VALOR_CUENTA => 2, CuentaPeer::TIPO_CUENTA => 3, CuentaPeer::USER_CREA_CUENTA => 4, CuentaPeer::FECHA_CREACION_CUENTA => 5, CuentaPeer::FECHA_MODIFICACION_CUENTA => 6, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID_CUENTA' => 0, 'NOMBRE_CUENTA' => 1, 'VALOR_CUENTA' => 2, 'TIPO_CUENTA' => 3, 'USER_CREA_CUENTA' => 4, 'FECHA_CREACION_CUENTA' => 5, 'FECHA_MODIFICACION_CUENTA' => 6, ),
        BasePeer::TYPE_FIELDNAME => array ('id_cuenta' => 0, 'nombre_cuenta' => 1, 'valor_cuenta' => 2, 'tipo_cuenta' => 3, 'user_crea_cuenta' => 4, 'fecha_creacion_cuenta' => 5, 'fecha_modificacion_cuenta' => 6, ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
    );

    /** The enumerated values for this table */
    protected static $enumValueSets = array(
        CuentaPeer::TIPO_CUENTA => array(
            CuentaPeer::TIPO_CUENTA_FORMAL,
            CuentaPeer::TIPO_CUENTA_INFORMAL,
        ),
    );

    /**
     * Translates a fieldname to another type
     *
     * @param      string $name field name
     * @param      string $fromType One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                         BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
     * @param      string $toType   One of the class type constants
     * @return string          translated name of the field.
     * @throws PropelException - if the specified name could not be found in the fieldname mappings.
     */
    public static function translateFieldName($name, $fromType, $toType)
    {
        $toNames = CuentaPeer::getFieldNames($toType);
        $key = isset(CuentaPeer::$fieldKeys[$fromType][$name]) ? CuentaPeer::$fieldKeys[$fromType][$name] : null;
        if ($key === null) {
            throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(CuentaPeer::$fieldKeys[$fromType], true));
        }

        return $toNames[$key];
    }

    /**
     * Returns an array of field names.
     *
     * @param      string $type The type of fieldnames to return:
     *                      One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                      BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
     * @return array           A list of field names
     * @throws PropelException - if the type is not valid.
     */
    public static function getFieldNames($type = BasePeer::TYPE_PHPNAME)
    {
        if (!array_key_exists($type, CuentaPeer::$fieldNames)) {
            throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
        }

        return CuentaPeer::$fieldNames[$type];
    }

    /**
     * Gets the list of values for all ENUM columns
     * @return array
     */
    public static function getValueSets()
    {
      return CuentaPeer::$enumValueSets;
    }

    /**
     * Gets the list of values for an ENUM column
     *
     * @param string $colname The ENUM column name.
     *
     * @return array list of possible values for the column
     */
    public static function getValueSet($colname)
    {
        $valueSets = CuentaPeer::getValueSets();

        if (!isset($valueSets[$colname])) {
            throw new PropelException(sprintf('Column "%s" has no ValueSet.', $colname));
        }

        return $valueSets[$colname];
    }

    /**
     * Gets the SQL value for the ENUM column value
     *
     * @param string $colname ENUM column name.
     * @param string $enumVal ENUM value.
     *
     * @return int            SQL value
     */
    public static function getSqlValueForEnum($colname, $enumVal)
    {
        $values = CuentaPeer::getValueSet($colname);
        if (!in_array($enumVal, $values)) {
            throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $colname));
        }
        return array_search($enumVal, $values);
    }

    /**
     * Convenience method which changes table.column to alias.column.
     *
     * Using this method you can maintain SQL abstraction while using column aliases.
     * <code>
     *		$c->addAlias("alias1", TablePeer::TABLE_NAME);
     *		$c->addJoin(TablePeer::alias("alias1", TablePeer::PRIMARY_KEY_COLUMN), TablePeer::PRIMARY_KEY_COLUMN);
     * </code>
     * @param      string $alias The alias for the current table.
     * @param      string $column The column name for current table. (i.e. CuentaPeer::COLUMN_NAME).
     * @return string
     */
    public static function alias($alias, $column)
    {
        return str_replace(CuentaPeer::TABLE_NAME.'.', $alias.'.', $column);
    }

    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param      Criteria $criteria object containing the columns to add.
     * @param      string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(CuentaPeer::ID_CUENTA);
            $criteria->addSelectColumn(CuentaPeer::NOMBRE_CUENTA);
            $criteria->addSelectColumn(CuentaPeer::VALOR_CUENTA);
            $criteria->addSelectColumn(CuentaPeer::TIPO_CUENTA);
            $criteria->addSelectColumn(CuentaPeer::USER_CREA_CUENTA);
            $criteria->addSelectColumn(CuentaPeer::FECHA_CREACION_CUENTA);
            $criteria->addSelectColumn(CuentaPeer::FECHA_MODIFICACION_CUENTA);
        } else {
            $criteria->addSelectColumn($alias . '.id_cuenta');
            $criteria->addSelectColumn($alias . '.nombre_cuenta');
            $criteria->addSelectColumn($alias . '.valor_cuenta');
            $criteria->addSelectColumn($alias . '.tipo_cuenta');
            $criteria->addSelectColumn($alias . '.user_crea_cuenta');
            $criteria->addSelectColumn($alias . '.fecha_creacion_cuenta');
            $criteria->addSelectColumn($alias . '.fecha_modificacion_cuenta');
        }
    }

    /**
     * Returns the number of rows matching criteria.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @return int Number of matching rows.
     */
    public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
    {
        // we may modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(CuentaPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            CuentaPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
        $criteria->setDbName(CuentaPeer::DATABASE_NAME); // Set the correct dbName

        if ($con === null) {
            $con = Propel::getConnection(CuentaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        // BasePeer returns a PDOStatement
        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }
    /**
     * Selects one object from the DB.
     *
     * @param      Criteria $criteria object used to create the SELECT statement.
     * @param      PropelPDO $con
     * @return                 Cuenta
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
    {
        $critcopy = clone $criteria;
        $critcopy->setLimit(1);
        $objects = CuentaPeer::doSelect($critcopy, $con);
        if ($objects) {
            return $objects[0];
        }

        return null;
    }
    /**
     * Selects several row from the DB.
     *
     * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
     * @param      PropelPDO $con
     * @return array           Array of selected Objects
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelect(Criteria $criteria, PropelPDO $con = null)
    {
        return CuentaPeer::populateObjects(CuentaPeer::doSelectStmt($criteria, $con));
    }
    /**
     * Prepares the Criteria object and uses the parent doSelect() method to execute a PDOStatement.
     *
     * Use this method directly if you want to work with an executed statement directly (for example
     * to perform your own object hydration).
     *
     * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
     * @param      PropelPDO $con The connection to use
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     * @return PDOStatement The executed PDOStatement object.
     * @see        BasePeer::doSelect()
     */
    public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(CuentaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        if (!$criteria->hasSelectClause()) {
            $criteria = clone $criteria;
            CuentaPeer::addSelectColumns($criteria);
        }

        // Set the correct dbName
        $criteria->setDbName(CuentaPeer::DATABASE_NAME);

        // BasePeer returns a PDOStatement
        return BasePeer::doSelect($criteria, $con);
    }
    /**
     * Adds an object to the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doSelect*()
     * methods in your stub classes -- you may need to explicitly add objects
     * to the cache in order to ensure that the same objects are always returned by doSelect*()
     * and retrieveByPK*() calls.
     *
     * @param      Cuenta $obj A Cuenta object.
     * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if ($key === null) {
                $key = (string) $obj->getIdCuenta();
            } // if key === null
            CuentaPeer::$instances[$key] = $obj;
        }
    }

    /**
     * Removes an object from the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doDelete
     * methods in your stub classes -- you may need to explicitly remove objects
     * from the cache in order to prevent returning objects that no longer exist.
     *
     * @param      mixed $value A Cuenta object or a primary key value.
     *
     * @return void
     * @throws PropelException - if the value is invalid.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && $value !== null) {
            if (is_object($value) && $value instanceof Cuenta) {
                $key = (string) $value->getIdCuenta();
            } elseif (is_scalar($value)) {
                // assume we've been passed a primary key
                $key = (string) $value;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or Cuenta object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
                throw $e;
            }

            unset(CuentaPeer::$instances[$key]);
        }
    } // removeInstanceFromPool()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
     * @return   Cuenta Found object or null if 1) no instance exists for specified key or 2) instance pooling has been disabled.
     * @see        getPrimaryKeyHash()
     */
    public static function getInstanceFromPool($key)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (isset(CuentaPeer::$instances[$key])) {
                return CuentaPeer::$instances[$key];
            }
        }

        return null; // just to be explicit
    }

    /**
     * Clear the instance pool.
     *
     * @return void
     */
    public static function clearInstancePool($and_clear_all_references = false)
    {
      if ($and_clear_all_references)
      {
        foreach (CuentaPeer::$instances as $instance)
        {
          $instance->clearAllReferences(true);
        }
      }
        CuentaPeer::$instances = array();
    }

    /**
     * Method to invalidate the instance pool of all tables related to cuenta
     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      array $row PropelPDO resultset row.
     * @param      int $startcol The 0-based offset for reading from the resultset row.
     * @return string A string version of PK or null if the components of primary key in result array are all null.
     */
    public static function getPrimaryKeyHashFromRow($row, $startcol = 0)
    {
        // If the PK cannot be derived from the row, return null.
        if ($row[$startcol] === null) {
            return null;
        }

        return (string) $row[$startcol];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param      array $row PropelPDO resultset row.
     * @param      int $startcol The 0-based offset for reading from the resultset row.
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $startcol = 0)
    {

        return (int) $row[$startcol];
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function populateObjects(PDOStatement $stmt)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = CuentaPeer::getOMClass();
        // populate the object(s)
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key = CuentaPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj = CuentaPeer::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                CuentaPeer::addInstanceToPool($obj, $key);
            } // if key exists
        }
        $stmt->closeCursor();

        return $results;
    }
    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param      array $row PropelPDO resultset row.
     * @param      int $startcol The 0-based offset for reading from the resultset row.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     * @return array (Cuenta object, last column rank)
     */
    public static function populateObject($row, $startcol = 0)
    {
        $key = CuentaPeer::getPrimaryKeyHashFromRow($row, $startcol);
        if (null !== ($obj = CuentaPeer::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $startcol, true); // rehydrate
            $col = $startcol + CuentaPeer::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = CuentaPeer::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $startcol);
            CuentaPeer::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * Returns the TableMap related to this peer.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getDatabaseMap(CuentaPeer::DATABASE_NAME)->getTable(CuentaPeer::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this peer class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getDatabaseMap(BaseCuentaPeer::DATABASE_NAME);
      if (!$dbMap->hasTable(BaseCuentaPeer::TABLE_NAME)) {
        $dbMap->addTableObject(new CuentaTableMap());
      }
    }

    /**
     * The class that the Peer will make instances of.
     *
     *
     * @return string ClassName
     */
    public static function getOMClass()
    {
        return CuentaPeer::OM_CLASS;
    }

    /**
     * Performs an INSERT on the database, given a Cuenta or Criteria object.
     *
     * @param      mixed $values Criteria or Cuenta object containing data that is used to create the INSERT statement.
     * @param      PropelPDO $con the PropelPDO connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doInsert($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(CuentaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity
        } else {
            $criteria = $values->buildCriteria(); // build Criteria from Cuenta object
        }

        if ($criteria->containsKey(CuentaPeer::ID_CUENTA) && $criteria->keyContainsValue(CuentaPeer::ID_CUENTA) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.CuentaPeer::ID_CUENTA.')');
        }


        // Set the correct dbName
        $criteria->setDbName(CuentaPeer::DATABASE_NAME);

        try {
            // use transaction because $criteria could contain info
            // for more than one table (I guess, conceivably)
            $con->beginTransaction();
            $pk = BasePeer::doInsert($criteria, $con);
            $con->commit();
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }

        return $pk;
    }

    /**
     * Performs an UPDATE on the database, given a Cuenta or Criteria object.
     *
     * @param      mixed $values Criteria or Cuenta object containing data that is used to create the UPDATE statement.
     * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doUpdate($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(CuentaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $selectCriteria = new Criteria(CuentaPeer::DATABASE_NAME);

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity

            $comparison = $criteria->getComparison(CuentaPeer::ID_CUENTA);
            $value = $criteria->remove(CuentaPeer::ID_CUENTA);
            if ($value) {
                $selectCriteria->add(CuentaPeer::ID_CUENTA, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(CuentaPeer::TABLE_NAME);
            }

        } else { // $values is Cuenta object
            $criteria = $values->buildCriteria(); // gets full criteria
            $selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
        }

        // set the correct dbName
        $criteria->setDbName(CuentaPeer::DATABASE_NAME);

        return BasePeer::doUpdate($selectCriteria, $criteria, $con);
    }

    /**
     * Deletes all rows from the cuenta table.
     *
     * @param      PropelPDO $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException
     */
    public static function doDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(CuentaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += BasePeer::doDeleteAll(CuentaPeer::TABLE_NAME, $con, CuentaPeer::DATABASE_NAME);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CuentaPeer::clearInstancePool();
            CuentaPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs a DELETE on the database, given a Cuenta or Criteria object OR a primary key value.
     *
     * @param      mixed $values Criteria or Cuenta object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param      PropelPDO $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *				if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, PropelPDO $con = null)
     {
        if ($con === null) {
            $con = Propel::getConnection(CuentaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            // invalidate the cache for all objects of this type, since we have no
            // way of knowing (without running a query) what objects should be invalidated
            // from the cache based on this Criteria.
            CuentaPeer::clearInstancePool();
            // rename for clarity
            $criteria = clone $values;
        } elseif ($values instanceof Cuenta) { // it's a model object
            // invalidate the cache for this single object
            CuentaPeer::removeInstanceFromPool($values);
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(CuentaPeer::DATABASE_NAME);
            $criteria->add(CuentaPeer::ID_CUENTA, (array) $values, Criteria::IN);
            // invalidate the cache for this object(s)
            foreach ((array) $values as $singleval) {
                CuentaPeer::removeInstanceFromPool($singleval);
            }
        }

        // Set the correct dbName
        $criteria->setDbName(CuentaPeer::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();

            $affectedRows += BasePeer::doDelete($criteria, $con);
            CuentaPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Validates all modified columns of given Cuenta object.
     * If parameter $columns is either a single column name or an array of column names
     * than only those columns are validated.
     *
     * NOTICE: This does not apply to primary or foreign keys for now.
     *
     * @param      Cuenta $obj The object to validate.
     * @param      mixed $cols Column name or array of column names.
     *
     * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
     */
    public static function doValidate($obj, $cols = null)
    {
        $columns = array();

        if ($cols) {
            $dbMap = Propel::getDatabaseMap(CuentaPeer::DATABASE_NAME);
            $tableMap = $dbMap->getTable(CuentaPeer::TABLE_NAME);

            if (! is_array($cols)) {
                $cols = array($cols);
            }

            foreach ($cols as $colName) {
                if ($tableMap->hasColumn($colName)) {
                    $get = 'get' . $tableMap->getColumn($colName)->getPhpName();
                    $columns[$colName] = $obj->$get();
                }
            }
        } else {

        }

        return BasePeer::doValidate(CuentaPeer::DATABASE_NAME, CuentaPeer::TABLE_NAME, $columns);
    }

    /**
     * Retrieve a single object by pkey.
     *
     * @param      int $pk the primary key.
     * @param      PropelPDO $con the connection to use
     * @return Cuenta
     */
    public static function retrieveByPK($pk, PropelPDO $con = null)
    {

        if (null !== ($obj = CuentaPeer::getInstanceFromPool((string) $pk))) {
            return $obj;
        }

        if ($con === null) {
            $con = Propel::getConnection(CuentaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria = new Criteria(CuentaPeer::DATABASE_NAME);
        $criteria->add(CuentaPeer::ID_CUENTA, $pk);

        $v = CuentaPeer::doSelect($criteria, $con);

        return !empty($v) > 0 ? $v[0] : null;
    }

    /**
     * Retrieve multiple objects by pkey.
     *
     * @param      array $pks List of primary keys
     * @param      PropelPDO $con the connection to use
     * @return Cuenta[]
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function retrieveByPKs($pks, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(CuentaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $objs = null;
        if (empty($pks)) {
            $objs = array();
        } else {
            $criteria = new Criteria(CuentaPeer::DATABASE_NAME);
            $criteria->add(CuentaPeer::ID_CUENTA, $pks, Criteria::IN);
            $objs = CuentaPeer::doSelect($criteria, $con);
        }

        return $objs;
    }

} // BaseCuentaPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseCuentaPeer::buildTableMap();

