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

    var $ingredients = array();

    /**
     * This function returns an ingredient from database "store" by Id given.
     * @param $id
     * @return array
     */
    public function load_by_id($id)
    {
        $db = model_database::instance();
        $sql = 'SELECT id_ingredient, name_ingredient
			FROM ingredient
			WHERE id_ingredient =  ' . $id;
        if ($result = $db->get_row($sql)) {
            $this->ingredients = array(
                'id_ingredient' => $result['id_ingredient'],
                'name_ingredient' => $result['name_ingredient'],
            );
        }
        return $this->ingredients;
    }

    /**
     * This function returns an ingredient from database "store" by given name.
     * @param $name
     * @return array
     */
    public function load_by_name($name)
    {
        $db = model_database::instance();
        $sql = 'SELECT id_ingredient, name_ingredient
			FROM ingredient
			WHERE name_ingredient =  ' . $name;
        if ($result = $db->get_row($sql)) {
            $this->ingredients = array(
                'id_ingredient' => $result['id_ingredient'],
                'name_ingredient' => $result['name_ingredient'],
            );
        }
        return $this->ingredients;
    }

    /**
     * This function returns all ingredients from database "store".
     * @return array
     */
    public function get_all()
    {
        $db = model_database::instance();
        $sql = "SELECT *
               FROM ingredient";
        $result = $db->get_rows($sql);
        return $result;
    }

    /**
     * This function adds an ingredient with given name to the database.
     * @param $name
     */
    public function add_ingredient($name)
    {
        $db = model_database::instance();
        $sql = 'insert into ingredient
                (name_ingredient)
                values
                (\'' . $name . '\');';
        $db->execute($sql);
    }

    /**
     * This function edits an ingredient with given id.
     * @param $id
     * @param $name
     */
    public function edit_ingredientByID($id, $name)
    {
        $db = model_database::instance();
        $sql = ' UPDATE ingredient
        SET name_ingredient=\'' . $name . '\'
        WHERE id_ingredient=' . $id . ' ;';
        $db->execute($sql);

    }

    /**
     * This function edits an ingredient with given name.
     * @param $name
     * @param $new_name
     */
    public function edit_ingredientByName($name, $new_name)
    {
        $db = model_database::instance();
        $sql = ' UPDATE ingredient
        SET name_ingredient=\'' . $new_name . '\'
        WHERE id_ingredient=' . $name . ' ;';
        $db->execute($sql);

    }

    /**
     * This function is deleting an ingredient by given name.
     * @param $name
     */
    public function delete_ingredientByName($name)
    {
        $db = model_database::instance();
        $sql = ' DELETE FROM ingredient WHERE name_ingredient=\'' . $name . '\'';
        $db->execute($sql);
    }

    /**
     * This function is deleting an ingredient by given id.
     * @param $id
     */
    public function delete_ingredientById($id)
    {
        $db = model_database::instance();
        $sql = ' DELETE FROM ingredient WHERE id_ingredient=\'' . $id . '\'';
        $db->execute($sql);
    }

}

$ingredient = new model_ingredient;
$ingredient->delete_ingredient("vanilie");
//var_dump($result);

