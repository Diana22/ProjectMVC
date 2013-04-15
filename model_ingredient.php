<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Andrada
 * Date: 4/12/13
 * Time: 11:54 AM
 * To change this template use File | Settings | File Templates.
 */

include_once __DIR__ . "/database.php";
class model_ingredient
{
    var $id;
    var $name;

    /**
     * This function returns an ingredient from database "store" by Id given.
     * @param $id
     * @return array
     */
    public static  function load_by_id($id)
    {

        $db = model_database::instance();
        $sql = 'SELECT id_ingredient, name_ingredient
			FROM ingredient
			WHERE id_ingredient =  ' . $id;
        if ($result = $db->get_row($sql)) {
            $response = new model_ingredient;
            $response->id = $result['id_ingredient'];
            $response->name = $result['name_ingredient'];
            return $response;
        }
        return false;
    }


    /**
     * This function returns all ingredients from database "store".
     * @return array
     */
    public function  make($array){
        $this->id = $array['id_ingredient'];
        $this->name = $array['name_ingredient'];
        return $this;
    }

    /**
     * This function compares two strings and sorts them.
     * @param $a
     * @param $b
     * @return int
     */
    public function cmp($a, $b)
    {
        return strcmp($a["id_ingredient"], $b["name_ingredient"]);
    }

    /**
     * This function returns all objects from database as an sorted array.
     * @return array
     */
    public static function get_all()
    {
        $db = model_database::instance();
        $sql = "SELECT *
               FROM ingredient";
        if ($result = $db->get_rows($sql)){
            $ingredient = new model_ingredient;

            foreach ($result as $array){
                $return[$array['name_ingredient']] = $array['id_ingredient'];
            }
            return $return;
        };
        usort($return,"cmp");
        var_dump($return);
        return $result;
    }

    /**
     * This function adds an ingredient with given name to the database.
     * @param $name
     */
    public static function create($name)
    {
        $db = model_database::instance();
        $sql = 'insert into ingredient
                (name_ingredient)
                values
                (\'' . $name . '\');';
       if ($db->execute($sql)){
           return true;
       };
        return false;
    }

    /**
     * This function edits an ingredient with given name.
     * @param $id
     * @param $name
     */
    public function edit($name)
    {

        $db = model_database::instance();
        $sql = ' UPDATE ingredient
        SET name_ingredient=\'' . $name . '\'
        WHERE id_ingredient=' .$this-> id . ' ;';
        if ($db->execute($sql)){
            $this->name=$name;
            return TRUE;
        };
        return FALSE;
    }


    /**
     * This function is deleting an ingredient by given name.
     * @param $name
     */
    public function delete($name)
    {
        $db = model_database::instance();
        $sql = ' DELETE FROM ingredient WHERE name_ingredient=\'' . $name . '\'';
        if ($db->execute($sql)){
            $this->name=null;
            $this->id=null;

        };
    }


}

//$ingredient =new model_ingredient;
//$ingredient->delete('cocos');

$order = model_ingredient::get_all();
var_dump($order);
//var_dump($result);
