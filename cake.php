<?php
include_once __DIR__ .'/database.php';
include_once __DIR__ .'/model_ingredient.php';
class model_cake {
    var $id_cake;
    var $name_cake;
    var $price;
    var $weight;
    var $calories;

    public static function create($name_cake, $price, $weight, $calories)
    {
        $db = model_database::instance();
        $sql = 'INSERT INTO cake (name_cake, price, weight, calories) values (\'' . $name_cake . '\', ' . $price . ', ' . $weight . ', ' . $calories . ');';
        if ($result = $db->execute($sql)) {
            $cake = new model_cake();
            $cake->id_cake = $result['id_cake'];
            $cake->name_cake = $result['name_cake'];
            $cake->price = $result['price'];
            $cake->weight = $result['weight'];
            $cake->calories = $result['calories'];
            return $cake;
        }
        return FALSE;

    }

    public static function load_by_id($id)
    {
        $db = model_database::instance();
        $sql = 'SELECT *
            FROM cake
            WHERE id_cake = ' .$id;
        if ($result = $db->get_row($sql)) {
            $cake = new model_cake();
            $cake->id_cake = $result['id_cake'];
            $cake->name_cake = $result['name_cake'];
            $cake->price = $result['price'];
            $cake->weight = $result['weight'];
            $cake->calories = $result['calories'];
            return $cake;
        }
        return FALSE;
    }


    public static function get_all()
    {
        $res = array();
        $db = model_database::instance();
        $sql = 'SELECT *
            FROM cake';
        if ($result = $db->get_rows($sql)) {
            $cake = new model_cake();
            foreach($result as $a){
                $cake->id_cake = $a['id_cake'];
                $cake->name_cake = $a['name_cake'];
                $cake->price = $a['price'];
                $cake->weight = $a['weight'];
                $cake->calories = $a['calories'];
                array_push($res, $a);
            }
            return $res;
        }
    }


    public function delete()
    {
        $db = model_database::instance();
        $sql = 'DELETE FROM cake
            WHERE id_cake = '. $this->id_cake;
        $this->id_cake = NULL;
        $this->name_cake = NULL;
        $this->price = NULL;
        $this->weight = NULL;
        $this->calories = NULL;
        if ($db->execute($sql)) {
            return TRUE;
        }
        return FALSE;
    }

    public function add($name_cake, $price, $weight, $calories)
    {
        $db = model_database::instance();
        $sql = 'INSERT INTO cake (name_cake, price, weight, calories) values (\'' . $name_cake . '\', ' . $price . ', ' . $weight . ', ' . $calories . ');';
        $db->execute($sql);
    }

    public function update($name_cake, $price, $weight, $calories)
    {
        $db = model_database::instance();
        $sql = 'UPDATE cake
        SET name_cake =\'' .  $name_cake . '\', price =\'' . $price . '\', weight =\'' . $weight .'\', calories=\'' . $calories .'\'
        WHERE id_cake = \''. $this->id_cake . '\'';
        if ($db->execute($sql)) {
            $this->name_cake = $name_cake;
            $this->price = $price;
            $this->weight = $weight;
            $this->calories = $calories;
            return TRUE;
            }
        return FALSE;
    }

    //Working progress
    public function get_ingredients()
    {
        $db = model_database::instance();
        $sql = 'SELECT ing.id_ingredient, ing.name_ingredient from ingredient as ing inner join ingredient_cake on
        ingredient_cake.id_ingredient = ing.id_ingredient inner join cake on cake.id_cake = ingredient_cake.id_cake
        where cake.id_cake =' .$this->id_cake;
        if ($result = $db->get_row($sql)) {
            $ingredient = new model_ingredient();
            $ingredient->id_ingredient = $result['id_ingredient'];
            $ingredient->name_ingredient = $result['name_ingredient'];
            return $ingredient;
         }

    }


}

$cake = model_cake::create('asaaa', 4, 300, 400);
//$cake = model_cake::load_by_id(9);
//$cake->delete();
//var_dump($cake);
//$cake2 = $cake->get_ingredients();
//echo $cake2->name_ingredient;

