<?php

namespace Costo\SystemBundle\Model\om;

use \BaseObject;
use \BasePeer;
use \Criteria;
use \DateTime;
use \Exception;
use \PDO;
use \Persistent;
use \Propel;
use \PropelCollection;
use \PropelDateTime;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use Costo\SystemBundle\Model\Cuenta;
use Costo\SystemBundle\Model\CuentaPeer;
use Costo\SystemBundle\Model\CuentaQuery;
use Costo\SystemBundle\Model\Gasto;
use Costo\SystemBundle\Model\GastoQuery;

/**
 * Base class that represents a row from the 'cuenta' table.
 *
 *
 *
 * @package    propel.generator.src.Costo.SystemBundle.Model.om
 */
abstract class BaseCuenta extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Costo\\SystemBundle\\Model\\CuentaPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        CuentaPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinit loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the id_cuenta field.
     * @var        int
     */
    protected $id_cuenta;

    /**
     * The value for the nombre_cuenta field.
     * @var        string
     */
    protected $nombre_cuenta;

    /**
     * The value for the valor_cuenta field.
     * Note: this column has a database default value of: 0
     * @var        double
     */
    protected $valor_cuenta;

    /**
     * The value for the tipo_cuenta field.
     * Note: this column has a database default value of: 'FORMAL'
     * @var        string
     */
    protected $tipo_cuenta;

    /**
     * The value for the user_crea_cuenta field.
     * @var        string
     */
    protected $user_crea_cuenta;

    /**
     * The value for the fecha_creacion_cuenta field.
     * @var        string
     */
    protected $fecha_creacion_cuenta;

    /**
     * The value for the fecha_modificacion_cuenta field.
     * @var        string
     */
    protected $fecha_modificacion_cuenta;

    /**
     * @var        PropelObjectCollection|Gasto[] Collection to store aggregation of Gasto objects.
     */
    protected $collGastos;
    protected $collGastosPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInSave = false;

    /**
     * Flag to prevent endless validation loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInValidation = false;

    /**
     * Flag to prevent endless clearAllReferences($deep=true) loop, if this object is referenced
     * @var        boolean
     */
    protected $alreadyInClearAllReferencesDeep = false;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $gastosScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see        __construct()
     */
    public function applyDefaultValues()
    {
        $this->valor_cuenta = 0;
        $this->tipo_cuenta = 'FORMAL';
    }

    /**
     * Initializes internal state of BaseCuenta object.
     * @see        applyDefaults()
     */
    public function __construct()
    {
        parent::__construct();
        $this->applyDefaultValues();
    }

    /**
     * Get the [id_cuenta] column value.
     *
     * @return int
     */
    public function getIdCuenta()
    {
        return $this->id_cuenta;
    }

    /**
     * Get the [nombre_cuenta] column value.
     *
     * @return string
     */
    public function getNombreCuenta()
    {
        return $this->nombre_cuenta;
    }

    /**
     * Get the [valor_cuenta] column value.
     *
     * @return double
     */
    public function getValorCuenta()
    {
        return $this->valor_cuenta;
    }

    /**
     * Get the [tipo_cuenta] column value.
     *
     * @return string
     */
    public function getTipoCuenta()
    {
        return $this->tipo_cuenta;
    }

    /**
     * Get the [user_crea_cuenta] column value.
     *
     * @return string
     */
    public function getUserCreaCuenta()
    {
        return $this->user_crea_cuenta;
    }

    /**
     * Get the [optionally formatted] temporal [fecha_creacion_cuenta] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getFechaCreacionCuenta($format = null)
    {
        if ($this->fecha_creacion_cuenta === null) {
            return null;
        }

        if ($this->fecha_creacion_cuenta === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->fecha_creacion_cuenta);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->fecha_creacion_cuenta, true), $x);
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        }

        if (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        }

        return $dt->format($format);

    }

    /**
     * Get the [optionally formatted] temporal [fecha_modificacion_cuenta] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getFechaModificacionCuenta($format = null)
    {
        if ($this->fecha_modificacion_cuenta === null) {
            return null;
        }

        if ($this->fecha_modificacion_cuenta === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->fecha_modificacion_cuenta);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->fecha_modificacion_cuenta, true), $x);
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        }

        if (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        }

        return $dt->format($format);

    }

    /**
     * Set the value of [id_cuenta] column.
     *
     * @param int $v new value
     * @return Cuenta The current object (for fluent API support)
     */
    public function setIdCuenta($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id_cuenta !== $v) {
            $this->id_cuenta = $v;
            $this->modifiedColumns[] = CuentaPeer::ID_CUENTA;
        }


        return $this;
    } // setIdCuenta()

    /**
     * Set the value of [nombre_cuenta] column.
     *
     * @param string $v new value
     * @return Cuenta The current object (for fluent API support)
     */
    public function setNombreCuenta($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->nombre_cuenta !== $v) {
            $this->nombre_cuenta = $v;
            $this->modifiedColumns[] = CuentaPeer::NOMBRE_CUENTA;
        }


        return $this;
    } // setNombreCuenta()

    /**
     * Set the value of [valor_cuenta] column.
     *
     * @param double $v new value
     * @return Cuenta The current object (for fluent API support)
     */
    public function setValorCuenta($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (double) $v;
        }

        if ($this->valor_cuenta !== $v) {
            $this->valor_cuenta = $v;
            $this->modifiedColumns[] = CuentaPeer::VALOR_CUENTA;
        }


        return $this;
    } // setValorCuenta()

    /**
     * Set the value of [tipo_cuenta] column.
     *
     * @param string $v new value
     * @return Cuenta The current object (for fluent API support)
     */
    public function setTipoCuenta($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->tipo_cuenta !== $v) {
            $this->tipo_cuenta = $v;
            $this->modifiedColumns[] = CuentaPeer::TIPO_CUENTA;
        }


        return $this;
    } // setTipoCuenta()

    /**
     * Set the value of [user_crea_cuenta] column.
     *
     * @param string $v new value
     * @return Cuenta The current object (for fluent API support)
     */
    public function setUserCreaCuenta($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->user_crea_cuenta !== $v) {
            $this->user_crea_cuenta = $v;
            $this->modifiedColumns[] = CuentaPeer::USER_CREA_CUENTA;
        }


        return $this;
    } // setUserCreaCuenta()

    /**
     * Sets the value of [fecha_creacion_cuenta] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Cuenta The current object (for fluent API support)
     */
    public function setFechaCreacionCuenta($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->fecha_creacion_cuenta !== null || $dt !== null) {
            $currentDateAsString = ($this->fecha_creacion_cuenta !== null && $tmpDt = new DateTime($this->fecha_creacion_cuenta)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->fecha_creacion_cuenta = $newDateAsString;
                $this->modifiedColumns[] = CuentaPeer::FECHA_CREACION_CUENTA;
            }
        } // if either are not null


        return $this;
    } // setFechaCreacionCuenta()

    /**
     * Sets the value of [fecha_modificacion_cuenta] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Cuenta The current object (for fluent API support)
     */
    public function setFechaModificacionCuenta($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->fecha_modificacion_cuenta !== null || $dt !== null) {
            $currentDateAsString = ($this->fecha_modificacion_cuenta !== null && $tmpDt = new DateTime($this->fecha_modificacion_cuenta)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->fecha_modificacion_cuenta = $newDateAsString;
                $this->modifiedColumns[] = CuentaPeer::FECHA_MODIFICACION_CUENTA;
            }
        } // if either are not null


        return $this;
    } // setFechaModificacionCuenta()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
            if ($this->valor_cuenta !== 0) {
                return false;
            }

            if ($this->tipo_cuenta !== 'FORMAL') {
                return false;
            }

        // otherwise, everything was equal, so return true
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
     * @param int $startcol 0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false)
    {
        try {

            $this->id_cuenta = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->nombre_cuenta = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->valor_cuenta = ($row[$startcol + 2] !== null) ? (double) $row[$startcol + 2] : null;
            $this->tipo_cuenta = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->user_crea_cuenta = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->fecha_creacion_cuenta = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->fecha_modificacion_cuenta = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);
            return $startcol + 7; // 7 = CuentaPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Cuenta object", $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {

    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param boolean $deep (optional) Whether to also de-associated any related objects.
     * @param PropelPDO $con (optional) The PropelPDO connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getConnection(CuentaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = CuentaPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collGastos = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param PropelPDO $con
     * @return void
     * @throws PropelException
     * @throws Exception
     * @see        BaseObject::setDeleted()
     * @see        BaseObject::isDeleted()
     */
    public function delete(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(CuentaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = CuentaQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $con->commit();
                $this->setDeleted(true);
            } else {
                $con->commit();
            }
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @throws Exception
     * @see        doSave()
     */
    public function save(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(CuentaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                if (!$this->isColumnModified(CuentaPeer::FECHA_CREACION_CUENTA)) {
                    $this->setFechaCreacionCuenta(time());
                }
                if (!$this->isColumnModified(CuentaPeer::FECHA_MODIFICACION_CUENTA)) {
                    $this->setFechaModificacionCuenta(time());
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(CuentaPeer::FECHA_MODIFICACION_CUENTA)) {
                    $this->setFechaModificacionCuenta(time());
                }
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                // aggregate_column behavior
                if (null !== $this->collGastos) {
                    $this->setValorCuenta($this->computeValorCuenta($con));
                    if ($this->isModified()) {
                        $this->save($con);
                    }
                }
                CuentaPeer::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see        save()
     */
    protected function doSave(PropelPDO $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                } else {
                    $this->doUpdate($con);
                }
                $affectedRows += 1;
                $this->resetModified();
            }

            if ($this->gastosScheduledForDeletion !== null) {
                if (!$this->gastosScheduledForDeletion->isEmpty()) {
                    GastoQuery::create()
                        ->filterByPrimaryKeys($this->gastosScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->gastosScheduledForDeletion = null;
                }
            }

            if ($this->collGastos !== null) {
                foreach ($this->collGastos as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param PropelPDO $con
     *
     * @throws PropelException
     * @see        doSave()
     */
    protected function doInsert(PropelPDO $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[] = CuentaPeer::ID_CUENTA;
        if (null !== $this->id_cuenta) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . CuentaPeer::ID_CUENTA . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(CuentaPeer::ID_CUENTA)) {
            $modifiedColumns[':p' . $index++]  = '`id_cuenta`';
        }
        if ($this->isColumnModified(CuentaPeer::NOMBRE_CUENTA)) {
            $modifiedColumns[':p' . $index++]  = '`nombre_cuenta`';
        }
        if ($this->isColumnModified(CuentaPeer::VALOR_CUENTA)) {
            $modifiedColumns[':p' . $index++]  = '`valor_cuenta`';
        }
        if ($this->isColumnModified(CuentaPeer::TIPO_CUENTA)) {
            $modifiedColumns[':p' . $index++]  = '`tipo_cuenta`';
        }
        if ($this->isColumnModified(CuentaPeer::USER_CREA_CUENTA)) {
            $modifiedColumns[':p' . $index++]  = '`user_crea_cuenta`';
        }
        if ($this->isColumnModified(CuentaPeer::FECHA_CREACION_CUENTA)) {
            $modifiedColumns[':p' . $index++]  = '`fecha_creacion_cuenta`';
        }
        if ($this->isColumnModified(CuentaPeer::FECHA_MODIFICACION_CUENTA)) {
            $modifiedColumns[':p' . $index++]  = '`fecha_modificacion_cuenta`';
        }

        $sql = sprintf(
            'INSERT INTO `cuenta` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`id_cuenta`':
                        $stmt->bindValue($identifier, $this->id_cuenta, PDO::PARAM_INT);
                        break;
                    case '`nombre_cuenta`':
                        $stmt->bindValue($identifier, $this->nombre_cuenta, PDO::PARAM_STR);
                        break;
                    case '`valor_cuenta`':
                        $stmt->bindValue($identifier, $this->valor_cuenta, PDO::PARAM_STR);
                        break;
                    case '`tipo_cuenta`':
                        $stmt->bindValue($identifier, $this->tipo_cuenta, PDO::PARAM_STR);
                        break;
                    case '`user_crea_cuenta`':
                        $stmt->bindValue($identifier, $this->user_crea_cuenta, PDO::PARAM_STR);
                        break;
                    case '`fecha_creacion_cuenta`':
                        $stmt->bindValue($identifier, $this->fecha_creacion_cuenta, PDO::PARAM_STR);
                        break;
                    case '`fecha_modificacion_cuenta`':
                        $stmt->bindValue($identifier, $this->fecha_modificacion_cuenta, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', $e);
        }
        $this->setIdCuenta($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param PropelPDO $con
     *
     * @see        doSave()
     */
    protected function doUpdate(PropelPDO $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();
        BasePeer::doUpdate($selectCriteria, $valuesCriteria, $con);
    }

    /**
     * Array of ValidationFailed objects.
     * @var        array ValidationFailed[]
     */
    protected $validationFailures = array();

    /**
     * Gets any ValidationFailed objects that resulted from last call to validate().
     *
     *
     * @return array ValidationFailed[]
     * @see        validate()
     */
    public function getValidationFailures()
    {
        return $this->validationFailures;
    }

    /**
     * Validates the objects modified field values and all objects related to this table.
     *
     * If $columns is either a column name or an array of column names
     * only those columns are validated.
     *
     * @param mixed $columns Column name or an array of column names.
     * @return boolean Whether all columns pass validation.
     * @see        doValidate()
     * @see        getValidationFailures()
     */
    public function validate($columns = null)
    {
        $res = $this->doValidate($columns);
        if ($res === true) {
            $this->validationFailures = array();

            return true;
        }

        $this->validationFailures = $res;

        return false;
    }

    /**
     * This function performs the validation work for complex object models.
     *
     * In addition to checking the current object, all related objects will
     * also be validated.  If all pass then <code>true</code> is returned; otherwise
     * an aggreagated array of ValidationFailed objects will be returned.
     *
     * @param array $columns Array of column names to validate.
     * @return mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
     */
    protected function doValidate($columns = null)
    {
        if (!$this->alreadyInValidation) {
            $this->alreadyInValidation = true;
            $retval = null;

            $failureMap = array();


            if (($retval = CuentaPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collGastos !== null) {
                    foreach ($this->collGastos as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }


            $this->alreadyInValidation = false;
        }

        return (!empty($failureMap) ? $failureMap : true);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param string $name name
     * @param string $type The type of fieldname the $name is of:
     *               one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *               BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *               Defaults to BasePeer::TYPE_PHPNAME
     * @return mixed Value of field.
     */
    public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = CuentaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getIdCuenta();
                break;
            case 1:
                return $this->getNombreCuenta();
                break;
            case 2:
                return $this->getValorCuenta();
                break;
            case 3:
                return $this->getTipoCuenta();
                break;
            case 4:
                return $this->getUserCreaCuenta();
                break;
            case 5:
                return $this->getFechaCreacionCuenta();
                break;
            case 6:
                return $this->getFechaModificacionCuenta();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     *                    BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                    Defaults to BasePeer::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to true.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {
        if (isset($alreadyDumpedObjects['Cuenta'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Cuenta'][$this->getPrimaryKey()] = true;
        $keys = CuentaPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getIdCuenta(),
            $keys[1] => $this->getNombreCuenta(),
            $keys[2] => $this->getValorCuenta(),
            $keys[3] => $this->getTipoCuenta(),
            $keys[4] => $this->getUserCreaCuenta(),
            $keys[5] => $this->getFechaCreacionCuenta(),
            $keys[6] => $this->getFechaModificacionCuenta(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->collGastos) {
                $result['Gastos'] = $this->collGastos->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param string $name peer name
     * @param mixed $value field value
     * @param string $type The type of fieldname the $name is of:
     *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                     Defaults to BasePeer::TYPE_PHPNAME
     * @return void
     */
    public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = CuentaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

        $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @param mixed $value field value
     * @return void
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setIdCuenta($value);
                break;
            case 1:
                $this->setNombreCuenta($value);
                break;
            case 2:
                $this->setValorCuenta($value);
                break;
            case 3:
                $this->setTipoCuenta($value);
                break;
            case 4:
                $this->setUserCreaCuenta($value);
                break;
            case 5:
                $this->setFechaCreacionCuenta($value);
                break;
            case 6:
                $this->setFechaModificacionCuenta($value);
                break;
        } // switch()
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     * The default key type is the column's BasePeer::TYPE_PHPNAME
     *
     * @param array  $arr     An array to populate the object from.
     * @param string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
    {
        $keys = CuentaPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setIdCuenta($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setNombreCuenta($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setValorCuenta($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setTipoCuenta($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setUserCreaCuenta($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setFechaCreacionCuenta($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setFechaModificacionCuenta($arr[$keys[6]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(CuentaPeer::DATABASE_NAME);

        if ($this->isColumnModified(CuentaPeer::ID_CUENTA)) $criteria->add(CuentaPeer::ID_CUENTA, $this->id_cuenta);
        if ($this->isColumnModified(CuentaPeer::NOMBRE_CUENTA)) $criteria->add(CuentaPeer::NOMBRE_CUENTA, $this->nombre_cuenta);
        if ($this->isColumnModified(CuentaPeer::VALOR_CUENTA)) $criteria->add(CuentaPeer::VALOR_CUENTA, $this->valor_cuenta);
        if ($this->isColumnModified(CuentaPeer::TIPO_CUENTA)) $criteria->add(CuentaPeer::TIPO_CUENTA, $this->tipo_cuenta);
        if ($this->isColumnModified(CuentaPeer::USER_CREA_CUENTA)) $criteria->add(CuentaPeer::USER_CREA_CUENTA, $this->user_crea_cuenta);
        if ($this->isColumnModified(CuentaPeer::FECHA_CREACION_CUENTA)) $criteria->add(CuentaPeer::FECHA_CREACION_CUENTA, $this->fecha_creacion_cuenta);
        if ($this->isColumnModified(CuentaPeer::FECHA_MODIFICACION_CUENTA)) $criteria->add(CuentaPeer::FECHA_MODIFICACION_CUENTA, $this->fecha_modificacion_cuenta);

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = new Criteria(CuentaPeer::DATABASE_NAME);
        $criteria->add(CuentaPeer::ID_CUENTA, $this->id_cuenta);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getIdCuenta();
    }

    /**
     * Generic method to set the primary key (id_cuenta column).
     *
     * @param  int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setIdCuenta($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getIdCuenta();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of Cuenta (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setNombreCuenta($this->getNombreCuenta());
        $copyObj->setValorCuenta($this->getValorCuenta());
        $copyObj->setTipoCuenta($this->getTipoCuenta());
        $copyObj->setUserCreaCuenta($this->getUserCreaCuenta());
        $copyObj->setFechaCreacionCuenta($this->getFechaCreacionCuenta());
        $copyObj->setFechaModificacionCuenta($this->getFechaModificacionCuenta());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getGastos() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addGasto($relObj->copy($deepCopy));
                }
            }

            //unflag object copy
            $this->startCopy = false;
        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdCuenta(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return Cuenta Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Returns a peer instance associated with this om.
     *
     * Since Peer classes are not to have any instance attributes, this method returns the
     * same instance for all member of this class. The method could therefore
     * be static, but this would prevent one from overriding the behavior.
     *
     * @return CuentaPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new CuentaPeer();
        }

        return self::$peer;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('Gasto' == $relationName) {
            $this->initGastos();
        }
    }

    /**
     * Clears out the collGastos collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Cuenta The current object (for fluent API support)
     * @see        addGastos()
     */
    public function clearGastos()
    {
        $this->collGastos = null; // important to set this to null since that means it is uninitialized
        $this->collGastosPartial = null;

        return $this;
    }

    /**
     * reset is the collGastos collection loaded partially
     *
     * @return void
     */
    public function resetPartialGastos($v = true)
    {
        $this->collGastosPartial = $v;
    }

    /**
     * Initializes the collGastos collection.
     *
     * By default this just sets the collGastos collection to an empty array (like clearcollGastos());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initGastos($overrideExisting = true)
    {
        if (null !== $this->collGastos && !$overrideExisting) {
            return;
        }
        $this->collGastos = new PropelObjectCollection();
        $this->collGastos->setModel('Gasto');
    }

    /**
     * Gets an array of Gasto objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Cuenta is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Gasto[] List of Gasto objects
     * @throws PropelException
     */
    public function getGastos($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collGastosPartial && !$this->isNew();
        if (null === $this->collGastos || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collGastos) {
                // return empty collection
                $this->initGastos();
            } else {
                $collGastos = GastoQuery::create(null, $criteria)
                    ->filterByCuenta($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collGastosPartial && count($collGastos)) {
                      $this->initGastos(false);

                      foreach($collGastos as $obj) {
                        if (false == $this->collGastos->contains($obj)) {
                          $this->collGastos->append($obj);
                        }
                      }

                      $this->collGastosPartial = true;
                    }

                    $collGastos->getInternalIterator()->rewind();
                    return $collGastos;
                }

                if($partial && $this->collGastos) {
                    foreach($this->collGastos as $obj) {
                        if($obj->isNew()) {
                            $collGastos[] = $obj;
                        }
                    }
                }

                $this->collGastos = $collGastos;
                $this->collGastosPartial = false;
            }
        }

        return $this->collGastos;
    }

    /**
     * Sets a collection of Gasto objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $gastos A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Cuenta The current object (for fluent API support)
     */
    public function setGastos(PropelCollection $gastos, PropelPDO $con = null)
    {
        $gastosToDelete = $this->getGastos(new Criteria(), $con)->diff($gastos);

        $this->gastosScheduledForDeletion = unserialize(serialize($gastosToDelete));

        foreach ($gastosToDelete as $gastoRemoved) {
            $gastoRemoved->setCuenta(null);
        }

        $this->collGastos = null;
        foreach ($gastos as $gasto) {
            $this->addGasto($gasto);
        }

        $this->collGastos = $gastos;
        $this->collGastosPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Gasto objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Gasto objects.
     * @throws PropelException
     */
    public function countGastos(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collGastosPartial && !$this->isNew();
        if (null === $this->collGastos || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collGastos) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getGastos());
            }
            $query = GastoQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCuenta($this)
                ->count($con);
        }

        return count($this->collGastos);
    }

    /**
     * Method called to associate a Gasto object to this object
     * through the Gasto foreign key attribute.
     *
     * @param    Gasto $l Gasto
     * @return Cuenta The current object (for fluent API support)
     */
    public function addGasto(Gasto $l)
    {
        if ($this->collGastos === null) {
            $this->initGastos();
            $this->collGastosPartial = true;
        }
        if (!in_array($l, $this->collGastos->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddGasto($l);
        }

        return $this;
    }

    /**
     * @param	Gasto $gasto The gasto object to add.
     */
    protected function doAddGasto($gasto)
    {
        $this->collGastos[]= $gasto;
        $gasto->setCuenta($this);
    }

    /**
     * @param	Gasto $gasto The gasto object to remove.
     * @return Cuenta The current object (for fluent API support)
     */
    public function removeGasto($gasto)
    {
        if ($this->getGastos()->contains($gasto)) {
            $this->collGastos->remove($this->collGastos->search($gasto));
            if (null === $this->gastosScheduledForDeletion) {
                $this->gastosScheduledForDeletion = clone $this->collGastos;
                $this->gastosScheduledForDeletion->clear();
            }
            $this->gastosScheduledForDeletion[]= clone $gasto;
            $gasto->setCuenta(null);
        }

        return $this;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id_cuenta = null;
        $this->nombre_cuenta = null;
        $this->valor_cuenta = null;
        $this->tipo_cuenta = null;
        $this->user_crea_cuenta = null;
        $this->fecha_creacion_cuenta = null;
        $this->fecha_modificacion_cuenta = null;
        $this->alreadyInSave = false;
        $this->alreadyInValidation = false;
        $this->alreadyInClearAllReferencesDeep = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references to other model objects or collections of model objects.
     *
     * This method is a user-space workaround for PHP's inability to garbage collect
     * objects with circular references (even in PHP 5.3). This is currently necessary
     * when using Propel in certain daemon or large-volumne/high-memory operations.
     *
     * @param boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep && !$this->alreadyInClearAllReferencesDeep) {
            $this->alreadyInClearAllReferencesDeep = true;
            if ($this->collGastos) {
                foreach ($this->collGastos as $o) {
                    $o->clearAllReferences($deep);
                }
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        if ($this->collGastos instanceof PropelCollection) {
            $this->collGastos->clearIterator();
        }
        $this->collGastos = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(CuentaPeer::DEFAULT_STRING_FORMAT);
    }

    /**
     * return true is the object is in saving state
     *
     * @return boolean
     */
    public function isAlreadyInSave()
    {
        return $this->alreadyInSave;
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return     Cuenta The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[] = CuentaPeer::FECHA_MODIFICACION_CUENTA;

        return $this;
    }

    // aggregate_column behavior

    /**
     * Computes the value of the aggregate column valor_cuenta *
     * @param PropelPDO $con A connection object
     *
     * @return mixed The scalar result from the aggregate query
     */
    public function computeValorCuenta(PropelPDO $con)
    {
        $stmt = $con->prepare('SELECT SUM(costo_gasto) FROM `gasto` WHERE gasto.fk_cuenta = :p1');
        $stmt->bindValue(':p1', $this->getIdCuenta());
        $stmt->execute();

        return $stmt->fetchColumn();
    }

    /**
     * Updates the aggregate column valor_cuenta *
     * @param PropelPDO $con A connection object
     */
    public function updateValorCuenta(PropelPDO $con)
    {
        $this->setValorCuenta($this->computeValorCuenta($con));
        $this->save($con);
    }

}
