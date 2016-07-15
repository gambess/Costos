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
use \PropelDateTime;
use \PropelException;
use \PropelPDO;
use Costo\SystemBundle\Model\Cuenta;
use Costo\SystemBundle\Model\CuentaQuery;
use Costo\SystemBundle\Model\Gasto;
use Costo\SystemBundle\Model\GastoPeer;
use Costo\SystemBundle\Model\GastoQuery;

/**
 * Base class that represents a row from the 'gasto' table.
 *
 *
 *
 * @package    propel.generator.src.Costo.SystemBundle.Model.om
 */
abstract class BaseGasto extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Costo\\SystemBundle\\Model\\GastoPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        GastoPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinit loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the id_gasto field.
     * @var        int
     */
    protected $id_gasto;

    /**
     * The value for the fk_cuenta field.
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $fk_cuenta;

    /**
     * The value for the nombre_gasto field.
     * @var        string
     */
    protected $nombre_gasto;

    /**
     * The value for the costo_gasto field.
     * Note: this column has a database default value of: 0
     * @var        double
     */
    protected $costo_gasto;

    /**
     * The value for the fecha_emision_gasto field.
     * @var        string
     */
    protected $fecha_emision_gasto;

    /**
     * The value for the fecha_pago_gasto field.
     * @var        string
     */
    protected $fecha_pago_gasto;

    /**
     * The value for the numero_doc_gasto field.
     * @var        string
     */
    protected $numero_doc_gasto;

    /**
     * The value for the fecha_creacion_gasto field.
     * @var        string
     */
    protected $fecha_creacion_gasto;

    /**
     * The value for the fecha_modificacion_gasto field.
     * @var        string
     */
    protected $fecha_modificacion_gasto;

    /**
     * @var        Cuenta
     */
    protected $aCuenta;

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

    // aggregate_column_relation behavior
    protected $oldCuenta;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see        __construct()
     */
    public function applyDefaultValues()
    {
        $this->fk_cuenta = 0;
        $this->costo_gasto = 0;
    }

    /**
     * Initializes internal state of BaseGasto object.
     * @see        applyDefaults()
     */
    public function __construct()
    {
        parent::__construct();
        $this->applyDefaultValues();
    }

    /**
     * Get the [id_gasto] column value.
     *
     * @return int
     */
    public function getIdGasto()
    {
        return $this->id_gasto;
    }

    /**
     * Get the [fk_cuenta] column value.
     *
     * @return int
     */
    public function getFkCuenta()
    {
        return $this->fk_cuenta;
    }

    /**
     * Get the [nombre_gasto] column value.
     *
     * @return string
     */
    public function getNombreGasto()
    {
        return $this->nombre_gasto;
    }

    /**
     * Get the [costo_gasto] column value.
     *
     * @return double
     */
    public function getCostoGasto()
    {
        return $this->costo_gasto;
    }

    /**
     * Get the [optionally formatted] temporal [fecha_emision_gasto] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getFechaEmisionGasto($format = null)
    {
        if ($this->fecha_emision_gasto === null) {
            return null;
        }

        if ($this->fecha_emision_gasto === '0000-00-00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->fecha_emision_gasto);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->fecha_emision_gasto, true), $x);
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
     * Get the [optionally formatted] temporal [fecha_pago_gasto] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getFechaPagoGasto($format = null)
    {
        if ($this->fecha_pago_gasto === null) {
            return null;
        }

        if ($this->fecha_pago_gasto === '0000-00-00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->fecha_pago_gasto);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->fecha_pago_gasto, true), $x);
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
     * Get the [numero_doc_gasto] column value.
     *
     * @return string
     */
    public function getNumeroDocGasto()
    {
        return $this->numero_doc_gasto;
    }

    /**
     * Get the [optionally formatted] temporal [fecha_creacion_gasto] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getFechaCreacionGasto($format = null)
    {
        if ($this->fecha_creacion_gasto === null) {
            return null;
        }

        if ($this->fecha_creacion_gasto === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->fecha_creacion_gasto);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->fecha_creacion_gasto, true), $x);
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
     * Get the [optionally formatted] temporal [fecha_modificacion_gasto] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getFechaModificacionGasto($format = null)
    {
        if ($this->fecha_modificacion_gasto === null) {
            return null;
        }

        if ($this->fecha_modificacion_gasto === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->fecha_modificacion_gasto);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->fecha_modificacion_gasto, true), $x);
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
     * Set the value of [id_gasto] column.
     *
     * @param int $v new value
     * @return Gasto The current object (for fluent API support)
     */
    public function setIdGasto($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id_gasto !== $v) {
            $this->id_gasto = $v;
            $this->modifiedColumns[] = GastoPeer::ID_GASTO;
        }


        return $this;
    } // setIdGasto()

    /**
     * Set the value of [fk_cuenta] column.
     *
     * @param int $v new value
     * @return Gasto The current object (for fluent API support)
     */
    public function setFkCuenta($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->fk_cuenta !== $v) {
            $this->fk_cuenta = $v;
            $this->modifiedColumns[] = GastoPeer::FK_CUENTA;
        }

        if ($this->aCuenta !== null && $this->aCuenta->getIdCuenta() !== $v) {
            $this->aCuenta = null;
        }


        return $this;
    } // setFkCuenta()

    /**
     * Set the value of [nombre_gasto] column.
     *
     * @param string $v new value
     * @return Gasto The current object (for fluent API support)
     */
    public function setNombreGasto($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->nombre_gasto !== $v) {
            $this->nombre_gasto = $v;
            $this->modifiedColumns[] = GastoPeer::NOMBRE_GASTO;
        }


        return $this;
    } // setNombreGasto()

    /**
     * Set the value of [costo_gasto] column.
     *
     * @param double $v new value
     * @return Gasto The current object (for fluent API support)
     */
    public function setCostoGasto($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (double) $v;
        }

        if ($this->costo_gasto !== $v) {
            $this->costo_gasto = $v;
            $this->modifiedColumns[] = GastoPeer::COSTO_GASTO;
        }


        return $this;
    } // setCostoGasto()

    /**
     * Sets the value of [fecha_emision_gasto] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Gasto The current object (for fluent API support)
     */
    public function setFechaEmisionGasto($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->fecha_emision_gasto !== null || $dt !== null) {
            $currentDateAsString = ($this->fecha_emision_gasto !== null && $tmpDt = new DateTime($this->fecha_emision_gasto)) ? $tmpDt->format('Y-m-d') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->fecha_emision_gasto = $newDateAsString;
                $this->modifiedColumns[] = GastoPeer::FECHA_EMISION_GASTO;
            }
        } // if either are not null


        return $this;
    } // setFechaEmisionGasto()

    /**
     * Sets the value of [fecha_pago_gasto] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Gasto The current object (for fluent API support)
     */
    public function setFechaPagoGasto($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->fecha_pago_gasto !== null || $dt !== null) {
            $currentDateAsString = ($this->fecha_pago_gasto !== null && $tmpDt = new DateTime($this->fecha_pago_gasto)) ? $tmpDt->format('Y-m-d') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->fecha_pago_gasto = $newDateAsString;
                $this->modifiedColumns[] = GastoPeer::FECHA_PAGO_GASTO;
            }
        } // if either are not null


        return $this;
    } // setFechaPagoGasto()

    /**
     * Set the value of [numero_doc_gasto] column.
     *
     * @param string $v new value
     * @return Gasto The current object (for fluent API support)
     */
    public function setNumeroDocGasto($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->numero_doc_gasto !== $v) {
            $this->numero_doc_gasto = $v;
            $this->modifiedColumns[] = GastoPeer::NUMERO_DOC_GASTO;
        }


        return $this;
    } // setNumeroDocGasto()

    /**
     * Sets the value of [fecha_creacion_gasto] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Gasto The current object (for fluent API support)
     */
    public function setFechaCreacionGasto($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->fecha_creacion_gasto !== null || $dt !== null) {
            $currentDateAsString = ($this->fecha_creacion_gasto !== null && $tmpDt = new DateTime($this->fecha_creacion_gasto)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->fecha_creacion_gasto = $newDateAsString;
                $this->modifiedColumns[] = GastoPeer::FECHA_CREACION_GASTO;
            }
        } // if either are not null


        return $this;
    } // setFechaCreacionGasto()

    /**
     * Sets the value of [fecha_modificacion_gasto] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Gasto The current object (for fluent API support)
     */
    public function setFechaModificacionGasto($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->fecha_modificacion_gasto !== null || $dt !== null) {
            $currentDateAsString = ($this->fecha_modificacion_gasto !== null && $tmpDt = new DateTime($this->fecha_modificacion_gasto)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->fecha_modificacion_gasto = $newDateAsString;
                $this->modifiedColumns[] = GastoPeer::FECHA_MODIFICACION_GASTO;
            }
        } // if either are not null


        return $this;
    } // setFechaModificacionGasto()

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
            if ($this->fk_cuenta !== 0) {
                return false;
            }

            if ($this->costo_gasto !== 0) {
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

            $this->id_gasto = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->fk_cuenta = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
            $this->nombre_gasto = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->costo_gasto = ($row[$startcol + 3] !== null) ? (double) $row[$startcol + 3] : null;
            $this->fecha_emision_gasto = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->fecha_pago_gasto = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->numero_doc_gasto = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->fecha_creacion_gasto = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->fecha_modificacion_gasto = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);
            return $startcol + 9; // 9 = GastoPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Gasto object", $e);
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

        if ($this->aCuenta !== null && $this->fk_cuenta !== $this->aCuenta->getIdCuenta()) {
            $this->aCuenta = null;
        }
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
            $con = Propel::getConnection(GastoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = GastoPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCuenta = null;
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
            $con = Propel::getConnection(GastoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = GastoQuery::create()
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
            $con = Propel::getConnection(GastoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                if (!$this->isColumnModified(GastoPeer::FECHA_CREACION_GASTO)) {
                    $this->setFechaCreacionGasto(time());
                }
                if (!$this->isColumnModified(GastoPeer::FECHA_MODIFICACION_GASTO)) {
                    $this->setFechaModificacionGasto(time());
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(GastoPeer::FECHA_MODIFICACION_GASTO)) {
                    $this->setFechaModificacionGasto(time());
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
                // aggregate_column_relation behavior
                $this->updateRelatedCuenta($con);
                GastoPeer::addInstanceToPool($this);
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

            // We call the save method on the following object(s) if they
            // were passed to this object by their coresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aCuenta !== null) {
                if ($this->aCuenta->isModified() || $this->aCuenta->isNew()) {
                    $affectedRows += $this->aCuenta->save($con);
                }
                $this->setCuenta($this->aCuenta);
            }

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
     * @param PropelPDO $con
     *
     * @throws PropelException
     * @see        doSave()
     */
    protected function doInsert(PropelPDO $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[] = GastoPeer::ID_GASTO;
        if (null !== $this->id_gasto) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . GastoPeer::ID_GASTO . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(GastoPeer::ID_GASTO)) {
            $modifiedColumns[':p' . $index++]  = '`id_gasto`';
        }
        if ($this->isColumnModified(GastoPeer::FK_CUENTA)) {
            $modifiedColumns[':p' . $index++]  = '`fk_cuenta`';
        }
        if ($this->isColumnModified(GastoPeer::NOMBRE_GASTO)) {
            $modifiedColumns[':p' . $index++]  = '`nombre_gasto`';
        }
        if ($this->isColumnModified(GastoPeer::COSTO_GASTO)) {
            $modifiedColumns[':p' . $index++]  = '`costo_gasto`';
        }
        if ($this->isColumnModified(GastoPeer::FECHA_EMISION_GASTO)) {
            $modifiedColumns[':p' . $index++]  = '`fecha_emision_gasto`';
        }
        if ($this->isColumnModified(GastoPeer::FECHA_PAGO_GASTO)) {
            $modifiedColumns[':p' . $index++]  = '`fecha_pago_gasto`';
        }
        if ($this->isColumnModified(GastoPeer::NUMERO_DOC_GASTO)) {
            $modifiedColumns[':p' . $index++]  = '`numero_doc_gasto`';
        }
        if ($this->isColumnModified(GastoPeer::FECHA_CREACION_GASTO)) {
            $modifiedColumns[':p' . $index++]  = '`fecha_creacion_gasto`';
        }
        if ($this->isColumnModified(GastoPeer::FECHA_MODIFICACION_GASTO)) {
            $modifiedColumns[':p' . $index++]  = '`fecha_modificacion_gasto`';
        }

        $sql = sprintf(
            'INSERT INTO `gasto` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`id_gasto`':
                        $stmt->bindValue($identifier, $this->id_gasto, PDO::PARAM_INT);
                        break;
                    case '`fk_cuenta`':
                        $stmt->bindValue($identifier, $this->fk_cuenta, PDO::PARAM_INT);
                        break;
                    case '`nombre_gasto`':
                        $stmt->bindValue($identifier, $this->nombre_gasto, PDO::PARAM_STR);
                        break;
                    case '`costo_gasto`':
                        $stmt->bindValue($identifier, $this->costo_gasto, PDO::PARAM_STR);
                        break;
                    case '`fecha_emision_gasto`':
                        $stmt->bindValue($identifier, $this->fecha_emision_gasto, PDO::PARAM_STR);
                        break;
                    case '`fecha_pago_gasto`':
                        $stmt->bindValue($identifier, $this->fecha_pago_gasto, PDO::PARAM_STR);
                        break;
                    case '`numero_doc_gasto`':
                        $stmt->bindValue($identifier, $this->numero_doc_gasto, PDO::PARAM_STR);
                        break;
                    case '`fecha_creacion_gasto`':
                        $stmt->bindValue($identifier, $this->fecha_creacion_gasto, PDO::PARAM_STR);
                        break;
                    case '`fecha_modificacion_gasto`':
                        $stmt->bindValue($identifier, $this->fecha_modificacion_gasto, PDO::PARAM_STR);
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
        $this->setIdGasto($pk);

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


            // We call the validate method on the following object(s) if they
            // were passed to this object by their coresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aCuenta !== null) {
                if (!$this->aCuenta->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aCuenta->getValidationFailures());
                }
            }


            if (($retval = GastoPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
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
        $pos = GastoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getIdGasto();
                break;
            case 1:
                return $this->getFkCuenta();
                break;
            case 2:
                return $this->getNombreGasto();
                break;
            case 3:
                return $this->getCostoGasto();
                break;
            case 4:
                return $this->getFechaEmisionGasto();
                break;
            case 5:
                return $this->getFechaPagoGasto();
                break;
            case 6:
                return $this->getNumeroDocGasto();
                break;
            case 7:
                return $this->getFechaCreacionGasto();
                break;
            case 8:
                return $this->getFechaModificacionGasto();
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
        if (isset($alreadyDumpedObjects['Gasto'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Gasto'][$this->getPrimaryKey()] = true;
        $keys = GastoPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getIdGasto(),
            $keys[1] => $this->getFkCuenta(),
            $keys[2] => $this->getNombreGasto(),
            $keys[3] => $this->getCostoGasto(),
            $keys[4] => $this->getFechaEmisionGasto(),
            $keys[5] => $this->getFechaPagoGasto(),
            $keys[6] => $this->getNumeroDocGasto(),
            $keys[7] => $this->getFechaCreacionGasto(),
            $keys[8] => $this->getFechaModificacionGasto(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aCuenta) {
                $result['Cuenta'] = $this->aCuenta->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
        $pos = GastoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setIdGasto($value);
                break;
            case 1:
                $this->setFkCuenta($value);
                break;
            case 2:
                $this->setNombreGasto($value);
                break;
            case 3:
                $this->setCostoGasto($value);
                break;
            case 4:
                $this->setFechaEmisionGasto($value);
                break;
            case 5:
                $this->setFechaPagoGasto($value);
                break;
            case 6:
                $this->setNumeroDocGasto($value);
                break;
            case 7:
                $this->setFechaCreacionGasto($value);
                break;
            case 8:
                $this->setFechaModificacionGasto($value);
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
        $keys = GastoPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setIdGasto($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setFkCuenta($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setNombreGasto($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setCostoGasto($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setFechaEmisionGasto($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setFechaPagoGasto($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setNumeroDocGasto($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setFechaCreacionGasto($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setFechaModificacionGasto($arr[$keys[8]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(GastoPeer::DATABASE_NAME);

        if ($this->isColumnModified(GastoPeer::ID_GASTO)) $criteria->add(GastoPeer::ID_GASTO, $this->id_gasto);
        if ($this->isColumnModified(GastoPeer::FK_CUENTA)) $criteria->add(GastoPeer::FK_CUENTA, $this->fk_cuenta);
        if ($this->isColumnModified(GastoPeer::NOMBRE_GASTO)) $criteria->add(GastoPeer::NOMBRE_GASTO, $this->nombre_gasto);
        if ($this->isColumnModified(GastoPeer::COSTO_GASTO)) $criteria->add(GastoPeer::COSTO_GASTO, $this->costo_gasto);
        if ($this->isColumnModified(GastoPeer::FECHA_EMISION_GASTO)) $criteria->add(GastoPeer::FECHA_EMISION_GASTO, $this->fecha_emision_gasto);
        if ($this->isColumnModified(GastoPeer::FECHA_PAGO_GASTO)) $criteria->add(GastoPeer::FECHA_PAGO_GASTO, $this->fecha_pago_gasto);
        if ($this->isColumnModified(GastoPeer::NUMERO_DOC_GASTO)) $criteria->add(GastoPeer::NUMERO_DOC_GASTO, $this->numero_doc_gasto);
        if ($this->isColumnModified(GastoPeer::FECHA_CREACION_GASTO)) $criteria->add(GastoPeer::FECHA_CREACION_GASTO, $this->fecha_creacion_gasto);
        if ($this->isColumnModified(GastoPeer::FECHA_MODIFICACION_GASTO)) $criteria->add(GastoPeer::FECHA_MODIFICACION_GASTO, $this->fecha_modificacion_gasto);

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
        $criteria = new Criteria(GastoPeer::DATABASE_NAME);
        $criteria->add(GastoPeer::ID_GASTO, $this->id_gasto);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getIdGasto();
    }

    /**
     * Generic method to set the primary key (id_gasto column).
     *
     * @param  int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setIdGasto($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getIdGasto();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of Gasto (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setFkCuenta($this->getFkCuenta());
        $copyObj->setNombreGasto($this->getNombreGasto());
        $copyObj->setCostoGasto($this->getCostoGasto());
        $copyObj->setFechaEmisionGasto($this->getFechaEmisionGasto());
        $copyObj->setFechaPagoGasto($this->getFechaPagoGasto());
        $copyObj->setNumeroDocGasto($this->getNumeroDocGasto());
        $copyObj->setFechaCreacionGasto($this->getFechaCreacionGasto());
        $copyObj->setFechaModificacionGasto($this->getFechaModificacionGasto());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            //unflag object copy
            $this->startCopy = false;
        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdGasto(NULL); // this is a auto-increment column, so set to default value
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
     * @return Gasto Clone of current object.
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
     * @return GastoPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new GastoPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a Cuenta object.
     *
     * @param             Cuenta $v
     * @return Gasto The current object (for fluent API support)
     * @throws PropelException
     */
    public function setCuenta(Cuenta $v = null)
    {
        // aggregate_column_relation behavior
        if (null !== $this->aCuenta && $v !== $this->aCuenta) {
            $this->oldCuenta = $this->aCuenta;
        }
        if ($v === null) {
            $this->setFkCuenta(0);
        } else {
            $this->setFkCuenta($v->getIdCuenta());
        }

        $this->aCuenta = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Cuenta object, it will not be re-added.
        if ($v !== null) {
            $v->addGasto($this);
        }


        return $this;
    }


    /**
     * Get the associated Cuenta object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return Cuenta The associated Cuenta object.
     * @throws PropelException
     */
    public function getCuenta(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aCuenta === null && ($this->fk_cuenta !== null) && $doQuery) {
            $this->aCuenta = CuentaQuery::create()->findPk($this->fk_cuenta, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCuenta->addGastos($this);
             */
        }

        return $this->aCuenta;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id_gasto = null;
        $this->fk_cuenta = null;
        $this->nombre_gasto = null;
        $this->costo_gasto = null;
        $this->fecha_emision_gasto = null;
        $this->fecha_pago_gasto = null;
        $this->numero_doc_gasto = null;
        $this->fecha_creacion_gasto = null;
        $this->fecha_modificacion_gasto = null;
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
            if ($this->aCuenta instanceof Persistent) {
              $this->aCuenta->clearAllReferences($deep);
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        $this->aCuenta = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(GastoPeer::DEFAULT_STRING_FORMAT);
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
     * @return     Gasto The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[] = GastoPeer::FECHA_MODIFICACION_GASTO;

        return $this;
    }

    // aggregate_column_relation behavior

    /**
     * Update the aggregate column in the related Cuenta object
     *
     * @param PropelPDO $con A connection object
     */
    protected function updateRelatedCuenta(PropelPDO $con)
    {
        if ($cuenta = $this->getCuenta()) {
            if (!$cuenta->isAlreadyInSave()) {
                $cuenta->updateValorCuenta($con);
            }
        }
        if ($this->oldCuenta) {
            $this->oldCuenta->updateValorCuenta($con);
            $this->oldCuenta = null;
        }
    }

}
