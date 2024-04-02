<?php
namespace System\DataBase\Builders\Query;

use System\DataBase\Entities\Conditionals;
use System\DataBase\Entities\Select;
class MySql extends ABuilder{



    public function delete(Select $select, array $tables):string {
        $table = $select->getTable();
        if (!$table) {
            //erro
        }

        if (isset($table["select"])) {
            //erro
        }

        $sql = "DELETE " . implode(", ", $tables) . " FROM ";

        $name = $table["name"] ? " {$table["name"]}" : "";
        $sql .= "{$table["table"]}{$name} ";
        $sql .= $this->_buildBody($select);
        return $sql;
    }

    public function insertSelect(Select $select, array $fields, string $table):string {
        return "INSERT INTO $table (" . implode(", ", $fields) . ") " . $this->_buildSelect($select);

    }

    public function replaceSelect(Select $select, array $fields, string $table):string {
        return "REPLACE INTO $table (" . implode(", ", $fields) . ") " . $this->_buildSelect($select);
    }

    public function update(Select $select,array $values,bool $quotes = true):string{
        $table = $select->getTable();
        $name = $table["name"] ? " {$table["name"]}" : "";
        $sql = "UPDATE {$table["table"]}{$name}";
        $sql .= $this->_buildJoins($select) ." SET " ;

        foreach($values as $colunm=>$value){
            if (!$value && $value != 0){
                $sql .= "$colunm = NULL,";
                continue;
            }
            if($quotes){
                $sql .= "$colunm = '$value',";
                continue;
            }
            $sql .= "$colunm = $value,";
        }
        $sql = trim($sql,',')." ";
        if($select->getWheres()){
            $sql .= "WHERE ".$this->_buildWheres($select);
        }
        return $sql;
    }

    public function select(Select $select):string {
        return $this->_buildSelect($select);
    }

    private function _buildBody(Select $select): string {
        $corpoSql = "";
        $corpoSql .= $this->_buildJoins($select);
        if($select->getWheres()){
            $corpoSql .= "WHERE ".$this->_buildWheres($select);
        }
        
        return $corpoSql;
    }

    private function _buildLimit(Select $select):string{
        $sql = '';
        if($select->getLimit()!==null){
            $sql .= ' LIMIT '.$select->getLimit();
        }
        if($select->getOffset()){
            $sql .= ', '.$select->getOffset();
        }
        return $sql;
    }
    private function _buildWheres(Conditionals $conditionals): string {
        $wheres = $conditionals->getWheres();
        $wheresSql = "";
        foreach ($wheres as $where) {
            if ($wheresSql === "") {

                $wheresSql .= $this->_buildWhere($where);
                continue;
            }
            if ($where["type"] ===Conditionals::TYPE_AND) {
                $wheresSql .= $this->_buildWhere($where, "AND ");
                continue;
            }
            $wheresSql .= $this->_buildWhere($where, "OR ");
            continue;
        }
        return $wheresSql;
    }
    private function _buildWhere(array $where, string $prefix = ""): string {
        $wheresSql = "";
        if ($where["operator"] === "GROUP") {
            $wheresSql .= $prefix . "( ";
            $wheresSql .= $this->_buildWheres($where["conditionals"]);
            $wheresSql .= ") ";
            return $wheresSql;
        }
        if ($where["operator"] === "IN" || $where["operator"] === "NOT IN") {
            $wheresSql .= $prefix . $where["field"] . " " . $where["operator"] . " ('" . implode("', '", $where['values']) . "') ";
            return $wheresSql;
        }
        if ($where["quotes"]) {
            $wheresSql .= $prefix . $where["field"] . " " . $where["operator"] . " '{$where["value"]}' ";
            return $wheresSql;
        }
        $wheresSql .= $prefix . $where["field"] . " " . $where["operator"] . " {$where["value"]} ";
        return $wheresSql;
    }

    private function _buildJoins(Select $select): string {
        $joins = $select->getJoins();

        $joinSql = "";

        foreach ($joins as $join) {
            if (isset($join["select"])) {
                if ($join["name"]) {
                    $joinSql .= "{$join["type"]} JOIN ({$this->_buildSelect($join["select"])}) {$join["name"]} ON {$join["condition"]} ";
                } else {
                    $joinSql .= "{$join["type"]} JOIN ({$this->_buildSelect($join["select"])}) " . uniqid("join") . " ON {$join["condition"]} ";
                }
                continue;
            }
            $name = $join["name"] ? " {$join["name"]}" : "";
            $joinSql .= "{$join["type"]} JOIN {$join["table"]}{$name} ON {$join["condition"]} ";
        }
        return $joinSql;
    }

    private function _buildSelect(Select $select) {
        $selectSql = "";
        if (!$select->getSelect()) {
            $selectSql .= "SELECT * FROM ";
        } else {
            $selectSql .= "SELECT " . implode(", ", $select->getSelect()) . " FROM ";
        }
        $table = $select->getTable();
        if (!$table) {
            //erro
        }
        if (isset($table["select"])) {
            if ($table["name"]) {
                $selectSql .= "({$this->_buildSelect($table["select"])}) {$table["name"]} ";
            } else {
                $selectSql .= "({$this->_buildSelect($table["select"])}) " . uniqid("table") . " ";
            }
        } else {
            $name = $table["name"] ? " {$table["name"]}" : "";
            $selectSql .= "{$table["table"]}{$name} ";
        }
        $selectSql .= $this->_buildBody($select);
        if($select->getGroupBys()){
            $selectSql .= $this->_buildGroupBys($select);
        }
        if($select->getOrderBys()){
            $selectSql .= " ".$this->__ordersBys($select);
        }
        $selectSql .= $this->_buildLimit($select);
        return trim($selectSql);
    }

    private function _buildGroupBys(Select $select):string{
        $sql = " GROUP BY ";
        foreach($select->getGroupBys() as $groupBy){
            $sql .=$groupBy.", ";
        }
        return trim($sql,', ');
    }

    private function __ordersBys(Select $select):string{
        $sql = " ORDER BY ";
        foreach($select->getOrderBys() as $orderBy){
            $sql .=$orderBy['field']." ".$orderBy['direction'].", ";
        }
        return trim($sql,', ');
    }

    function insert(string $table,array $values){
        $valuesString = '(';
        foreach($values as $value){
            if(is_null($value)){
                $valuesString .= 'NULL,';
                continue;
            }
            if(is_array($value)){
                $value = json_encode($value);
            }
            $valuesString .= "'$value',";
        }
        $valuesString = trim($valuesString,',').')';
        return "INSERT INTO $table (".implode(',',array_keys($values)).") VALUES $valuesString";
    }
}