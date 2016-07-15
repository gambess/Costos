<?php

namespace Costo\SystemBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'gasto' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.src.Costo.SystemBundle.Model.map
 */
class GastoTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Costo.SystemBundle.Model.map.GastoTableMap';

    /**
     * Initialize the table attributes, columns and validators
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('gasto');
        $this->setPhpName('Gasto');
        $this->setClassname('Costo\\SystemBundle\\Model\\Gasto');
        $this->setPackage('src.Costo.SystemBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id_gasto', 'IdGasto', 'INTEGER', true, 20, null);
        $this->addForeignKey('fk_cuenta', 'FkCuenta', 'INTEGER', 'cuenta', 'id_cuenta', true, 20, 0);
        $this->addColumn('nombre_gasto', 'NombreGasto', 'VARCHAR', true, 100, null);
        $this->addColumn('costo_gasto', 'CostoGasto', 'FLOAT', true, 11, 0);
        $this->addColumn('fecha_emision_gasto', 'FechaEmisionGasto', 'DATE', false, null, null);
        $this->addColumn('fecha_pago_gasto', 'FechaPagoGasto', 'DATE', false, null, null);
        $this->addColumn('numero_doc_gasto', 'NumeroDocGasto', 'LONGVARCHAR', false, null, null);
        $this->addColumn('fecha_creacion_gasto', 'FechaCreacionGasto', 'TIMESTAMP', false, null, null);
        $this->addColumn('fecha_modificacion_gasto', 'FechaModificacionGasto', 'TIMESTAMP', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Cuenta', 'Costo\\SystemBundle\\Model\\Cuenta', RelationMap::MANY_TO_ONE, array('fk_cuenta' => 'id_cuenta', ), null, null);
    } // buildRelations()

    /**
     *
     * Gets the list of behaviors registered for this table
     *
     * @return array Associative array (name => parameters) of behaviors
     */
    public function getBehaviors()
    {
        return array(
            'timestampable' =>  array (
  'create_column' => 'fecha_creacion_gasto',
  'update_column' => 'fecha_modificacion_gasto',
  'disable_updated_at' => 'false',
),
            'aggregate_column_relation' =>  array (
  'foreign_table' => 'cuenta',
  'update_method' => 'updateValorCuenta',
),
        );
    } // getBehaviors()

} // GastoTableMap
