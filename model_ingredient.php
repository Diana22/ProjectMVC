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
     * This function returns an ingredients from database "store" by Id given.
     * @param $id
     * @return array
     */
    public static function load_by_id($id)
    {

        $db = model_database::instance();
        $sql = 'SELECT ingredient_id, ingredient_name
			FROM ingredients
			WHERE ingredient_id =  ' . $id;
        if ($result = $db->get_row($sql)) {
            $response = new model_ingredient;
            $response->id = $result['ingredient_id'];
            $response->name = $result['ingredient_name'];
            return $response;
        }
        return false;
    }


    /**
     * This function returns all objects from database as an sorted array.
     * @return array
     */
    public static function get_all()
    {
        $db = model_database::instance();
        $sql = "SELECT * FROM ingredients
                ORDER BY ingredient_name";
        $return = array();
        if ($result = $db->get_rows($sql)) {
            foreach ($result as $array) {
                $ingredients = new model_ingredient;
                $ingredients->name = $array['ingredient_name'];
                $ingredients->id = $array['ingredient_id'];
                $return[] = $ingredients;
            }
            ksort($return);
        }
        ;

        return $return;
    }

    /**
     * This function adds an ingredients with given name to the database.
     * @param $name
     */
    public static function create($name)
    {
        $db = model_database::instance();
        $sql = 'insert into ingredients
                (ingredient_name)
                values
                (\'' . mysql_real_escape_string($name) . '\');';
        if ($db->execute($sql)) {
            $new_id = $db->last_insert_id();
            return model_ingredient::load_by_id($new_id);
        }
        ;
        return false;
    }

    /**
     * This function edits an ingredients with given name.
     * @param $id
     * @param $name
     */
    public function edit($name)
    {
        $db = model_database::instance();
        $sql = ' UPDATE ingredients
        SET ingredient_name=\'' . mysql_real_escape_string($name) . '\'
        WHERE ingredient_id=' . $this->id . ' ;';
        if ($db->execute($sql)) {
            $this->name = mysql_real_escape_string($name);
            return TRUE;
        }
        ;
        return FALSE;
    }

    /**
     * This function is deleting an ingredients by given name.
     * @param $name
     */
    public function delete($name)
    {
        $db = model_database::instance();
        $sql = ' DELETE FROM ingredients WHERE ingredient_name=\'' . mysql_real_escape_string($name) . '\'';
        if ($db->execute($sql)) {
            $this->name = null;
            $this->id = null;

        }
        ;
    }


}

//$ingredients =new model_ingredients;
//$ingredients->delete('cocos');

$order = model_ingredient::create("cirese");
//var_dump($order);
//var_dump($result);
