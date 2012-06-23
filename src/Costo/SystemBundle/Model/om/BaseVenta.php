<?php

namespace Costo\SystemBundle\Model\om;

use \BaseObject;
use \BasePeer;
use \Criteria;
use \DateTime;
use \DateTimeZone;
use \Exception;
use \PDO;
use \Persistent;
use \Propel;
use \PropelCollection;
use \PropelDateTime;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use Costo\SystemBundle\Model\Venta;
use Costo\SystemBundle\Model\VentaPeer;
use Costo\SystemBundle\Model\VentaQuery;

/**
 * Base class that represents a row from the 'ajuste_venta' table.
 *
 * 
 *
 * @package    propel.generator.src.Costo.SystemBundle.Model.om
 */
abstract class BaseVenta extends BaseObject 
{

    /**
     * Peer class name
     */
    const PEER = 'Costo\\SystemBundle\\Model\\VentaPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        VentaPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinit loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the id_ajuste_venta field.
     * @var        int
     */
    protected $id_ajuste_venta;

    /**
     * The value for the fk_venta field.
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $fk_venta;

    /**
     * The value for the fecha_venta field.
     * Note: this column has a database default value of: (expression) CURRENT_TIMESTAMP
     * @var        string
     */
    protected $fecha_venta;

    /**
     * The value for the tipo_venta field.
     * Note: this column has a database default value of: 'FORMAL'
     * @var        string
     */
    protected $tipo_venta;

    /**
     * The value for the total_venta field.
     * Note: this column has a database default value of: 0
     * @var        double
     */
    protected $total_venta;

    /**
     * The value for the total_venta_formal field.
     * Note: this column has a database default value of: 0
     * @var        double
     */
    protected $total_venta_formal;

    /**
     * The value for the total_venta_informal field.
     * Note: this column has a database default value of: 0
     * @var        double
     */
    protected $total_venta_informal;

    /**
     * The value for the total_iva_venta field.
     * Note: this column has a database default value of: 0
     * @var        double
     */
    protected $total_iva_venta;

    /**
     * The value for the detalle_venta field.
     * @var        string
     */
    protected $detalle_venta;

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
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see        __construct()
     */
    public function applyDefaultValues()
    {
        $this->fk_venta = 0;
        $this->tipo_venta = 'FORMAL';
        $this->total_venta = 0;
        $this->total_venta_formal = 0;
        $this->total_venta_informal = 0;
        $this->total_iva_venta = 0;
    }

    /**
     * Initializes internal state of BaseVenta object.
     * @see        applyDefaults()
     */
    public function __construct()
    {
        parent::__construct();
        $this->applyDefaultValues();
    }

    /**
     * Get the [id_ajuste_venta] column value.
     * 
     * @return   int
     */
    public function getIdVenta()
    {

        return $this->id_ajuste_venta;
    }

    /**
     * Get the [fk_venta] column value.
     * 
     * @return   int
     */
    public function getFkVenta()
    {

        return $this->fk_venta;
    }

    /**
     * Get the [optionally formatted] temporal [fecha_venta] column value.
     * 
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *							If format is NULL, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getFechaVenta($format = NULL)
    {
        if ($this->fecha_venta === null) {
            return null;
        }


        if ($this->fecha_venta === '0000-00-00 00:00:00') {
            // while technically this is not a default value of NULL,
            // this seems to be closest in meaning.
            return null;
        } else {
            try {
                $dt = new DateTime($this->fecha_venta);
            } catch (Exception $x) {
                throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->fecha_venta, true), $x);
            }
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is TRUE, we return a DateTime object.
            return $dt;
        } elseif (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        } else {
            return $dt->format($format);
        }
    }

    /**
     * Get the [tipo_venta] column value.
     * 
     * @return   string
     */
    public function getTipoVenta()
    {

        return $this->tipo_venta;
    }

    /**
     * Get the [total_venta] column value.
     * 
     * @return   double
     */
    public function getTotalVenta()
    {

        return $this->total_venta;
    }

    /**
     * Get the [total_venta_formal] column value.
     * 
     * @return   double
     */
    public function getTotalVentaFormal()
    {

        return $this->total_venta_formal;
    }

    /**
     * Get the [total_venta_informal] column value.
     * 
     * @return   double
     */
    public function getTotalVentaInformal()
    {

        return $this->total_venta_informal;
    }

    /**
     * Get the [total_iva_venta] column value.
     * 
     * @return   double
     */
    public function getTotalIvaVenta()
    {

        return $this->total_iva_venta;
    }

    /**
     * Get the [detalle_venta] column value.
     * 
     * @return   string
     */
    public function getDetalleVenta()
    {

        return $this->detalle_venta;
    }

    /**
     * Set the value of [id_ajuste_venta] column.
     * 
     * @param      int $v new value
     * @return   Venta The current object (for fluent API support)
     */
    public function setIdVenta($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_ajuste_venta !== $v) {
            $this->id_ajuste_venta = $v;
            $this->modifiedColumns[] = VentaPeer::ID_AJUSTE_VENTA;
        }


        return $this;
    } // setIdVenta()

    /**
     * Set the value of [fk_venta] column.
     * 
     * @param      int $v new value
     * @return   Venta The current object (for fluent API support)
     */
    public function setFkVenta($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->fk_venta !== $v) {
            $this->fk_venta = $v;
            $this->modifiedColumns[] = VentaPeer::FK_VENTA;
        }


        return $this;
    } // setFkVenta()

    /**
     * Sets the value of [fecha_venta] column to a normalized version of the date/time value specified.
     * 
     * @param      mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as NULL.
     * @return   Venta The current object (for fluent API support)
     */
    public function setFechaVenta($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->fecha_venta !== null || $dt !== null) {
            $currentDateAsString = ($this->fecha_venta !== null && $tmpDt = new DateTime($this->fecha_venta)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->fecha_venta = $newDateAsString;
                $this->modifiedColumns[] = VentaPeer::FECHA_VENTA;
            }
        } // if either are not null


        return $this;
    } // setFechaVenta()

    /**
     * Set the value of [tipo_venta] column.
     * 
     * @param      string $v new value
     * @return   Venta The current object (for fluent API support)
     */
    public function setTipoVenta($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->tipo_venta !== $v) {
            $this->tipo_venta = $v;
            $this->modifiedColumns[] = VentaPeer::TIPO_VENTA;
        }


        return $this;
    } // setTipoVenta()

    /**
     * Set the value of [total_venta] column.
     * 
     * @param      double $v new value
     * @return   Venta The current object (for fluent API support)
     */
    public function setTotalVenta($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->total_venta !== $v) {
            $this->total_venta = $v;
            $this->modifiedColumns[] = VentaPeer::TOTAL_VENTA;
        }


        return $this;
    } // setTotalVenta()

    /**
     * Set the value of [total_venta_formal] column.
     * 
     * @param      double $v new value
     * @return   Venta The current object (for fluent API support)
     */
    public function setTotalVentaFormal($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->total_venta_formal !== $v) {
            $this->total_venta_formal = $v;
            $this->modifiedColumns[] = VentaPeer::TOTAL_VENTA_FORMAL;
        }


        return $this;
    } // setTotalVentaFormal()

    /**
     * Set the value of [total_venta_informal] column.
     * 
     * @param      double $v new value
     * @return   Venta The current object (for fluent API support)
     */
    public function setTotalVentaInformal($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->total_venta_informal !== $v) {
            $this->total_venta_informal = $v;
            $this->modifiedColumns[] = VentaPeer::TOTAL_VENTA_INFORMAL;
        }


        return $this;
    } // setTotalVentaInformal()

    /**
     * Set the value of [total_iva_venta] column.
     * 
     * @param      double $v new value
     * @return   Venta The current object (for fluent API support)
     */
    public function setTotalIvaVenta($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->total_iva_venta !== $v) {
            $this->total_iva_venta = $v;
            $this->modifiedColumns[] = VentaPeer::TOTAL_IVA_VENTA;
        }


        return $this;
    } // setTotalIvaVenta()

    /**
     * Set the value of [detalle_venta] column.
     * 
     * @param      string $v new value
     * @return   Venta The current object (for fluent API support)
     */
    public function setDetalleVenta($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->detalle_venta !== $v) {
            $this->detalle_venta = $v;
            $this->modifiedColumns[] = VentaPeer::DETALLE_VENTA;
        }


        return $this;
    } // setDetalleVenta()

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
            if ($this->fk_venta !== 0) {
                return false;
            }

            if ($this->tipo_venta !== 'FORMAL') {
                return false;
            }

            if ($this->total_venta !== 0) {
                return false;
            }

            if ($this->total_venta_formal !== 0) {
                return false;
            }

            if ($this->total_venta_informal !== 0) {
                return false;
            }

            if ($this->total_iva_venta !== 0) {
                return false;
            }

        // otherwise, everything was equal, so return TRUE
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
     * @param      array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
     * @param      int $startcol 0-based offset column which indicates which restultset column to start with.
     * @param      boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false)
    {
        try {

            $this->id_ajuste_venta = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->fk_venta = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
            $this->fecha_venta = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->tipo_venta = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->total_venta = ($row[$startcol + 4] !== null) ? (double) $row[$startcol + 4] : null;
            $this->total_venta_formal = ($row[$startcol + 5] !== null) ? (double) $row[$startcol + 5] : null;
            $this->total_venta_informal = ($row[$startcol + 6] !== null) ? (double) $row[$startcol + 6] : null;
            $this->total_iva_venta = ($row[$startcol + 7] !== null) ? (double) $row[$startcol + 7] : null;
            $this->detalle_venta = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 9; // 9 = VentaPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Venta object", $e);
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
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      PropelPDO $con (optional) The PropelPDO connection to use.
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
            $con = Propel::getConnection(VentaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = VentaPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      PropelPDO $con
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
            $con = Propel::getConnection(VentaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = VentaQuery::create()
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
     * @param      PropelPDO $con
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
            $con = Propel::getConnection(VentaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                VentaPeer::addInstanceToPool($this);
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
     * @param      PropelPDO $con
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

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      PropelPDO $con
     *
     * @throws PropelException
     * @see        doSave()
     */
    protected function doInsert(PropelPDO $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[] = VentaPeer::ID_AJUSTE_VENTA;
        if (null !== $this->id_ajuste_venta) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . VentaPeer::ID_AJUSTE_VENTA . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(VentaPeer::ID_AJUSTE_VENTA)) {
            $modifiedColumns[':p' . $index++]  = '`ID_AJUSTE_VENTA`';
        }
        if ($this->isColumnModified(VentaPeer::FK_VENTA)) {
            $modifiedColumns[':p' . $index++]  = '`FK_VENTA`';
        }
        if ($this->isColumnModified(VentaPeer::FECHA_VENTA)) {
            $modifiedColumns[':p' . $index++]  = '`FECHA_VENTA`';
        }
        if ($this->isColumnModified(VentaPeer::TIPO_VENTA)) {
            $modifiedColumns[':p' . $index++]  = '`TIPO_VENTA`';
        }
        if ($this->isColumnModified(VentaPeer::TOTAL_VENTA)) {
            $modifiedColumns[':p' . $index++]  = '`TOTAL_VENTA`';
        }
        if ($this->isColumnModified(VentaPeer::TOTAL_VENTA_FORMAL)) {
            $modifiedColumns[':p' . $index++]  = '`TOTAL_VENTA_FORMAL`';
        }
        if ($this->isColumnModified(VentaPeer::TOTAL_VENTA_INFORMAL)) {
            $modifiedColumns[':p' . $index++]  = '`TOTAL_VENTA_INFORMAL`';
        }
        if ($this->isColumnModified(VentaPeer::TOTAL_IVA_VENTA)) {
            $modifiedColumns[':p' . $index++]  = '`TOTAL_IVA_VENTA`';
        }
        if ($this->isColumnModified(VentaPeer::DETALLE_VENTA)) {
            $modifiedColumns[':p' . $index++]  = '`DETALLE_VENTA`';
        }

        $sql = sprintf(
            'INSERT INTO `ajuste_venta` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`ID_AJUSTE_VENTA`':
						$stmt->bindValue($identifier, $this->id_ajuste_venta, PDO::PARAM_INT);
                        break;
                    case '`FK_VENTA`':
						$stmt->bindValue($identifier, $this->fk_venta, PDO::PARAM_INT);
                        break;
                    case '`FECHA_VENTA`':
						$stmt->bindValue($identifier, $this->fecha_venta, PDO::PARAM_STR);
                        break;
                    case '`TIPO_VENTA`':
						$stmt->bindValue($identifier, $this->tipo_venta, PDO::PARAM_STR);
                        break;
                    case '`TOTAL_VENTA`':
						$stmt->bindValue($identifier, $this->total_venta, PDO::PARAM_STR);
                        break;
                    case '`TOTAL_VENTA_FORMAL`':
						$stmt->bindValue($identifier, $this->total_venta_formal, PDO::PARAM_STR);
                        break;
                    case '`TOTAL_VENTA_INFORMAL`':
						$stmt->bindValue($identifier, $this->total_venta_informal, PDO::PARAM_STR);
                        break;
                    case '`TOTAL_IVA_VENTA`':
						$stmt->bindValue($identifier, $this->total_iva_venta, PDO::PARAM_STR);
                        break;
                    case '`DETALLE_VENTA`':
						$stmt->bindValue($identifier, $this->detalle_venta, PDO::PARAM_STR);
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
        $this->setIdVenta($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      PropelPDO $con
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
     * @param      mixed $columns Column name or an array of column names.
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
        } else {
            $this->validationFailures = $res;

            return false;
        }
    }

    /**
     * This function performs the validation work for complex object models.
     *
     * In addition to checking the current object, all related objects will
     * also be validated.  If all pass then <code>true</code> is returned; otherwise
     * an aggreagated array of ValidationFailed objects will be returned.
     *
     * @param      array $columns Array of column names to validate.
     * @return mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
     */
    protected function doValidate($columns = null)
    {
        if (!$this->alreadyInValidation) {
            $this->alreadyInValidation = true;
            $retval = null;

            $failureMap = array();


            if (($retval = VentaPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }



            $this->alreadyInValidation = false;
        }

        return (!empty($failureMap) ? $failureMap : true);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                     Defaults to BasePeer::TYPE_PHPNAME
     * @return mixed Value of field.
     */
    public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = VentaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getIdVenta();
                break;
            case 1:
                return $this->getFkVenta();
                break;
            case 2:
                return $this->getFechaVenta();
                break;
            case 3:
                return $this->getTipoVenta();
                break;
            case 4:
                return $this->getTotalVenta();
                break;
            case 5:
                return $this->getTotalVentaFormal();
                break;
            case 6:
                return $this->getTotalVentaInformal();
                break;
            case 7:
                return $this->getTotalIvaVenta();
                break;
            case 8:
                return $this->getDetalleVenta();
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
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array())
    {
        if (isset($alreadyDumpedObjects['Venta'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Venta'][$this->getPrimaryKey()] = true;
        $keys = VentaPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getIdVenta(),
            $keys[1] => $this->getFkVenta(),
            $keys[2] => $this->getFechaVenta(),
            $keys[3] => $this->getTipoVenta(),
            $keys[4] => $this->getTotalVenta(),
            $keys[5] => $this->getTotalVentaFormal(),
            $keys[6] => $this->getTotalVentaInformal(),
            $keys[7] => $this->getTotalIvaVenta(),
            $keys[8] => $this->getDetalleVenta(),
        );

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param      string $name peer name
     * @param      mixed $value field value
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                     Defaults to BasePeer::TYPE_PHPNAME
     * @return void
     */
    public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = VentaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

        $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @param      mixed $value field value
     * @return void
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setIdVenta($value);
                break;
            case 1:
                $this->setFkVenta($value);
                break;
            case 2:
                $this->setFechaVenta($value);
                break;
            case 3:
                $this->setTipoVenta($value);
                break;
            case 4:
                $this->setTotalVenta($value);
                break;
            case 5:
                $this->setTotalVentaFormal($value);
                break;
            case 6:
                $this->setTotalVentaInformal($value);
                break;
            case 7:
                $this->setTotalIvaVenta($value);
                break;
            case 8:
                $this->setDetalleVenta($value);
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
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
    {
        $keys = VentaPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setIdVenta($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setFkVenta($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setFechaVenta($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setTipoVenta($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setTotalVenta($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setTotalVentaFormal($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setTotalVentaInformal($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setTotalIvaVenta($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setDetalleVenta($arr[$keys[8]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(VentaPeer::DATABASE_NAME);

        if ($this->isColumnModified(VentaPeer::ID_AJUSTE_VENTA)) $criteria->add(VentaPeer::ID_AJUSTE_VENTA, $this->id_ajuste_venta);
        if ($this->isColumnModified(VentaPeer::FK_VENTA)) $criteria->add(VentaPeer::FK_VENTA, $this->fk_venta);
        if ($this->isColumnModified(VentaPeer::FECHA_VENTA)) $criteria->add(VentaPeer::FECHA_VENTA, $this->fecha_venta);
        if ($this->isColumnModified(VentaPeer::TIPO_VENTA)) $criteria->add(VentaPeer::TIPO_VENTA, $this->tipo_venta);
        if ($this->isColumnModified(VentaPeer::TOTAL_VENTA)) $criteria->add(VentaPeer::TOTAL_VENTA, $this->total_venta);
        if ($this->isColumnModified(VentaPeer::TOTAL_VENTA_FORMAL)) $criteria->add(VentaPeer::TOTAL_VENTA_FORMAL, $this->total_venta_formal);
        if ($this->isColumnModified(VentaPeer::TOTAL_VENTA_INFORMAL)) $criteria->add(VentaPeer::TOTAL_VENTA_INFORMAL, $this->total_venta_informal);
        if ($this->isColumnModified(VentaPeer::TOTAL_IVA_VENTA)) $criteria->add(VentaPeer::TOTAL_IVA_VENTA, $this->total_iva_venta);
        if ($this->isColumnModified(VentaPeer::DETALLE_VENTA)) $criteria->add(VentaPeer::DETALLE_VENTA, $this->detalle_venta);

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
        $criteria = new Criteria(VentaPeer::DATABASE_NAME);
        $criteria->add(VentaPeer::ID_AJUSTE_VENTA, $this->id_ajuste_venta);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return   int
     */
    public function getPrimaryKey()
    {
        return $this->getIdVenta();
    }

    /**
     * Generic method to set the primary key (id_ajuste_venta column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setIdVenta($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getIdVenta();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of Venta (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setFkVenta($this->getFkVenta());
        $copyObj->setFechaVenta($this->getFechaVenta());
        $copyObj->setTipoVenta($this->getTipoVenta());
        $copyObj->setTotalVenta($this->getTotalVenta());
        $copyObj->setTotalVentaFormal($this->getTotalVentaFormal());
        $copyObj->setTotalVentaInformal($this->getTotalVentaInformal());
        $copyObj->setTotalIvaVenta($this->getTotalIvaVenta());
        $copyObj->setDetalleVenta($this->getDetalleVenta());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdVenta(NULL); // this is a auto-increment column, so set to default value
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
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return                 Venta Clone of current object.
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
     * @return   VentaPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new VentaPeer();
        }

        return self::$peer;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id_ajuste_venta = null;
        $this->fk_venta = null;
        $this->fecha_venta = null;
        $this->tipo_venta = null;
        $this->total_venta = null;
        $this->total_venta_formal = null;
        $this->total_venta_informal = null;
        $this->total_iva_venta = null;
        $this->detalle_venta = null;
        $this->alreadyInSave = false;
        $this->alreadyInValidation = false;
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
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
        } // if ($deep)

    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(VentaPeer::DEFAULT_STRING_FORMAT);
    }

} // BaseVenta
