<?php
@include_once __DIR__ .'/database.php';
@include_once __DIR__ .'/ingredient.php';
class model_cake {
    var $id;
    var $name;
    var $price;
    var $weight;
    var $calories;
    var $quantity;
    var $ordered_quantity;

    /**
     * Add a new cake in database
     * @param $name
     * @param $price
     * @param $weight
     * @param $calories
     * @param $quantity
     * @return bool|model_cake
     */
    public static function create($name, $price, $weight, $calories, $quantity)
    {
        $db = model_database::instance();
        $sql = 'INSERT INTO cakes (cake_name, cake_price, cake_weight, cake_calories, cake_quantity)
            VALUES
            (\'' .  mysql_real_escape_string($name) . '\', ' .  $price . ', ' .  $weight . ', ' .  $calories .',' .$quantity . ');';
        if ($db->execute($sql))  {
            $new_id = $db->last_insert_id();
            return model_cake::load_by_id($new_id);
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
            $cake->name = $result['cake_name'];
            $cake->price = $result['cake_price'];
            $cake->weight = $result['cake_weight'];
            $cake->calories = $result['cake_calories'];
            $cake->quantity = $result['cake_quantity'];
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
                $cake->name = $a['cake_name'];
                $cake->price = $a['cake_price'];
                $cake->weight = $a['cake_weight'];
                $cake->calories = $a['cake_calories'];
                $cake->quantity = $a['cake_quantity'];
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
        $sql = 'DELETE
            FROM cakes
            WHERE cake_id = '. $this->id;
        if ($db->execute($sql)) {
            $this->id = NULL;
            $this->name = NULL;
            $this->price = NULL;
            $this->weight = NULL;
            $this->calories = NULL;
            $this->quantity = NULL;
            return TRUE;
        }
        return FALSE;
    }

    /**
     * Update a cake in database
     * @param $name
     * @param $price
     * @param $weight
     * @param $calories
     * @param $quantity
     * @return bool
     */
    public function update($name, $price, $weight, $calories, $quantity)
    {
        $db = model_database::instance();
        $sql = 'UPDATE cakes
            SET cake_name =\'' .   mysql_real_escape_string($name) . '\', cake_price =\'' . $price . '\',
                         cake_weight =\'' . $weight .'\', cake_calories=\'' . $calories .'\', cake_quantity=\'' .$quantity .'\'
            WHERE cake_id = \''. $this->id . '\'';
        if ($db->execute($sql)) {
            $this->name = $name;
            $this->price = $price;
            $this->weight = $weight;
            $this->calories = $calories;
            $this->quantity = $quantity;
            return TRUE;
            }
        return FALSE;
    }

    /**
     * @return array|bool|null
     */
   /* public function get_ingredients()
    {
        $db = model_database::instance();
        $sql = 'SELECT * FROM ingredients as ing INNER JOIN ingredients_cakes ON
        ingredients_cakes.ic_id_ingredient = ing.ingredient_id INNER JOIN cakes ON cakes.cake_id = ingredients_cakes.ic_id_cake
        WHERE cakes.cake_id =' .$this->id;
        if ($result = $db->get_rows($sql)) {
            $res = null;
            foreach($result as $re) {
                $ingredient = model_ingredient::load_by_id($re['ingredient_id']);
                $res[] = $ingredient;
                }
            return $res;
            }
        return FALSE;
    }*/

    /**
     * @return array|bool|null
     */
    public function get_ingredients()
    {
        $db = model_database::instance();
        $sql = 'SELECT * FROM ingredients_cakes
        WHERE ic_id_cake =' .$this->id;
        if ($result = $db->get_rows($sql)) {
            $res = array();
            foreach($result as $re) {
                $ingredient = model_ingredient::load_by_id($re['ic_id_ingredient']);
                $res[] = $ingredient;
            }
            return $res;
        }
        return FALSE;
    }

    public function sell_cakes($quantity){
        $buff = $this->quantity - $quantity;
        $db = model_database::instance();
        $sql = 'UPDATE cakes
            SET cake_quantity=\'' . $buff .'\'
            WHERE cake_id = \''. $this->id . '\'';
        if ($db->execute($sql)) {
            $this->quantity = $buff;
            return TRUE;
        }
        return FALSE;
    }

}
