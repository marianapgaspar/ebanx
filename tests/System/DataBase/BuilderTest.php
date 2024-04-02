<?php declare(strict_types=1);
namespace Tests\System\DataBase;

use PHPUnit\Framework\TestCase;
use System\DataBase\Builders\Query\MySql;
use System\DataBase\Entities\Conditionals;
use System\DataBase\Entities\Select;

final class BuilderTest extends TestCase{
    public function testSimpleQuery(){
        $select = new Select();
        $select->from("teste");
        $builder = new MySql();

        $this->assertEquals(
            'SELECT * FROM teste',
            $builder->select($select)
        );
    }
    public function testSimpleWhereQueryWithQuotes(){
        $select = new Select();
        $select->from("teste")->where('a','=','b');
        $builder = new MySql();

        $this->assertEquals(
            "SELECT * FROM teste WHERE a = 'b'",
            $builder->select($select)
        );
    }
    public function testSimpleWhereQueryWithoutQuotes(){
        $select = new Select();
        $select->from("teste")->where('a','=','b',false);
        $builder = new MySql();

        $this->assertEquals(
            "SELECT * FROM teste WHERE a = b",
            $builder->select($select)
        );
    }

    public function testSimpleInnerJoinQuery(){
        $select = new Select();
        $select->from("teste")->join('teste2','a = b');
        $builder = new MySql();

        $this->assertEquals(
            "SELECT * FROM teste INNER JOIN teste2 ON a = b",
            $builder->select($select)
        );
    }
    public function testSimpleLeftJoinQuery(){
        $select = new Select();
        $select->from("teste")->join('teste2','a = b','LEFT');
        $builder = new MySql();

        $this->assertEquals(
            "SELECT * FROM teste LEFT JOIN teste2 ON a = b",
            $builder->select($select)
        );
    }

    public function testComplexWhereQuery(){
        $select = new Select();
        $select->from("teste")->where('a','=','b')->group((new Conditionals)->where('b','=','c')->orGroup((new Conditionals)->where('b','=','c',false)));
        $builder = new MySql();
        $this->assertEquals(
            "SELECT * FROM teste WHERE a = 'b' AND ( b = 'c' OR ( b = c ) )",
            $builder->select($select)
        );
    }

    public function testJoinSelectQuery(){
        $select = new Select();
        $select->from("teste")->joinSelect((new Select)->from("teste")->where('a','=','b')->group((new Conditionals)->where('b','=','c')->orGroup((new Conditionals)->where('b','=','c',false))),'a = b','INNER','teste_join');
        $builder = new MySql();
        $this->assertEquals(
            "SELECT * FROM teste INNER JOIN (SELECT * FROM teste WHERE a = 'b' AND ( b = 'c' OR ( b = c ) )) teste_join ON a = b",
            $builder->select($select)
        );
    }
}