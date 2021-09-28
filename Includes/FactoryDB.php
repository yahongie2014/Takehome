<?php

namespace Includes;

class FactoryDB
{
    public function insertInto($tableName, $colums)
    {
        global $db;

        if (empty($tableName)) {
            $table = 'You must enter table name';
        } elseif (empty($colums)) {
            $columns = 'You must array columns';
        }
        $columns = array_keys($colums);
        $values = array_values($colums);

        $str = "INSERT INTO $tableName (" . implode(',', $columns) . ") VALUES ('" . implode("', '", $values) . "' )";
        $stmt = $db->query($str);
        return $stmt;
    }

    public function GeTable($tableName, $columnWhere = null, $whereVal = null)
    {
        global $db;
        if ($columnWhere && $whereVal) {
            $query = "SELECT * FROM $tableName WHERE `$columnWhere` = $whereVal";

        } else {
            $query = "SELECT * FROM $tableName ORDER BY `id` ASC";
        }
        $excute = $db->query($query);

        return $excute->fetch();

    }

    public function relationTable($table, $relatedTable, $relatedcolumns, $baseKey, $foriegnKey, $column = null, $where = null)
    {
        global $db;

        if ($column && $where) {
            $query = "SELECT $relatedcolumns FROM $table INNER JOIN $relatedTable ON $relatedTable.`$baseKey` = $table.`$foriegnKey` WHERE $column = $where";

        } else {
            $query = "SELECT $relatedcolumns FROM $table INNER JOIN $relatedTable ON $relatedTable.`$baseKey` = $table.`$foriegnKey`";
        }
        $excute = $db->query($query);
        return $excute->fetch();

    }

    public function morphToMany($table, $arrinner, $Selectedcolumns, $columnWhere = null, $whereVal = null)
    {
        global $db;

        if ($columnWhere && $whereVal) {
            $query = "SELECT $Selectedcolumns FROM $table INNER JOIN " . $arrinner[0]['relatedTable'] . " ON " . $arrinner[0]['relatedTable'] . ".`" . $arrinner[0]['baseKey'] . "` = $table.`" . $arrinner[0]['foreignKey'] . "` INNER JOIN " . $arrinner[1]['relatedTable'] . " ON " . $arrinner[1]['relatedTable'] . ".`" . $arrinner[1]['baseKey'] . "` = $table.`" . $arrinner[1]['foreignKey'] . "` WHERE $columnWhere = $whereVal";
        } else {
            $query = "SELECT $Selectedcolumns FROM $table INNER JOIN " . $arrinner[0]['relatedTable'] . " ON " . $arrinner[0]['relatedTable'] . ".`" . $arrinner[0]['baseKey'] . "` = $table.`" . $arrinner[0]['foreignKey'] . "` INNER JOIN " . $arrinner[1]['relatedTable'] . " ON " . $arrinner[1]['relatedTable'] . ".`" . $arrinner[1]['baseKey'] . "` = $table.`" . $arrinner[1]['foreignKey'] . "`";

        }

        $excute = $db->query($query);
        return $excute->fetchAll();

    }

}
