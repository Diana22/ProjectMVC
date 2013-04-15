<?php
include_once __DIR__ .'/database.php';
include_once __DIR__ .'/model_ingredient.php';
class model_cake {
    var $id;
    var $cake_name;
    var $cake_price;
    var $cake_weight;
    var $cake_calories;
    var $cake_quantity;

    /**
     * Add a new cake in database
     * @param $cake_name
     * @param $cake_price
     * @param $cake_weight
     * @param $cake_calories
     * @param $cake_quantity
     * @return bool|model_cake
     */
    public static function create($cake_name, $cake_price, $cake_weight, $cake_calories, $cake_quantity)
    {
        $db = model_database::instance();
        $sql = 'INSERT INTO cakes (cake_name, cake_price, cake_weight, cake_calories, cake_quantity) values (\'' .  mysql_real_escape_string($cake_name) . '\', ' .  $cake_price . ', ' .  $cake_weight . ', ' .  $cake_calories .',' .$cake_quantity . ');';
        $db->execute($sql);
        if ($db->get_affected_rows() > 0)
        {
            $sql = 'SELECT cake_id, cake_name, cake_price, cake_weight, cake_calories, cake_quantity
                FROM cakes
                WHERE cake_id = \'' .  $db->last_insert_id() . '\';';
            if ($result = $db->get_row($sql)) {
                $res = new model_cake();
                $res->id = $result['cake_id'];
                $res->cake_name = $result['cake_name'];
                $res->cake_price = $result['cake_price'];
                $res->cake_weight = $result['cake_weight'];
                $res->cake_calories = $result['cake_calories'];
                $res->cake_quantity = $result['cake_quantity'];
                return $res;
            }
        }
        return FALSE;

    }

    /**
     * Load a cake by id from database
     * @param $id
     * @return bool|model_cake
     */
    public static function load_by_id($id)
    {
        $db = model_database::instance();
        $sql = 'SELECT *
            FROM cakes
            WHERE cake_id = ' .$id;
        if ($result = $db->get_row($sql)) {
            $cake = new model_cake();
            $cake->id = $result['cake_id'];
            $cake->cake_name = $result['cake_name'];
            $cake->cake_price = $result['cake_price'];
            $cake->cake_weight = $result['cake_weight'];
            $cake->cake_calories = $result['cake_calories'];
            $cake->cake_quantity = $result['cake_quantity'];
            return $cake;
        }
        return FALSE;
    }

    /**
     * Load all cakes from database
     * @return array
     */
    public static function get_all()
    {
        $res = array();
        $db = model_database::instance();
        $sql = 'SELECT *
            FROM cakes';
        if ($result = $db->get_rows($sql)) {
            foreach($result as $a){
                $cake = new model_cake();
                $cake->id = $a['cake_id'];
                $cake->cake_name = $a['cake_name'];
                $cake->cake_price = $a['cake_price'];
                $cake->cake_weight = $a['cake_weight'];
                $cake->cake_calories = $a['cake_calories'];
                $cake->cake_quantity = $a['cake_quantity'];
                array_push($res, $cake);
            }
        }
        return $res;
    }

    /**
     * Delete a cake from database
     * @return bool
     */
    public function delete()
    {
        $db = model_database::instance();
        $sql = 'DELETE FROM cakes
            WHERE cake_id = '. $this->id;
        if ($db->execute($sql)) {
            $this->id = NULL;
            $this->cake_name = NULL;
            $this->cake_price = NULL;
            $this->cake_weight = NULL;
            $this->cake_calories = NULL;
            $this->cake_quantity = NULL;
            return TRUE;
        }
        return FALSE;
    }

    /**
     * Update a cake in database
     * @param $cake_name
     * @param $cake_price
     * @param $cake_weight
     * @param $cake_calories
     * @param $cake_quantity
     * @return bool
     */
    public function update($cake_name, $cake_price, $cake_weight, $cake_calories, $cake_quantity)
    {
        $db = model_database::instance();
        $sql = 'UPDATE cakes
        SET cake_name =\'' .   mysql_real_escape_string($cake_name) . '\', cake_price =\'' . $cake_price . '\', cake_weight =\'' . $cake_weight .'\', cake_calories=\'' . $cake_calories .'\', cake_quantity=\'' .$cake_quantity .'\'
        WHERE cake_id = \''. $this->id . '\'';
        if ($db->execute($sql)) {
            $this->cake_name = $cake_name;
            $this->cake_price = $cake_price;
            $this->cake_weight = $cake_weight;
            $this->cake_calories = $cake_calories;
            $this->cake_quantity = $cake_quantity;
            return TRUE;
            }
        return FALSE;
    }

    /**
     * Get all the ingredients for a cake
     * @return array
     */
    public function get_ingredients()
    {
        $res = array();
        $db = model_database::instance();
        $sql = 'SELECT ing.ingredient_id, ing.ingredient_name from ingredients as ing inner join ingredients_cakes on
        ingredients_cakes.ic_id_ingredient = ing.ingredient_id inner join cakes on cakes.cake_id = ingredients_cakes.ic_id_cake
        where cakes.cake_id =' .$this->id;
        if ($result = $db->get_rows($sql)) {
            $ingredient = new model_ingredient();
            foreach($result as $re) {
                $ingredient->ingredient_id = $re['ingredient_id'];
                $ingredient->ingredient_name = $re['ingredient_name'];
                array_push($res, $re);
            }
            return $res;
        }

    }


}

