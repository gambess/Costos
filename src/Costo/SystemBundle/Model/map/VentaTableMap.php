<?php

namespace Costo\SystemBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'venta' table.
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
class VentaTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.Costo.SystemBundle.Model.map.VentaTableMap';

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
        $this->setName('venta');
        $this->setPhpName('Venta');
        $this->setClassname('Costo\\SystemBundle\\Model\\Venta');
        $this->setPackage('src.Costo.SystemBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id_venta', 'IdVenta', 'INTEGER', true, null, null);
        $this->addColumn('fecha_venta', 'FechaVenta', 'DATE', true, null, null);
        $this->addColumn('total_venta', 'TotalVenta', 'FLOAT', true, 11, 0);
        $this->addColumn('formal_total_venta', 'FormalTotalVenta', 'FLOAT', true, 11, 0);
        $this->addColumn('informal_total_venta', 'InformalTotalVenta', 'FLOAT', true, 11, 0);
        $this->addColumn('total_iva_venta_formal', 'TotalIvaVentaFormal', 'FLOAT', true, 11, 0);
        $this->addColumn('detalle_venta', 'DetalleVenta', 'LONGVARCHAR', false, null, null);
        $this->addColumn('fecha_creacion_venta', 'FechaCreacionVenta', 'TIMESTAMP', false, null, null);
        $this->addColumn('fecha_modificacion_venta', 'FechaModificacionVenta', 'TIMESTAMP', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
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
  'create_column' => 'fecha_creacion_venta',
  'update_column' => 'fecha_modificacion_venta',
  'disable_updated_at' => 'false',
),
        );
    } // getBehaviors()

} // VentaTableMap
